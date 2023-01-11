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
use Evrinoma\AddressBundle\Exception\AddressNotFoundException;
use Evrinoma\AddressBundle\Exception\AddressProxyException;
use Evrinoma\AddressBundle\Model\Address\AddressInterface;

interface QueryManagerInterface
{
    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return array
     *
     * @throws AddressNotFoundException
     */
    public function criteria(AddressApiDtoInterface $dto): array;

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return AddressInterface
     *
     * @throws AddressNotFoundException
     */
    public function get(AddressApiDtoInterface $dto): AddressInterface;

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return AddressInterface
     *
     * @throws AddressProxyException
     */
    public function proxy(AddressApiDtoInterface $dto): AddressInterface;
}
