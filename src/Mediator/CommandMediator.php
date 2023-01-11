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
use Evrinoma\AddressBundle\Model\Address\AddressInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
    public function onUpdate(DtoInterface $dto, $entity): AddressInterface
    {
        /* @var $dto AddressApiDtoInterface */
        $entity
            ->setCountryCode($dto->getCountryCode())
            ->setCountry($dto->getCountry())
            ->setZip($dto->getZip())
            ->setAddress($dto->getAddress())
            ->setTown($dto->getTown())
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setActive($dto->getActive());

        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
        $entity
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setActiveToDelete();
    }

    public function onCreate(DtoInterface $dto, $entity): AddressInterface
    {
        /* @var $dto AddressApiDtoInterface */
        $entity
            ->setCountryCode($dto->getCountryCode())
            ->setCountry($dto->getCountry())
            ->setZip($dto->getZip())
            ->setAddress($dto->getAddress())
            ->setTown($dto->getTown())
            ->setCreatedAt(new \DateTimeImmutable())
            ->setActiveToActive();

        return $entity;
    }
}
