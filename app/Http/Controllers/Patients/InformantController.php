<?php

namespace App\Http\Controllers\Patients;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Patients\InformantRequest;
use App\Http\Resources\Patients\InformantResource;
use App\Services\Patients\InformantCreator;
use App\Services\Patients\InformantGetter;
use App\Services\Patients\InformantUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InformantController extends Controller
{
    use ApiResponser;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,InformantGetter $informantGetter)
    {
        return  InformantResource::collection($informantGetter->getPaginatedList($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InformantRequest $request, InformantCreator $informantCreator): JsonResponse
    {
        $data = $request->all();

        return $this->successResponse(InformantResource::make($informantCreator->store($data)),
                        __('global.informant.create_success'),
                    Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,InformantGetter $informantGetter)
    {
        return $this->successResponse(InformantResource::make($informantGetter->show($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InformantRequest $request, string $id,InformantUpdater $informantUpdater)
    {
        $data = $request->all();
        return $this->successResponse(InformantResource::make($informantUpdater->update($id,$data)),
                        __("global.informant.update_success"),
                        Response::HTTP_CREATED
                    );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,InformantUpdater $informantUpdater)
    {
        return $this->successResponse($informantUpdater->delete($id),
                        __('global.informant.delete_success')
                    );
    }
}
