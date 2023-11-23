<?php

namespace App\Http\Controllers\Patients;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Patients\CreatePatientsRequest;
use App\Http\Requests\Patients\PatientUUIDRequest;
use App\Http\Resources\Patients\PatientSelectResource;
use App\Http\Resources\Patients\PatientsResource;
use App\Http\Resources\Vital\VitalResource;
use App\Services\Patients\PatientsCreator;
use App\Services\Patients\PatientsGetter;
use App\Services\Vital\VitalGetter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PatientsController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @param PatientsGetter $patientsGetter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, PatientsGetter $patientsGetter): AnonymousResourceCollection
    {
        return  PatientsResource::collection($patientsGetter->getPaginatedList($request));
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @param CreatePatientsRequest $request
     * @param PatientsCreator $patientsCreator
     * @return JsonResponse
     */
    public function store(CreatePatientsRequest $request, PatientsCreator $patientsCreator): JsonResponse
    {
        //
        $data = $request->all();

        return $this->successResponse(
            PatientsResource::make($patientsCreator->store($data)),
            __('patient.create_success'),
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
    public function show(string $id, PatientsGetter $patientsGetter): JsonResponse
    {
        //
        return  $this->successResponse(PatientsResource::make($patientsGetter->show($id)));
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


    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @param PatientsGetter $patientsGetter
     * @return AnonymousResourceCollection
     */
    public function select(Request $request, PatientsGetter $patientsGetter): AnonymousResourceCollection
    {
        return  PatientSelectResource::collection($patientsGetter->getPaginatedList($request));
    }


    public function patientVital($id, VitalGetter $vitalGetter)
    {
        return $vitalGetter->patientTodayVital($id);
    }

    public function qrScan(PatientUUIDRequest $request, PatientsGetter $patientsGetter): JsonResponse
    {
        $data = $patientsGetter->patientsDetails($request->uuid);
        return  $this->successResponse($data);
    }
}
