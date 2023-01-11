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

use Evrinoma\AddressBundle\DtoCommon\ValueObject\Preserve\AddressTrait;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Preserve\CountryCodeTrait;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Preserve\CountryTrait;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Preserve\TownTrait;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Preserve\ZipTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\ActiveTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\IdTrait;

trait AddressApiDtoTrait
{
    use ActiveTrait;
    use AddressTrait;
    use CountryCodeTrait;
    use CountryTrait;
    use IdTrait;
    use TownTrait;
    use ZipTrait;
}
