<?php

namespace App\Http\Controllers\MedicalRecord;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalRecord\MedicalRecordComplaintRequest;
use App\Http\Resources\MedicalRecord\MedicalRecordComplaintResource;
use App\Services\MedicalRecord\MedicalRecordComplaintCreator;
use App\Services\MedicalRecord\MedicalRecordComplaintGetter;
use App\Services\MedicalRecord\MedicalRecordComplaintUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MedicalRecordComplaintController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,MedicalRecordComplaintGetter $medicalRecordComplaintGetter)
    {
        return  MedicalRecordComplaintResource::collection($medicalRecordComplaintGetter->getPaginatedList($request));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(MedicalRecordComplaintRequest $request, MedicalRecordComplaintCreator $medicalRecordComplaintCreator): JsonResponse
    {
        $data = $request->all();

        return $this->successResponse(MedicalRecordComplaintResource::make($medicalRecordComplaintCreator->store($data)),
                        __('global.medical_complaint.create_success'),
                    Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,MedicalRecordComplaintGetter $medicalRecordComplaintGetter)
    {
        return $this->successResponse(MedicalRecordComplaintResource::make($medicalRecordComplaintGetter->show($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicalRecordComplaintRequest $request, string $id,MedicalRecordComplaintUpdater $medicalRecordComplaintUpdater)
    {
        $data = $request->all();

        return $this->successResponse(MedicalRecordComplaintResource::make($medicalRecordComplaintUpdater->update($id,$data)),
                        __("global.medical_complaint.update_success"),
                        Response::HTTP_CREATED
                    );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,MedicalRecordComplaintUpdater $medicalRecordComplaintUpdater)
    {
        return $this->successResponse($medicalRecordComplaintUpdater->delete($id),
                        __('global.medical_complaint.delete_success')
                    );
    }
}
