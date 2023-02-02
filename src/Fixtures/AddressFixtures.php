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

namespace Evrinoma\AddressBundle\Fixtures;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Entity\Address\BaseAddress;
use Evrinoma\TestUtilsBundle\Fixtures\AbstractFixture;

class AddressFixtures extends AbstractFixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    protected static array $data = [
        [
            AddressApiDtoInterface::ZIP => '100015',
            AddressApiDtoInterface::TOWN => 'Курган',
            AddressApiDtoInterface::ACTIVE => 'a',
            AddressApiDtoInterface::ADDRESS => 'ул. Тимофея Невежина, 3, корп. 4',
            AddressApiDtoInterface::COUNTRY_CODE => 'RU',
            AddressApiDtoInterface::COUNTRY => 'Russia',
            'created_at' => '2008-10-23 10:21:50',
        ],
        [
            AddressApiDtoInterface::ZIP => '100016',
            AddressApiDtoInterface::TOWN => 'Санкт-Петербург',
            AddressApiDtoInterface::ACTIVE => 'a',
            AddressApiDtoInterface::ADDRESS => 'ул. Жуковского, д. 63',
            AddressApiDtoInterface::COUNTRY_CODE => 'MO',
            AddressApiDtoInterface::COUNTRY => 'Russia',
            'created_at' => '2015-10-23 10:21:50',
        ],
        [
            AddressApiDtoInterface::ZIP => '100022',
            AddressApiDtoInterface::TOWN => 'GERMANY',
            AddressApiDtoInterface::ACTIVE => 'a',
            AddressApiDtoInterface::ADDRESS => 'ул. Шахрисабзская 22',
            AddressApiDtoInterface::COUNTRY_CODE => 'DE',
            AddressApiDtoInterface::COUNTRY => 'GERMANY',
            'created_at' => '2020-10-23 10:21:50',
        ],
        [
            AddressApiDtoInterface::ZIP => '100018',
            AddressApiDtoInterface::TOWN => 'Ташкент',
            AddressApiDtoInterface::ACTIVE => 'a',
            AddressApiDtoInterface::ADDRESS => 'ул. Шахрисабзская 22',
            AddressApiDtoInterface::COUNTRY_CODE => 'DE',
            AddressApiDtoInterface::COUNTRY => 'Республика Узбекистан',
            'created_at' => '2020-10-23 10:21:50',
        ],
        [
            AddressApiDtoInterface::ZIP => '100017',
            AddressApiDtoInterface::TOWN => 'Москва',
            AddressApiDtoInterface::ACTIVE => 'd',
            AddressApiDtoInterface::ADDRESS => 'Просвирин переулок, д.4, этаж 3',
            AddressApiDtoInterface::COUNTRY_CODE => 'EU',
            AddressApiDtoInterface::COUNTRY => 'Russia',
            'created_at' => '2015-10-23 10:21:50',
            ],
        [
            AddressApiDtoInterface::ZIP => '100019',
            AddressApiDtoInterface::TOWN => 'Екатеринбург',
            AddressApiDtoInterface::ACTIVE => 'b',
            AddressApiDtoInterface::ADDRESS => 'ул. Московская, 48Г',
            AddressApiDtoInterface::COUNTRY_CODE => 'RU',
            AddressApiDtoInterface::COUNTRY => 'Russia',
            'created_at' => '2010-10-23 10:21:50',
        ],
        [
            AddressApiDtoInterface::ZIP => '100020',
            AddressApiDtoInterface::TOWN => 'Тюмень',
            AddressApiDtoInterface::ACTIVE => 'd',
            AddressApiDtoInterface::ADDRESS => 'ул. Баумана, 29',
            AddressApiDtoInterface::COUNTRY_CODE => 'RU',
            AddressApiDtoInterface::COUNTRY => 'Russia',
            'created_at' => '2010-10-23 10:21:50',
            ],
        [
            AddressApiDtoInterface::ZIP => '100021',
            AddressApiDtoInterface::TOWN => 'Новосибирск',
            AddressApiDtoInterface::ACTIVE => 'd',
            AddressApiDtoInterface::ADDRESS => 'ул.Планировочная, 18/1',
            AddressApiDtoInterface::COUNTRY_CODE => 'RU',
            AddressApiDtoInterface::COUNTRY => 'Russia',
            'created_at' => '2011-10-23 10:21:50',
        ],
    ];

    protected static string $class = BaseAddress::class;

    /**
     * @param ObjectManager $manager
     *
     * @return $this
     *
     * @throws \Exception
     */
    protected function create(ObjectManager $manager): self
    {
        $short = static::getReferenceName();
        $i = 0;

        foreach ($this->getData() as $record) {
            /** @var BaseAddress $entity */
            $entity = $this->getEntity();
            $entity
                ->setZip($record[AddressApiDtoInterface::ZIP])
                ->setTown($record[AddressApiDtoInterface::TOWN])
                ->setAddress($record[AddressApiDtoInterface::ADDRESS])
                ->setCountryCode($record[AddressApiDtoInterface::COUNTRY_CODE])
                ->setCountry($record[AddressApiDtoInterface::COUNTRY])
                ->setCreatedAt(new \DateTimeImmutable($record['created_at']))
                ->setActive($record[AddressApiDtoInterface::ACTIVE])
            ;

            $this->expandEntity($entity, $record);

            $this->addReference($short.$i, $entity);
            $manager->persist($entity);
            ++$i;
        }

        return $this;
    }

    public static function getGroups(): array
    {
        return [
            FixtureInterface::ADDRESS_FIXTURES,
        ];
    }

    public function getOrder()
    {
        return 0;
    }
}
