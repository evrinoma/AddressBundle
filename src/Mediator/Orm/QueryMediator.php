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

namespace Evrinoma\AddressBundle\Mediator\Orm;

use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Mediator\QueryMediatorInterface;
use Evrinoma\AddressBundle\Repository\AliasInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractQueryMediator;
use Evrinoma\UtilsBundle\Mediator\Orm\QueryMediatorTrait;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

class QueryMediator extends AbstractQueryMediator implements QueryMediatorInterface
{
    use QueryMediatorTrait;

    protected static string $alias = AliasInterface::ADDRESS;

    /**
     * @param DtoInterface          $dto
     * @param QueryBuilderInterface $builder
     *
     * @return mixed
     */
    public function createQuery(DtoInterface $dto, QueryBuilderInterface $builder): void
    {
        $alias = $this->alias();

        /** @var $dto AddressApiDtoInterface */
        if ($dto->hasId()) {
            $builder
                ->andWhere($alias.'.id = :id')
                ->setParameter('id', $dto->getId());
        }

        if ($dto->hasAddress()) {
            $builder
                ->andWhere($alias.'.address like :address')
                ->setParameter('address', '%'.$dto->getAddress().'%');
        }

        if ($dto->hasTown()) {
            $builder
                ->andWhere($alias.'.town like :town')
                ->setParameter('town', '%'.$dto->getTown().'%');
        }

        if ($dto->hasCountry()) {
            $builder
                ->andWhere($alias.'.country = :country')
                ->setParameter('country', $dto->getCountry());
        }

        if ($dto->hasCountryCode()) {
            $builder
                ->andWhere($alias.'.countryCode = :countryCode')
                ->setParameter('countryCode', $dto->getCountryCode());
        }

        if ($dto->hasZip()) {
            $builder
                ->andWhere($alias.'.zip = :countrycode')
                ->setParameter('countrycode', $dto->getZip());
        }

        if ($dto->hasActive()) {
            $builder
                ->andWhere($alias.'.active = :active')
                ->setParameter('active', $dto->getActive());
        }
    }
}
