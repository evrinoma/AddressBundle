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

namespace Evrinoma\AddressBundle\DtoCommon\ValueObject\Preserve;

use Evrinoma\DtoBundle\Dto\DtoInterface;

trait CountryCodeTrait
{
    /**
     * @param string $countryCode
     *
     * @return DtoInterface
     */
    public function setCountryCode(string $countryCode): DtoInterface
    {
        return parent::setCountryCode($countryCode);
    }
}
