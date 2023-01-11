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

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Exception\AddressNotFoundException;
use Evrinoma\AddressBundle\Exception\AddressProxyException;
use Evrinoma\AddressBundle\Model\Address\AddressInterface;

interface AddressQueryRepositoryInterface
{
    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return array
     *
     * @throws AddressNotFoundException
     */
    public function findByCriteria(AddressApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return AddressInterface
     *
     * @throws AddressNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): AddressInterface;

    /**
     * @param string $id
     *
     * @return AddressInterface
     *
     * @throws AddressProxyException
     * @throws ORMException
     */
    public function proxy(string $id): AddressInterface;
}
