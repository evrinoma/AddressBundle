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

namespace Evrinoma\AddressBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\AddressBundle\Dto\AddressApiDtoInterface;
use Evrinoma\AddressBundle\Exception\AddressCannotBeSavedException;
use Evrinoma\AddressBundle\Exception\AddressInvalidException;
use Evrinoma\AddressBundle\Exception\AddressNotFoundException;
use Evrinoma\AddressBundle\Facade\Address\FacadeInterface;
use Evrinoma\AddressBundle\Serializer\GroupInterface;
use Evrinoma\DtoBundle\Factory\FactoryDtoInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class AddressApiController extends AbstractWrappedApiController implements ApiControllerInterface
{
    private string $dtoClass;

    private ?Request $request;

    private FactoryDtoInterface $factoryDto;

    private FacadeInterface $facade;

    public function __construct(
        SerializerInterface $serializer,
        RequestStack $requestStack,
        FactoryDtoInterface $factoryDto,
        FacadeInterface $facade,
        string $dtoClass
    ) {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->factoryDto = $factoryDto;
        $this->dtoClass = $dtoClass;
        $this->facade = $facade;
    }

    /**
     * @Rest\Post("/api/address/create", options={"expose": true}, name="api_address_create")
     * @OA\Post(
     *     tags={"address"},
     *     description="the method perform create address",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\AddressBundle\Dto\AddressApiDto",
     *                     "country": "Россия",
     *                     "country_code": "de",
     *                     "town": "Ташкент",
     *                     "zip": "640003",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\AddressBundle\Dto\AddressApiDto"),
     *                 @OA\Property(property="country", type="string"),
     *                 @OA\Property(property="country_code", type="string"),
     *                 @OA\Property(property="address", type="string"),
     *                 @OA\Property(property="town", type="string"),
     *                 @OA\Property(property="zip", type="string"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create address")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        /** @var AddressApiDtoInterface $addressApiDto */
        $addressApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusCreated();

        $json = [];
        $error = [];
        $group = GroupInterface::API_POST_ADDRESS;

        try {
            $this->facade->post($addressApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Create address', $json, $error);
    }

    /**
     * @Rest\Put("/api/address/save", options={"expose": true}, name="api_address_save")
     * @OA\Put(
     *     tags={"address"},
     *     description="the method perform save address for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\AddressBundle\Dto\AddressApiDto",
     *                     "active": "b",
     *                     "country": "Россия",
     *                     "country_code": "de",
     *                     "town": "Ташкент",
     *                     "zip": "640003",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\AddressBundle\Dto\AddressApiDto"),
     *                 @OA\Property(property="id", type="string"),
     *                 @OA\Property(property="active", type="string"),
     *                 @OA\Property(property="country", type="string"),
     *                 @OA\Property(property="country_code", type="string"),
     *                 @OA\Property(property="address", type="string"),
     *                 @OA\Property(property="town", type="string"),
     *                 @OA\Property(property="zip", type="string"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save address")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        /** @var AddressApiDtoInterface $addressApiDto */
        $addressApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_PUT_ADDRESS;

        try {
            $this->facade->put($addressApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Save address', $json, $error);
    }

    /**
     * @Rest\Delete("/api/address/delete", options={"expose": true}, name="api_address_delete")
     * @OA\Delete(
     *     tags={"address"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\AddressBundle\Dto\AddressApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Delete address")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        /** @var AddressApiDtoInterface $addressApiDto */
        $addressApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->facade->delete($addressApiDto, '', $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete address', $json, $error);
    }

    /**
     * @Rest\Get("/api/address/criteria", options={"expose": true}, name="api_address_criteria")
     * @OA\Get(
     *     tags={"address"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\AddressBundle\Dto\AddressApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="address",
     *         in="query",
     *         name="address",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="country",
     *         in="query",
     *         name="country",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="zip",
     *         in="query",
     *         name="zip",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Country Code",
     *         in="query",
     *         name="country_code",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="town",
     *         in="query",
     *         name="town",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * )
     * @OA\Response(response=200, description="Return address")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var AddressApiDtoInterface $addressApiDto */
        $addressApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_CRITERIA_ADDRESS;

        try {
            $this->facade->criteria($addressApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get address', $json, $error);
    }

    /**
     * @Rest\Get("/api/address", options={"expose": true}, name="api_address")
     * @OA\Get(
     *     tags={"address"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\AddressBundle\Dto\AddressApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return address")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var AddressApiDtoInterface $addressApiDto */
        $addressApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_GET_ADDRESS;

        try {
            $this->facade->get($addressApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get address', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof AddressCannotBeSavedException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof AddressNotFoundException:
                $this->setStatusNotFound();
                break;
            case $e instanceof AddressInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
