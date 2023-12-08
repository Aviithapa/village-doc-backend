<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Department\DepartmentTestRequest;
use App\Http\Resources\Department\DepartmentTestResource;
use App\Services\Department\DepartmentTestCreator;
use App\Services\Department\DepartmentTestGetter;
use App\Services\Department\DepartmentTestUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentTestController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DepartmentTestGetter $departmentTestGetter)
    {
        return  DepartmentTestResource::collection($departmentTestGetter->getPaginatedList($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentTestRequest $request, DepartmentTestCreator $departmentTestCreator) : JsonResponse
    {
        $data = $request->all();

        return $this->successResponse(DepartmentTestResource::make($departmentTestCreator->store($data)),
                        __('Department Created Successfully.'),
                    Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, DepartmentTestGetter $departmentTestGetter)
    {
        return $this->successResponse(DepartmentTestResource::make($departmentTestGetter->show($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentTestRequest $request, string $id, DepartmentTestUpdater $departmentTestUpdater)
    {
        $data = $request->all();

        return $this->successResponse(DepartmentTestResource::make($departmentTestUpdater->update($id,$data)),
                        __("Department Has been updated"),
                        Response::HTTP_CREATED
                    );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DepartmentTestUpdater $departmentTestUpdater)
    {
        return $this->successResponse($departmentTestUpdater->delete($id),
                        __('Department has been deleted')
                    );
    }
}
