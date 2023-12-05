<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\CreateDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Http\Resources\Doctor\DoctorResource;
use App\Services\Doctor\DoctorCreator;
use App\Services\Doctor\DoctorGetter;
use App\Services\Doctor\DoctorUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DoctorController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param DoctorGetter $doctorGetter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, DoctorGetter $doctorGetter): AnonymousResourceCollection
    {
        return  DoctorResource::collection($doctorGetter->getPaginatedList($request));
    }

    /**
     * Show the form for creating a new resource.
     * @param CreateDoctorRequest $request
     * @param DoctorCreator $doctorCreator
     * @return JsonResponse
     */
    public function store(CreateDoctorRequest $request, DoctorCreator $doctorCreator): JsonResponse
    {
        //
        $data = $request->all();
        return $this->successResponse(
            DoctorResource::make($doctorCreator->store($data)),
            __('patient.create_success'),
            Response::HTTP_CREATED
        );
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id, DoctorGetter $doctorGetter): JsonResponse
    {
        //
        return  $this->successResponse(DoctorResource::make($doctorGetter->show($id)));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request,DoctorUpdater $doctorUpdater, string $id)
    {
        $data = $request->all();
        return $this->successResponse(
            DoctorResource::make($doctorUpdater->update($id,$data)),
            __('patient.create_success'),
            Response::HTTP_CREATED
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorUpdater $doctorUpdater, string $id)
    {
        return $this->successResponse(
           $doctorUpdater->destroy($id),
            __('Doctor Deleted Successfully!!'),
            Response::HTTP_CREATED
        );
    }

    public function doctorList(Request $request,DoctorGetter $doctorGetter)
    {
        $data = $request->all();
        $doctorList = $doctorGetter->doctorList($data);
        return  $this->successResponse($doctorList);
    }
}
