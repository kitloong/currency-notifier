<?php

namespace App\Http\Controllers\Api;

use App\CurrencyRate\CurrencyProfile;
use App\Http\Resources\CurrencyProfileCollection;
use App\Http\Resources\CurrencyProfileResource;
use App\Repositories\Interfaces\CurrencyProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="Currency Profiles",
 *     description="Everything about your Projects",
 *     @OA\ExternalDocumentation(
 *         description="Find out more",
 *         url="http://swagger.io"
 *     )
 * )
 *
 * Class CurrencyProfileController
 * @package App\Http\Controllers\Api
 */
class CurrencyProfileController extends ApiController
{
    private $currencyProfileRepository;

    public function __construct(CurrencyProfileRepository $currencyProfileRepository)
    {
        $this->currencyProfileRepository = $currencyProfileRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/currency-profiles",
     *     tags={"Currency Profiles"},
     *     summary="Get list of currency profiles",
     *     description="Returns list of currency profiles",
     *     @OA\Response(
     *         response=200,
     *         description="Json content"
     *     ),
     *     @OA\Response(response=400, description="Bad request")
     * )
     *
     * Display a listing of the resource.
     *
     * @return CurrencyProfileCollection
     */
    public function index()
    {
        return new CurrencyProfileCollection($this->currencyProfileRepository->findAll());
    }

    /**
     * @OA\Post(
     *     path="/api/currency-profiles",
     *     tags={"Currency Profiles"},
     *     summary="Create a new currency profile",
     *     description="",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="currencies",
     *                     description="Currency rate you wish to check. eg: CNY->MYR",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="satisfactory_threshold",
     *                     description="Rate that you are happy with",
     *                     type="number",
     *                 ),
     *                 @OA\Property(
     *                     property="warning_threshold",
     *                     description="Rate at dangerous parameter",
     *                     type="number",
     *                 ),
     *                 @OA\Property(
     *                     property="is_active",
     *                     description="1 = Enabled, 0 = Disabled",
     *                     type="boolean",
     *                     enum={1, 0},
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Json content"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable entity"
     *     ),
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'currencies' => 'required|max:255',
            'satisfactory_threshold' => 'required|numeric|min:0',
            'warning_threshold' => 'required|numeric|min:0',
            'is_active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response([
                "message" => "The given data was invalid.",
                'errors' => $validator->errors()->messages()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $currencyProfile = new CurrencyProfile();
        $currencyProfile->currencies = $request->input('currencies');
        $currencyProfile->satisfactory_threshold = $request->input('satisfactory_threshold');
        $currencyProfile->warning_threshold = $request->input('warning_threshold');
        $currencyProfile->is_active = $request->input('is_active');
        $currencyProfile->save();

        return response([], Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/api/currency-profiles/{id}",
     *     tags={"Currency Profiles"},
     *     summary="Find currency profile by id",
     *     description="Returns a single currency profile",
     *     @OA\Parameter(
     *         description="ID of currency profile to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Json content"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     ),
     * )
     *
     * Display the specified resource.
     *
     * @param CurrencyProfile $currencyProfile
     * @return CurrencyProfileResource
     */
    public function show(CurrencyProfile $currencyProfile)
    {
        return new CurrencyProfileResource($currencyProfile);
    }

    /**
     * @OA\Put(
     *     path="/api/currency-profiles/{id}",
     *     tags={"Currency Profiles"},
     *     summary="Update an existing currency profile",
     *     description="",
     *     @OA\Parameter(
     *         description="ID of existing currency profile to update",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="currencies",
     *                     description="Currency rate you wish to check. eg: CNY->MYR",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="satisfactory_threshold",
     *                     description="Rate that you are happy with",
     *                     type="number",
     *                 ),
     *                 @OA\Property(
     *                     property="warning_threshold",
     *                     description="Rate at dangerous parameter",
     *                     type="number",
     *                 ),
     *                 @OA\Property(
     *                     property="is_active",
     *                     description="1 = Enabled, 0 = Disabled",
     *                     type="boolean",
     *                     enum={1, 0},
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=202,
     *         description="Json content"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable entity"
     *     )
     * )
     *
     * Update the specified resource in storage.
     *
     * @param CurrencyProfile $currencyProfile
     * @param Request $request
     * @return Response
     */
    public function update(CurrencyProfile $currencyProfile, Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'currencies' => 'required|max:255',
            'satisfactory_threshold' => 'required|numeric|min:0',
            'warning_threshold' => 'required|numeric|min:0',
            'is_active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response([
                "message" => "The given data was invalid.",
                'errors' => $validator->errors()->messages()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $currencyProfile->currencies = $request->input('currencies');
        $currencyProfile->satisfactory_threshold = $request->input('satisfactory_threshold');
        $currencyProfile->warning_threshold = $request->input('warning_threshold');
        $currencyProfile->is_active = $request->input('is_active');
        $currencyProfile->save();

        return response([], Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *     path="/api/currency-profiles/{id}",
     *     tags={"Currency Profiles"},
     *     summary="Delete an existing currency profile by id",
     *     description="",
     *     @OA\Parameter(
     *         description="ID of currency profile to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Json content"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param CurrencyProfile $currencyProfile
     * @return Response
     * @throws \Exception
     */
    public function destroy(CurrencyProfile $currencyProfile)
    {
        $currencyProfile->delete();
        return response([], Response::HTTP_NO_CONTENT);
    }
}
