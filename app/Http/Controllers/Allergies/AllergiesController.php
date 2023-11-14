<?php

namespace App\Http\Controllers\Allergies;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Allergies\CreateAllergiesRequest;
use App\Http\Resources\Allergies\AllergiesResource;
use App\Services\Allergies\AllergiesCreator;
use App\Services\Allergies\AllergiesGetter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AllergiesController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, AllergiesGetter $dataGetter): AnonymousResourceCollection
    {
        return  AllergiesResource::collection($dataGetter->getPaginatedList($request));
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @param CreateAllergiesRequest $request
     * @param  AllergiesCreator $allergiesCreator
     * @return JsonResponse
     */
    public function store(CreateAllergiesRequest $request, AllergiesCreator $allergiesCreator): JsonResponse
    {
        //
        $data = $request->all();

        return $this->successResponse(
            $allergiesCreator->store($data),
            __('patient.create_success'),
            Response::HTTP_CREATED
        );
    }


    /**
     * Display the specified resource.
     * 
     * @param  int  $id
     * @param  AllergiesGetter $allergiesGetter
     * @return JsonResponse
     */
    public function show(string $id, AllergiesGetter $allergiesGetter): JsonResponse
    {
        //
        return  $this->successResponse($allergiesGetter->show($id));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Todo
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Todo
    }
}
