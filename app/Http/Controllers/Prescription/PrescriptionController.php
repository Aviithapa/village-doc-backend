<?php

namespace App\Http\Controllers\Prescription;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Prescription\CreatePrescriptionRequest;
use App\Http\Resources\Prescription\PrescriptionResource;
use App\Services\Prescription\PrescriptionCreator;
use App\Services\Prescription\PrescriptionGetter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PrescriptionController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @param LabReportGetter $PrescriptionGetter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, PrescriptionGetter $prescriptionGetter): AnonymousResourceCollection
    {
        return  PrescriptionResource::collection($prescriptionGetter->getPaginatedList($request));
    }


    /**
     * Store a newly created resource in storage.
     *  
     * @param CreatePrescriptionRequest $request
     * @param PrescriptionCreator $labResu;tCreator
     * @return JsonResponse
     */
    public function store(CreatePrescriptionRequest $request, PrescriptionCreator $PrescriptionCreator): JsonResponse
    {
        //
        $data = $request->all();

        return $this->successResponse(
            PrescriptionResource::make($PrescriptionCreator->store($data)),
            __('Prescription.create_success'),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $id
     * @param PrescriptionCreator $PrescriptionCreator
     * @return JsonResponse
     */
    public function show(string $id, PrescriptionGetter $prescriptionGetter): JsonResponse
    {
        return  $this->successResponse(PrescriptionResource::make($prescriptionGetter->show($id)));
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
