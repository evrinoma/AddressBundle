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

namespace Evrinoma\AddressBundle\DtoCommon\ValueObject\Preserve;

use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;

trait AddressApiDtoTrait
{
    public function setAddressApiDto(AddressApiDtoInterface $addressApiDto): DtoInterface
    {
        return parent::setAddressApiDto($addressApiDto);
    }
}
