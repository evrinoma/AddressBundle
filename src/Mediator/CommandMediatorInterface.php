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

namespace Evrinoma\AddressBundle\Mediator;

use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Exception\AddressCannotBeCreatedException;
use Evrinoma\AddressBundle\Exception\AddressCannotBeRemovedException;
use Evrinoma\AddressBundle\Exception\AddressCannotBeSavedException;
use Evrinoma\AddressBundle\Model\Address\AddressInterface;

interface CommandMediatorInterface
{
    /**
     * @param AddressApiDtoInterface $dto
     * @param AddressInterface       $entity
     *
     * @return AddressInterface
     *
     * @throws AddressCannotBeSavedException
     */
    public function onUpdate(AddressApiDtoInterface $dto, AddressInterface $entity): AddressInterface;

    /**
     * @param AddressApiDtoInterface $dto
     * @param AddressInterface       $entity
     *
     * @throws AddressCannotBeRemovedException
     */
    public function onDelete(AddressApiDtoInterface $dto, AddressInterface $entity): void;

    /**
     * @param AddressApiDtoInterface $dto
     * @param AddressInterface       $entity
     *
     * @return AddressInterface
     *
     * @throws AddressCannotBeSavedException
     * @throws AddressCannotBeCreatedException
     */
    public function onCreate(AddressApiDtoInterface $dto, AddressInterface $entity): AddressInterface;
}
