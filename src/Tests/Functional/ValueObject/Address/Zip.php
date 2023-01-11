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

namespace Evrinoma\AddressBundle\Tests\Functional\ValueObject\Address;

use Evrinoma\TestUtilsBundle\ValueObject\Common\AbstractId;

class Zip extends AbstractId
{
    protected static string $value = '100017';
    protected static string $default = '640003';

    public static function default(): string
    {
        return static::$default;
    }
}
