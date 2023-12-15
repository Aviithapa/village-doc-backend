<?php

namespace App\Http\Controllers\MedicalRecord;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalRecord\PastMedicalHistoryRequest;
use App\Http\Resources\MedicalRecord\PastMedicalRecordResource;
use App\Services\MedicalRecord\PastMedicalHistoryGetter;
use App\Services\MedicalRecord\PastMedicalHistoryUpdater;
use App\Services\MedicalRecord\PastMedicalHistoryCreator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PastMedicalHistoryController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,PastMedicalHistoryGetter $pastMedicalHistoryGetter)
    {
        return  PastMedicalRecordResource::collection($pastMedicalHistoryGetter->getPaginatedList($request));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PastMedicalHistoryRequest $request,PastMedicalHistoryCreator $pastMedicalHistoryCreator): JsonResponse
    {
        $data = $request->all();
        return $this->successResponse(PastMedicalRecordResource::make($pastMedicalHistoryCreator->store($data)),
                        __('global.past_medical_history.create_success'),
                    Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,PastMedicalHistoryGetter $pastMedicalHistoryGetter)
    {
        return $this->successResponse(PastMedicalRecordResource::make($pastMedicalHistoryGetter->show($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PastMedicalHistoryRequest $request, string $id,PastMedicalHistoryUpdater $pastMedicalHistoryUpdater)
    {
        $data = $request->all();

        return $this->successResponse(PastMedicalRecordResource::make($pastMedicalHistoryUpdater->update($id,$data)),
                        __("global.past_medical_history.update_success"),
                        Response::HTTP_CREATED
                    );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,PastMedicalHistoryUpdater $pastMedicalHistoryUpdater)
    {
        return $this->successResponse($pastMedicalHistoryUpdater->delete($id),
                        __('global.past_medical_history.delete_success')
                    );
    }
}
