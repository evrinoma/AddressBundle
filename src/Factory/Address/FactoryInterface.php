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

namespace Evrinoma\AddressBundle\Factory\Address;

use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Model\Address\AddressInterface;

interface FactoryInterface
{
    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return AddressInterface
     */
    public function create(AddressApiDtoInterface $dto): AddressInterface;
}
