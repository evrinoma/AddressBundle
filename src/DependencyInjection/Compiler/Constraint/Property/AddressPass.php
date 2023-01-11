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

namespace Evrinoma\AddressBundle\DependencyInjection\Compiler\Constraint\Property;

use Evrinoma\AddressBundle\Validator\AddressValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class AddressPass extends AbstractConstraint implements CompilerPassInterface
{
    public const ADDRESS_CONSTRAINT = 'evrinoma.address.constraint.property';

    protected static string $alias = self::ADDRESS_CONSTRAINT;
    protected static string $class = AddressValidator::class;
    protected static string $methodCall = 'addPropertyConstraint';
}
