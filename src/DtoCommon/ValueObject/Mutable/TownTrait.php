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

use Evrinoma\AddressBundle\DtoCommon\ValueObject\Immutable\TownTrait as TownImmutableTrait;
use Evrinoma\DtoBundle\Dto\DtoInterface;

trait TownTrait
{
    use TownImmutableTrait;

    /**
     * @param string $town
     *
     * @return DtoInterface
     */
    protected function setTown(string $town): DtoInterface
    {
        $this->town = trim($town);

        return $this;
    }
}
