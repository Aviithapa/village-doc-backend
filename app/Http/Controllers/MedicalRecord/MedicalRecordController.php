<?php

namespace App\Http\Controllers\MedicalRecord;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalRecord\CreateMedicalRecordRequest;
use App\Http\Resources\MedicalRecord\MedicalRecordResource;
use App\Services\MedicalRecord\MedicalRecordCreator;
use App\Services\MedicalRecord\MedicalRecordGetter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MedicalRecordController extends Controller
{

    use ApiResponser;
    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @param LabReportGetter $MedicalRecordGetter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, MedicalRecordGetter $medicalRecordGetter): AnonymousResourceCollection
    {
        return  MedicalRecordResource::collection($medicalRecordGetter->getPaginatedList($request));
    }


    /**
     * Store a newly created resource in storage.
     *  
     * @param CreateMedicalRecordRequest $request
     * @param MedicalRecordCreator $labResu;tCreator
     * @return JsonResponse
     */
    public function store(CreateMedicalRecordRequest $request, MedicalRecordCreator $medicalRecordCreator)
    {
        //
        $data = $request->all();
        return $medicalRecordCreator->store($data);
    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $id
     * @param MedicalRecordCreator $MedicalRecordCreator
     * @return JsonResponse
     */
    public function show(string $id, MedicalRecordGetter $MedicalRecordGetter): JsonResponse
    {
        $medicalRecord = MedicalRecordResource::make($MedicalRecordGetter->show($id));
        $vitals = $medicalRecord->patient->vitals->groupBy('created_at');
        $medicalRecord->patient->vitals = $vitals;
        return  $this->successResponse($medicalRecord);
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
