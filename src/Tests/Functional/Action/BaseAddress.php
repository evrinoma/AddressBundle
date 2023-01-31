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

namespace Evrinoma\AddressBundle\Tests\Functional\Action;

use Evrinoma\AddressBundle\Dto\AddressApiDto;
use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Tests\Functional\Helper\BaseAddressTestTrait;
use Evrinoma\AddressBundle\Tests\Functional\ValueObject\Address\Active;
use Evrinoma\AddressBundle\Tests\Functional\ValueObject\Address\Address;
use Evrinoma\AddressBundle\Tests\Functional\ValueObject\Address\Country;
use Evrinoma\AddressBundle\Tests\Functional\ValueObject\Address\CountryCode;
use Evrinoma\AddressBundle\Tests\Functional\ValueObject\Address\Id;
use Evrinoma\AddressBundle\Tests\Functional\ValueObject\Address\Town;
use Evrinoma\AddressBundle\Tests\Functional\ValueObject\Address\Zip;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\UtilsBundle\Model\ActiveModel;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

class BaseAddress extends AbstractServiceTest implements BaseAddressTestInterface
{
    use BaseAddressTestTrait;

    public const API_GET = 'evrinoma/api/address';
    public const API_CRITERIA = 'evrinoma/api/address/criteria';
    public const API_DELETE = 'evrinoma/api/address/delete';
    public const API_PUT = 'evrinoma/api/address/save';
    public const API_POST = 'evrinoma/api/address/create';

    protected static function getDtoClass(): string
    {
        return AddressApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            AddressApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            AddressApiDtoInterface::ID => Id::value(),
            AddressApiDtoInterface::ZIP => Zip::default(),
            AddressApiDtoInterface::ACTIVE => Active::value(),
            AddressApiDtoInterface::TOWN => Town::default(),
            AddressApiDtoInterface::ADDRESS => Address::value(),
            AddressApiDtoInterface::COUNTRY_CODE => CountryCode::value(),
            AddressApiDtoInterface::COUNTRY => Country::value(),
        ];
    }

    public function actionPost(): void
    {
        $created = $this->createAddress();
        $this->testResponseStatusCreated();
    }

    public function actionCriteriaNotFound(): void
    {
        $find = $this->criteria([
            AddressApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            AddressApiDtoInterface::ACTIVE => Active::wrong(),
        ]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);

        $find = $this->criteria([
            AddressApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            AddressApiDtoInterface::ID => Id::value(),
            AddressApiDtoInterface::ACTIVE => Active::block(),
            AddressApiDtoInterface::ZIP => Zip::wrong(),
        ]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);
    }

    public function actionCriteria(): void
    {
        $find = $this->criteria([
            AddressApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            AddressApiDtoInterface::ACTIVE => Active::value(),
            AddressApiDtoInterface::ID => Id::value(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([
            AddressApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            AddressApiDtoInterface::ACTIVE => Active::delete(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(3, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([
            AddressApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            AddressApiDtoInterface::ACTIVE => Active::delete(),
            AddressApiDtoInterface::ZIP => Zip::value(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([
            AddressApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            AddressApiDtoInterface::COUNTRY => Country::value(),
            AddressApiDtoInterface::COUNTRY_CODE => CountryCode::value(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(4, $find[PayloadModel::PAYLOAD]);
    }

    public function actionDelete(): void
    {
        $find = $this->assertGet(Id::value());

        Assert::assertEquals(ActiveModel::ACTIVE, $find[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::ACTIVE]);

        $this->delete(Id::value());
        $this->testResponseStatusAccepted();

        $delete = $this->assertGet(Id::value());

        Assert::assertEquals(ActiveModel::DELETED, $delete[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::ACTIVE]);
    }

    public function actionPut(): void
    {
        $find = $this->assertGet(Id::value());

        $updated = $this->put(static::getDefault([
            AddressApiDtoInterface::ID => Id::value(),
            AddressApiDtoInterface::ZIP => Zip::value(),
            AddressApiDtoInterface::TOWN => Town::value(),
            AddressApiDtoInterface::ADDRESS => Address::value(),
            AddressApiDtoInterface::COUNTRY_CODE => CountryCode::value(),
            AddressApiDtoInterface::COUNTRY => Country::value(),
        ]));
        $this->testResponseStatusOK();

        Assert::assertEquals($find[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::ID], $updated[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::ID]);
        Assert::assertEquals(Zip::value(), $updated[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::ZIP]);
        Assert::assertEquals(Town::value(), $updated[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::TOWN]);
        Assert::assertEquals(Address::value(), $updated[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::ADDRESS]);
        Assert::assertEquals(Country::value(), $updated[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::COUNTRY]);
        Assert::assertEquals(CountryCode::value(), $updated[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::COUNTRY_CODE]);
    }

    public function actionGet(): void
    {
        $find = $this->assertGet(Id::value());
    }

    public function actionGetNotFound(): void
    {
        $response = $this->get(Id::wrong());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteNotFound(): void
    {
        $response = $this->delete(Id::wrong());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteUnprocessable(): void
    {
        $response = $this->delete(Id::blank());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPutNotFound(): void
    {
        $this->put(static::getDefault([
            AddressApiDtoInterface::ID => Id::wrong(),
            AddressApiDtoInterface::ZIP => Zip::wrong(),
            AddressApiDtoInterface::TOWN => Town::wrong(),
            AddressApiDtoInterface::ADDRESS => Address::wrong(),
            AddressApiDtoInterface::COUNTRY => Country::wrong(),
            AddressApiDtoInterface::COUNTRY_CODE => CountryCode::wrong(),
        ]));
        $this->testResponseStatusNotFound();
    }

    public function actionPutUnprocessable(): void
    {
        $created = $this->createAddress();
        $this->testResponseStatusCreated();
        $this->checkResult($created);

        $query = static::getDefault([
            AddressApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::ID],
            AddressApiDtoInterface::ZIP => Zip::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault([
            AddressApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::ID],
            AddressApiDtoInterface::TOWN => Town::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault([
            AddressApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::ID],
            AddressApiDtoInterface::ADDRESS => Address::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault([
            AddressApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::ID],
            AddressApiDtoInterface::COUNTRY_CODE => CountryCode::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault([
            AddressApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][AddressApiDtoInterface::ID],
            AddressApiDtoInterface::COUNTRY => Country::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPostDuplicate(): void
    {
        $this->createAddress();
        $this->testResponseStatusCreated();
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPostUnprocessable(): void
    {
        $this->postWrong();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankAddress();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankTown();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankZip();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankCountry();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankCountryCode();
        $this->testResponseStatusUnprocessable();
    }
}
