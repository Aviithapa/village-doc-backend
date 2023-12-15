<?php

namespace App\Http\Controllers\MedicalRecord;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalRecord\CreateMedicalRecordRequest;
use App\Http\Requests\MedicalRecord\MedicalRecordStatusRequest;
use App\Http\Requests\MedicalRecord\UpdateMedicalRecordRequest;
use App\Http\Resources\MedicalRecord\MedicalRecordListResource;
use App\Http\Resources\MedicalRecord\MedicalRecordResource;
use App\Services\MedicalRecord\MedicalRecordCreator;
use App\Services\MedicalRecord\MedicalRecordGetter;
use App\Services\MedicalRecord\MedicalRecordUpdater;
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
        return  MedicalRecordListResource::collection($medicalRecordGetter->getPaginatedList($request));
    }


    /**
     * Store a newly created resource in storage.
     *  
     * @param CreateMedicalRecordRequest $request
     * @param MedicalRecordCreator $medicalRecordCreator
     * @return JsonResponse
     */
    public function store(CreateMedicalRecordRequest $request, MedicalRecordCreator $medicalRecordCreator)
    {
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
    public function update(UpdateMedicalRecordRequest $request,MedicalRecordUpdater $medicalRecordUpdater, string $id)
    {
        $data = $request->all();
        return $this->successResponse($medicalRecordUpdater->update($id,$data),__('global.medical.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalRecordUpdater $medicalRecordUpdater,string $id)
    {
        return $this->successResponse($medicalRecordUpdater->destroy($id),__("global.medical.delete_success"));
    }

    public function medicalRecordDescription(MedicalRecordStatusRequest $request,MedicalRecordCreator $medicalRecordCreator)
    {
        $data = $request->all();
        $medicalRecordCreator->storeMedicalStatus($data);
        return $this->successResponse(
            $medicalRecordCreator->storeMedicalStatus($data),
            __('global.medical.status_change_success'),
            Response::HTTP_CREATED
        );
    }
}
