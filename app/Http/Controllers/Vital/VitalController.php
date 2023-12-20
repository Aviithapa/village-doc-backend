<?php

namespace App\Http\Controllers\Vital;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vital\CreateVitalRequest;
use App\Http\Resources\Vital\VitalResource;
use App\Services\Vital\VitalCreator;
use App\Services\Vital\VitalGetter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class VitalController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @param PatientsGetter $patientsGetter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, VitalGetter $vitalGetter): AnonymousResourceCollection
    {
        return  VitalResource::collection($vitalGetter->getPaginatedList($request));
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @param CreatePatientsRequest $request
     * @param PatientsCreator $patientsCreator
     * @return JsonResponse
     */
    public function store(CreateVitalRequest $request, VitalCreator $vitalCreator): JsonResponse
    {
        //
        $data = $request->all();

        return $this->successResponse(
            $vitalCreator->store($data),
            __('global.vitals.create_success'),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $id
     * @param PatientsGetter $patientsGetter
     * @return JsonResponse
     */
    public function show(string $id, VitalGetter $vitalGetter): JsonResponse
    {
        //
        return  $this->successResponse(VitalResource::make($vitalGetter->show($id)));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
