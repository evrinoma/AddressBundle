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
use Evrinoma\AddressBundle\Repository\Address\AddressQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private AddressQueryRepositoryInterface $repository;

    public function __construct(AddressQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return array
     *
     * @throws AddressNotFoundException
     */
    public function criteria(AddressApiDtoInterface $dto): array
    {
        try {
            $address = $this->repository->findByCriteria($dto);
        } catch (AddressNotFoundException $e) {
            throw $e;
        }

        return $address;
    }

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return AddressInterface
     *
     * @throws AddressProxyException
     */
    public function proxy(AddressApiDtoInterface $dto): AddressInterface
    {
        try {
            if ($dto->hasId()) {
                $address = $this->repository->proxy($dto->idToString());
            } else {
                throw new AddressProxyException('Id value is not set while trying get proxy object');
            }
        } catch (AddressProxyException $e) {
            throw $e;
        }

        return $address;
    }

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @return AddressInterface
     *
     * @throws AddressNotFoundException
     */
    public function get(AddressApiDtoInterface $dto): AddressInterface
    {
        try {
            $address = $this->repository->find($dto->idToString());
        } catch (AddressNotFoundException $e) {
            throw $e;
        }

        return $address;
    }
}
