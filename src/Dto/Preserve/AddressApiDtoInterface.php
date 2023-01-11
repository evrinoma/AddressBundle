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

namespace Evrinoma\AddressBundle\Dto\Preserve;

use Evrinoma\AddressBundle\DtoCommon\ValueObject\Mutable\AddressInterface;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Mutable\CountryCodeInterface;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Mutable\CountryInterface;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Mutable\TownInterface;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Mutable\ZipInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\ActiveInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdInterface;

interface AddressApiDtoInterface extends IdInterface, ActiveInterface, AddressInterface, CountryCodeInterface, CountryInterface, ZipInterface, TownInterface
{
}
