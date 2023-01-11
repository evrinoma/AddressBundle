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

namespace Evrinoma\AddressBundle\DtoCommon\ValueObject\Mutable;

use Evrinoma\AddressBundle\DtoCommon\ValueObject\Immutable\CountryCodeTrait as CountryCodeImmutableTrait;
use Evrinoma\DtoBundle\Dto\DtoInterface;

trait CountryCodeTrait
{
    use CountryCodeImmutableTrait;

    /**
     * @param string $countryCode
     *
     * @return DtoInterface
     */
    protected function setCountryCode(string $countryCode): DtoInterface
    {
        $this->countryCode = trim($countryCode);

        return $this;
    }
}
