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

namespace Evrinoma\AddressBundle\DtoCommon\ValueObject\Mutable;

use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Immutable\AddressApiDtoTrait as AddressApiDtoImmutableTrait;
use Evrinoma\DtoBundle\Dto\DtoInterface;

trait AddressApiDtoTrait
{
    use AddressApiDtoImmutableTrait;

    /**
     * @param AddressApiDtoInterface $addressApiDto
     *
     * @return DtoInterface
     */
    public function setAddressApiDto(AddressApiDtoInterface $addressApiDto): DtoInterface
    {
        $this->addressApiDto = $addressApiDto;

        return $this;
    }
}
