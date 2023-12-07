<?php

namespace App\Http\Controllers\LabResult;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LabResult\CreateLabResultRequest;
use App\Http\Resources\LabResult\LabResultResource;
use App\Services\LabResult\LabResultCreator;
use App\Services\LabResult\LabResultGetter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class LabController extends Controller
{

    use ApiResponser;
    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @param LabReportGetter $labResultGetter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, LabResultGetter $labResultGetter): AnonymousResourceCollection
    {
        return  LabResultResource::collection($labResultGetter->getPaginatedList($request));
    }


    /**
     * Store a newly created resource in storage.
     *  
     * @param CreateLabResultRequest $request
     * @param LabResultCreator $labResu;tCreator
     * @return JsonResponse
     */
    public function store(CreateLabResultRequest $request, LabResultCreator $labResultCreator): JsonResponse
    {
        $data = $request->all();

        return $this->successResponse(
            LabResultResource::make($labResultCreator->store($data)),
            __('labResult.create_success'),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $id
     * @param LabResultCreator $labResultCreator
     * @return JsonResponse
     */
    public function show(string $id, LabResultGetter $labResultGetter): JsonResponse
    {
        return  $this->successResponse(LabResultResource::make($labResultGetter->show($id)));
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
}
