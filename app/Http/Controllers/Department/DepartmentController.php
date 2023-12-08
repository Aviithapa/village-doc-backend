<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Department\DepartmentRequest;
use App\Http\Resources\Department\DepartmentResource;
use App\Services\Department\DepartmentCreator;
use App\Services\Department\DepartmentGetter;
use App\Services\Department\DepartmentUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DepartmentGetter $departmentGetter)
    {
        return  DepartmentResource::collection($departmentGetter->getPaginatedList($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request, DepartmentCreator $departmentCreator) : JsonResponse
    {
        $data = $request->all();

        return $this->successResponse(DepartmentResource::make($departmentCreator->store($data)),
                        __('Department Created Successfully.'),
                    Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, DepartmentGetter $departmentGetter)
    {
        return $this->successResponse(DepartmentResource::make($departmentGetter->show($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id, DepartmentUpdater $departmentUpdater)
    {
        $data = $request->all();

        return $this->successResponse(DepartmentResource::make($departmentUpdater->update($id,$data)),
                        __("Department Has been updated"),
                        Response::HTTP_CREATED
                    );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DepartmentUpdater $departmentUpdater)
    {
        return $this->successResponse($departmentUpdater->delete($id),
                        __('Department has been deleted')
                    );
    }
}
