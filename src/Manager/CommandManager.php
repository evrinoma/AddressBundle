<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\AddressBundle\Manager;

use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Exception\AddressCannotBeCreatedException;
use Evrinoma\AddressBundle\Exception\AddressCannotBeRemovedException;
use Evrinoma\AddressBundle\Exception\AddressCannotBeSavedException;
use Evrinoma\AddressBundle\Exception\AddressInvalidException;
use Evrinoma\AddressBundle\Exception\AddressNotFoundException;
use Evrinoma\AddressBundle\Factory\Address\FactoryInterface;
use Evrinoma\AddressBundle\Mediator\CommandMediatorInterface;
use Evrinoma\AddressBundle\Model\Address\AddressInterface;
use Evrinoma\AddressBundle\Repository\Address\AddressRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private AddressRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private FactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface         $validator
     * @param AddressRepositoryInterface $repository
     * @param FactoryInterface           $factory
     * @param CommandMediatorInterface   $mediator
     */
    public function __construct(ValidatorInterface $validator, AddressRepositoryInterface $repository, FactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return AddressInterface
     *
     * @throws AddressInvalidException
     * @throws AddressCannotBeCreatedException
     * @throws AddressCannotBeSavedException
     */
    public function post(AddressApiDtoInterface $dto): AddressInterface
    {
        $address = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $address);

        $errors = $this->validator->validate($address);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new AddressInvalidException($errorsString);
        }

        $this->repository->save($address);

        return $address;
    }

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return AddressInterface
     *
     * @throws AddressInvalidException
     * @throws AddressNotFoundException
     * @throws AddressCannotBeSavedException
     */
    public function put(AddressApiDtoInterface $dto): AddressInterface
    {
        try {
            $address = $this->repository->find($dto->idToString());
        } catch (AddressNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $address);

        $errors = $this->validator->validate($address);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new AddressInvalidException($errorsString);
        }

        $this->repository->save($address);

        return $address;
    }

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @throws AddressCannotBeRemovedException
     * @throws AddressNotFoundException
     */
    public function delete(AddressApiDtoInterface $dto): void
    {
        try {
            $address = $this->repository->find($dto->idToString());
        } catch (AddressNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $address);
        try {
            $this->repository->remove($address);
        } catch (AddressCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
