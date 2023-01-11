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

namespace Evrinoma\AddressBundle\Repository\Address;

use Evrinoma\AddressBundle\Exception\AddressCannotBeRemovedException;
use Evrinoma\AddressBundle\Exception\AddressCannotBeSavedException;
use Evrinoma\AddressBundle\Model\Address\AddressInterface;

interface AddressCommandRepositoryInterface
{
    /**
     * @param AddressInterface $address
     *
     * @return bool
     *
     * @throws AddressCannotBeSavedException
     */
    public function save(AddressInterface $address): bool;

    /**
     * @param AddressInterface $address
     *
     * @return bool
     *
     * @throws AddressCannotBeRemovedException
     */
    public function remove(AddressInterface $address): bool;
}
