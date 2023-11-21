<?php

namespace App\Http\Controllers\Medication;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Medication\CreateMedicationRequest;
use App\Http\Resources\Medication\MedicationResource;
use App\Services\Medication\MedicationCreator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MedicationController extends Controller
{
    use ApiResponser;
    /**
     * Show the form for creating a new resource.
     * @param CreateDoctorRequest $request
     * @param MedicationCreator $medicationCreator
     * @return JsonResponse
     */
    public function store(CreateMedicationRequest $request, MedicationCreator $medicationCreator): JsonResponse
    {
        $data = $request->all();

        return $this->successResponse(
            MedicationResource::make($medicationCreator->store($data)),
            __('medication.create_success'),
            Response::HTTP_CREATED
        );
    }

    public function medicationBulkUpload(Request $request,MedicationCreator $medicationCreator){
        $data = $request->all();

        return $this->successResponse(
            MedicationResource::make($medicationCreator->bulkStore($data)),
            __('medication.create_success'),
            Response::HTTP_CREATED
        );
    }
}
