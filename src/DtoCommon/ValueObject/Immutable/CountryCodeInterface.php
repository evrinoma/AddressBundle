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

namespace Evrinoma\AddressBundle\DtoCommon\ValueObject\Immutable;

interface CountryCodeInterface
{
    public const COUNTRY_CODE = 'country_code';

    /**
     * @return bool
     */
    public function hasCountryCode(): bool;

    /**
     * @return string
     */
    public function getCountryCode(): string;
}
