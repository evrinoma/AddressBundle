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

use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface as BaseAddressApiDtoInterface;

interface AddressApiDtoInterface
{
    public const ADDRESS = BaseAddressApiDtoInterface::ADDRESS;

    public function hasAddressApiDto(): bool;

    public function getAddressApiDto(): BaseAddressApiDtoInterface;
}
