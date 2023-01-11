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

namespace Evrinoma\AddressBundle\Dto;

use Evrinoma\AddressBundle\DtoCommon\ValueObject\Mutable\AddressTrait;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Mutable\CountryCodeTrait;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Mutable\CountryTrait;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Mutable\TownTrait;
use Evrinoma\AddressBundle\DtoCommon\ValueObject\Mutable\ZipTrait;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\ActiveTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Symfony\Component\HttpFoundation\Request;

class AddressApiDto extends AbstractDto implements AddressApiDtoInterface
{
    use ActiveTrait;
    use AddressTrait;
    use CountryCodeTrait;
    use CountryTrait;
    use IdTrait;
    use TownTrait;
    use ZipTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $active = $request->get(AddressApiDtoInterface::ACTIVE);
            $id = $request->get(AddressApiDtoInterface::ID);
            $address = $request->get(AddressApiDtoInterface::ADDRESS);
            $town = $request->get(AddressApiDtoInterface::TOWN);
            $zip = $request->get(AddressApiDtoInterface::ZIP);
            $country = $request->get(AddressApiDtoInterface::COUNTRY);
            $countryCode = $request->get(AddressApiDtoInterface::COUNTRY_CODE);

            if ($active) {
                $this->setActive($active);
            }
            if ($id) {
                $this->setId($id);
            }
            if ($address) {
                $this->setAddress($address);
            }
            if ($town) {
                $this->setTown($town);
            }
            if ($zip) {
                $this->setZip($zip);
            }
            if ($country) {
                $this->setCountry($country);
            }
            if ($countryCode) {
                $this->setCountryCode($countryCode);
            }
        }

        return $this;
    }
}
