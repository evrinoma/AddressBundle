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

trait TownTrait
{
    private string $town = '';

    public function hasTown(): bool
    {
        return '' !== $this->town;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }
}
