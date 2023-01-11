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

namespace Evrinoma\AddressBundle\Repository\Address;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Exception\AddressCannotBeSavedException;
use Evrinoma\AddressBundle\Exception\AddressNotFoundException;
use Evrinoma\AddressBundle\Exception\AddressProxyException;
use Evrinoma\AddressBundle\Mediator\QueryMediatorInterface;
use Evrinoma\AddressBundle\Model\Address\AddressInterface;

trait AddressRepositoryTrait
{
    private QueryMediatorInterface $mediator;

    /**
     * @param AddressInterface $address
     *
     * @return bool
     *
     * @throws AddressCannotBeSavedException
     * @throws ORMException
     */
    public function save(AddressInterface $address): bool
    {
        try {
            $this->persistWrapped($address);
        } catch (ORMInvalidArgumentException $e) {
            throw new AddressCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param AddressInterface $address
     *
     * @return bool
     */
    public function remove(AddressInterface $address): bool
    {
        return true;
    }

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return array
     *
     * @throws AddressNotFoundException
     */
    public function findByCriteria(AddressApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $addresss = $this->mediator->getResult($dto, $builder);

        if (0 === \count($addresss)) {
            throw new AddressNotFoundException('Cannot find address by findByCriteria');
        }

        return $addresss;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     *
     * @throws AddressNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): AddressInterface
    {
        /** @var AddressInterface $address */
        $address = $this->findWrapped($id);

        if (null === $address) {
            throw new AddressNotFoundException("Cannot find address with id $id");
        }

        return $address;
    }

    /**
     * @param string $id
     *
     * @return AddressInterface
     *
     * @throws AddressProxyException
     * @throws ORMException
     */
    public function proxy(string $id): AddressInterface
    {
        $address = $this->referenceWrapped($id);

        if (!$this->containsWrapped($address)) {
            throw new AddressProxyException("Proxy doesn't exist with $id");
        }

        return $address;
    }
}
