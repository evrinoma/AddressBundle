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

namespace Evrinoma\AddressBundle\Dto;

use Evrinoma\AddressBundle\DtoCommon\ValueObject\Immutable\AddressInterface;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Immutable\CountryCodeInterface;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Immutable\CountryInterface;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Immutable\TownInterface;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Immutable\ZipInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\ActiveInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\IdInterface;

interface AddressApiDtoInterface extends DtoInterface, IdInterface, ActiveInterface, AddressInterface, CountryCodeInterface, CountryInterface, ZipInterface, TownInterface
{
}
