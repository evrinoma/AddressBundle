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

namespace Evrinoma\AddressBundle\Form\Rest\Address;

use Doctrine\DBAL\Exception\TableNotFoundException;
use Evrinoma\AddressBundle\Dto\AddressApiDto;
use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Exception\AddressNotFoundException;
use Evrinoma\AddressBundle\Manager\QueryManagerInterface;
use Evrinoma\UtilsBundle\Form\Rest\RestChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressChoiceType extends AbstractType
{
    private QueryManagerInterface $queryManager;

    public function __construct(QueryManagerInterface $queryManager)
    {
        $this->queryManager = $queryManager;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $callback = function (Options $options) {
            $value = [];
            try {
                if ($options->offsetExists('data')) {
                    $criteria = $this->queryManager->criteria(new AddressApiDto());
                    switch ($options->offsetGet('data')) {
                        case AddressApiDtoInterface::ADDRESS:
                            foreach ($criteria as $entity) {
                                $value[] = $entity->getAddress();
                            }
                            break;
                        default:
                            foreach ($criteria as $entity) {
                                $value[] = $entity->getId();
                            }
                    }
                } else {
                    throw new AddressNotFoundException();
                }
            } catch (TableNotFoundException|AddressNotFoundException $e) {
                $value = RestChoiceType::REST_CHOICES_DEFAULT;
            }

            return $value;
        };
        $resolver->setDefault(RestChoiceType::REST_COMPONENT_NAME, 'address');
        $resolver->setDefault(RestChoiceType::REST_DESCRIPTION, 'addressList');
        $resolver->setDefault(RestChoiceType::REST_CHOICES, $callback);
    }

    public function getParent()
    {
        return RestChoiceType::class;
    }
}
