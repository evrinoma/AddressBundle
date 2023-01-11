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

namespace Evrinoma\AddressBundle;

use Evrinoma\AddressBundle\DependencyInjection\Compiler\Constraint\Property\AddressPass;
use Evrinoma\AddressBundle\DependencyInjection\Compiler\DecoratorPass;
use Evrinoma\AddressBundle\DependencyInjection\Compiler\MapEntityPass;
use Evrinoma\AddressBundle\DependencyInjection\Compiler\ServicePass;
use Evrinoma\AddressBundle\DependencyInjection\EvrinomaAddressExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaAddressBundle extends Bundle
{
    public const BUNDLE = 'address';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container
            ->addCompilerPass(new MapEntityPass($this->getNamespace(), $this->getPath()))
            ->addCompilerPass(new DecoratorPass())
            ->addCompilerPass(new ServicePass())
            ->addCompilerPass(new AddressPass())
        ;
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaAddressExtension();
        }

        return $this->extension;
    }
}
