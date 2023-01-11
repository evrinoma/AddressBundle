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

namespace Evrinoma\AddressBundle\Serializer;

interface GroupInterface
{
    public const API_POST_ADDRESS = 'API_POST_ADDRESS';
    public const API_PUT_ADDRESS = 'API_PUT_ADDRESS';
    public const API_GET_ADDRESS = 'API_GET_ADDRESS';
    public const API_CRITERIA_ADDRESS = self::API_GET_ADDRESS;
    public const APP_GET_BASIC_ADDRESS = 'APP_GET_BASIC_ADDRESS';
}
