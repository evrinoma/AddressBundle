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

namespace Evrinoma\AddressBundle\Tests\Functional\Helper;

use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

trait BaseAddressTestTrait
{
    protected function assertGet(string $id): array
    {
        $find = $this->get($id);
        $this->testResponseStatusOK();

        $this->checkResult($find);

        return $find;
    }

    protected function createAddress(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function createConstraintBlankAddress(): array
    {
        $query = static::getDefault([AddressApiDtoInterface::ADDRESS => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankTown(): array
    {
        $query = static::getDefault([AddressApiDtoInterface::TOWN => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankZip(): array
    {
        $query = static::getDefault([AddressApiDtoInterface::ZIP => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankCountryCode(): array
    {
        $query = static::getDefault([AddressApiDtoInterface::COUNTRY_CODE => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankCountry(): array
    {
        $query = static::getDefault([AddressApiDtoInterface::COUNTRY => '']);

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $entity);
        Assert::assertCount(1, $entity[PayloadModel::PAYLOAD]);
        $this->checkAddress($entity[PayloadModel::PAYLOAD][0]);
    }

    protected function checkAddress($entity): void
    {
        Assert::assertArrayHasKey(AddressApiDtoInterface::ID, $entity);
        Assert::assertArrayHasKey(AddressApiDtoInterface::ADDRESS, $entity);
        Assert::assertArrayHasKey(AddressApiDtoInterface::TOWN, $entity);
        Assert::assertArrayHasKey(AddressApiDtoInterface::ACTIVE, $entity);
        Assert::assertArrayHasKey(AddressApiDtoInterface::ZIP, $entity);
        Assert::assertArrayHasKey(AddressApiDtoInterface::COUNTRY_CODE, $entity);
        Assert::assertArrayHasKey(AddressApiDtoInterface::COUNTRY, $entity);
    }
}
