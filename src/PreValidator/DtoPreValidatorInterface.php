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

namespace Evrinoma\AddressBundle\PreValidator;

use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Exception\AddressInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param AddressApiDtoInterface $dto
     *
     * @throws AddressInvalidException
     */
    public function onPost(AddressApiDtoInterface $dto): void;

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @throws AddressInvalidException
     */
    public function onPut(AddressApiDtoInterface $dto): void;

    /**
     * @param AddressApiDtoInterface $dto
     *
     * @throws AddressInvalidException
     */
    public function onDelete(AddressApiDtoInterface $dto): void;
}
