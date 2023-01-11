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

namespace Evrinoma\AddressBundle\Model\Address;

use Evrinoma\UtilsBundle\Entity\ActiveInterface;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtInterface;
use Evrinoma\UtilsBundle\Entity\IdInterface;

interface AddressInterface extends ActiveInterface, CreateUpdateAtInterface, IdInterface
{
    /**
     * @return string
     */
    public function getAddress(): ?string;

    /**
     * @param string $address
     *
     * @return self
     */
    public function setAddress(string $address): self;

    /**
     * @return string
     */
    public function getCountry(): ?string;

    /**
     * @param string $country
     *
     * @return self
     */
    public function setCountry(string $country): self;

    /**
     * @return string
     */
    public function getCountryCode(): ?string;

    /**
     * @param string $countryCode
     *
     * @return self
     */
    public function setCountryCode(string $countryCode): self;

    /**
     * @return string
     */
    public function getZip(): ?string;

    /**
     * @param string $zip
     *
     * @return self
     */
    public function setZip(string $zip): self;

    /**
     * @return string
     */
    public function getTown(): ?string;

    /**
     * @param string $town
     *
     * @return self
     */
    public function setTown(string $town): self;
}
