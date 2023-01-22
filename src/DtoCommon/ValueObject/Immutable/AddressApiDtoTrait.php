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

namespace Evrinoma\AddressBundle\DtoCommon\ValueObject\Immutable;

use Evrinoma\AddressBundle\Dto\AddressApiDto;
use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Symfony\Component\HttpFoundation\Request;

trait AddressApiDtoTrait
{
    protected ?AddressApiDtoInterface $addressApiDto = null;

    protected static string $classAddressApiDto = AddressApiDto::class;

    public function genRequestAddressApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $address = $request->get(AddressApiDtoInterface::ADDRESS);
            if ($address) {
                $newRequest = $this->getCloneRequest();
                $address[DtoInterface::DTO_CLASS] = static::$classAddressApiDto;
                $newRequest->request->add($address);

                yield $newRequest;
            }
        }
    }

    public function hasAddressApiDto(): bool
    {
        return null !== $this->addressApiDto;
    }

    public function getAddressApiDto(): AddressApiDtoInterface
    {
        return $this->addressApiDto;
    }
}
