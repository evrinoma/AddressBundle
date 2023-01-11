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

namespace Evrinoma\AddressBundle\Manager;

use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Exception\AddressCannotBeRemovedException;
use Evrinoma\AddressBundle\Exception\AddressInvalidException;
use Evrinoma\AddressBundle\Exception\AddressNotFoundException;
use Evrinoma\AddressBundle\Model\Address\AddressInterface;

interface CommandManagerInterface
{
    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return AddressInterface
     *
     * @throws AddressInvalidException
     */
    public function post(AddressApiDtoInterface $dto): AddressInterface;

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return AddressInterface
     *
     * @throws AddressInvalidException
     * @throws AddressNotFoundException
     */
    public function put(AddressApiDtoInterface $dto): AddressInterface;

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @throws AddressCannotBeRemovedException
     * @throws AddressNotFoundException
     */
    public function delete(AddressApiDtoInterface $dto): void;
}
