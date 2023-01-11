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

use Evrinoma\AddressBundle\DtoCommon\ValueObject\Immutable\ZipTrait as ZipImmutableTrait;
use Evrinoma\DtoBundle\Dto\DtoInterface;

trait ZipTrait
{
    use ZipImmutableTrait;

    /**
     * @param string $zip
     *
     * @return DtoInterface
     */
    protected function setZip(string $zip): DtoInterface
    {
        $this->zip = trim($zip);

        return $this;
    }
}
