<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\CreateDoctorScheduleRequest;
use App\Http\Requests\Doctor\DoctorScheduleUpdateRequest;
use App\Http\Resources\Doctor\DoctorScheduleResource;
use App\Services\Doctor\DoctorScheduleCreator;
use App\Services\Doctor\DoctorScheduleGetter;
use App\Services\Doctor\DoctorScheduleUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DoctorScheduleController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param DoctorScheduleGetter $doctorGetter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, DoctorScheduleGetter $doctorScheduleGetter): AnonymousResourceCollection
    {
        return  DoctorScheduleResource::collection($doctorScheduleGetter->getPaginatedList($request));
    }

    /**
     * Show the form for creating a new resource.
     * @param CreateDoctorScheduleRequest $request
     * @param DoctorScheduleCreator $doctorCreator
     * @return JsonResponse
     */
    public function store(CreateDoctorScheduleRequest $request, DoctorScheduleCreator $doctorScheduleCreator): JsonResponse
    {
        $data = $request->all();
        return $this->successResponse(
            DoctorScheduleResource::make($doctorScheduleCreator->store($data)),
            __('patient.create_success'),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,DoctorScheduleGetter $doctorScheduleGetter)
    {
        return  $this->successResponse(DoctorScheduleResource::make($doctorScheduleGetter->show($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorScheduleUpdateRequest $request,DoctorScheduleUpdater $doctorScheduleUpdater,$id)
    {
        $data = $request->all();
        return $this->successResponse(
            DoctorScheduleResource::make($doctorScheduleUpdater->update($id, $data)),
            __('Doctor Schedule updated successfully'),
            Response::HTTP_CREATED
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorScheduleUpdater $doctorScheduleUpdater,$id)
    {
        return $this->successResponse(
            $doctorScheduleUpdater->delete($id),
            __('Doctor Schedule deleted successfully'),
            Response::HTTP_CREATED
        );
    }
}
