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

use Evrinoma\AddressBundle\DtoCommon\ValueObject\Immutable\AddressTrait as AddressImmutableTrait;
use Evrinoma\DtoBundle\Dto\DtoInterface;

trait AddressTrait
{
    use AddressImmutableTrait;

    /**
     * @param string $address
     *
     * @return DtoInterface
     */
    protected function setAddress(string $address): DtoInterface
    {
        $this->address = trim($address);

        return $this;
    }
}
