<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\CreateAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Http\Resources\Appointment\AppointmentResource;
use App\Services\Appointment\AppointmentCreator;
use App\Services\Appointment\AppointmentGetter;
use App\Services\Appointment\AppointmentUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AppointmentController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param AppointmentGetter $appointmentGetter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, AppointmentGetter $appointmentGetter): AnonymousResourceCollection
    {
        return  AppointmentResource::collection($appointmentGetter->getPaginatedList($request));
    }


    /**
     * Store a newly created resource in storage.
     * @param CreateAppointmentRequest $request
     * @param AppointmentCreator $appointmentCreator
     * @return JsonResponse
     */
    public function store(CreateAppointmentRequest $request, AppointmentCreator $appointmentCreator): JsonResponse
    {
        //
        $data = $request->all();

        return $this->successResponse(
            AppointmentResource::make($appointmentCreator->store($data)),
            __('global.appointment.create_success'),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, AppointmentGetter $appointmentGetter): JsonResponse
    {
        return  $this->successResponse(AppointmentResource::make($appointmentGetter->show($id)));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request,AppointmentUpdater $appointmentUpdater,$id)
    {
        $data = $request->all();
        return $this->successResponse(
            AppointmentResource::make($appointmentUpdater->update($id, $data)),
            __('global.appointment.create_success'),
            Response::HTTP_CREATED
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
