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

namespace Evrinoma\AddressBundle\PreValidator;

use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Exception\AddressInvalidException;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\PreValidator\AbstractPreValidator;

class DtoPreValidator extends AbstractPreValidator implements DtoPreValidatorInterface
{
    public function onPost(DtoInterface $dto): void
    {
        $this
            ->checkAddress($dto)
            ->checkCountryCode($dto)
            ->checkCountry($dto)
            ->checkZip($dto)
            ->checkTown($dto);
    }

    public function onPut(DtoInterface $dto): void
    {
        $this
            ->checkId($dto)
            ->checkAddress($dto)
            ->checkCountryCode($dto)
            ->checkZip($dto)
            ->checkTown($dto)
            ->checkActive($dto)
            ->checkCountry($dto);
    }

    public function onDelete(DtoInterface $dto): void
    {
        $this->checkId($dto);
    }

    private function checkCountry(DtoInterface $dto): self
    {
        /** @var AddressApiDtoInterface $dto */
        if (!$dto->hasCountry()) {
            throw new AddressInvalidException('The Dto has\'t country');
        }

        return $this;
    }

    private function checkAddress(DtoInterface $dto): self
    {
        /** @var AddressApiDtoInterface $dto */
        if (!$dto->hasAddress()) {
            throw new AddressInvalidException('The Dto has\'t address');
        }

        return $this;
    }

    private function checkCountryCode(DtoInterface $dto): self
    {
        /** @var AddressApiDtoInterface $dto */
        if (!$dto->hasCountryCode()) {
            throw new AddressInvalidException('The Dto has\'t country code');
        }

        return $this;
    }

    private function checkTown(DtoInterface $dto): self
    {
        /** @var AddressApiDtoInterface $dto */
        if (!$dto->hasTown()) {
            throw new AddressInvalidException('The Dto has\'t town');
        }

        return $this;
    }

    private function checkZip(DtoInterface $dto): self
    {
        /** @var AddressApiDtoInterface $dto */
        if (!$dto->hasZip()) {
            throw new AddressInvalidException('The Dto has\'t zip');
        }

        return $this;
    }

    private function checkActive(DtoInterface $dto): self
    {
        /** @var AddressApiDtoInterface $dto */
        if (!$dto->hasActive()) {
            throw new AddressInvalidException('The Dto has\'t active');
        }

        return $this;
    }

    private function checkId(DtoInterface $dto): self
    {
        /** @var AddressApiDtoInterface $dto */
        if (!$dto->hasId()) {
            throw new AddressInvalidException('The Dto has\'t ID or class invalid');
        }

        return $this;
    }
}
