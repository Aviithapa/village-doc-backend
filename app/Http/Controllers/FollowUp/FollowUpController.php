<?php

namespace App\Http\Controllers\FollowUp;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\FollowUp\FollowUpRequest;
use App\Http\Resources\FollowUp\FollowUpResource;
use App\Services\FollowUp\FollowUpCreater;
use App\Services\FollowUp\FollowUpGetter;
use App\Services\FollowUp\FollowUpUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FollowUpController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, FollowUpGetter $followUpGetter)
    {
        return FollowUpResource::collection($followUpGetter->getPaginatedList($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FollowUpRequest $request, FollowUpCreater $followupCreator): JsonResponse
    {
        $data = $request->all();

        return $this->successResponse(
            FollowUpResource::make($followupCreator->store($data)),
            __('global.followup.create_success'),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, FollowUpGetter $followUpGetter)
    {
        return $this->successResponse(FollowUpResource::make($followUpGetter->show($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FollowUpRequest $request, string $id, FollowUpUpdater $followupUpdater)
    {
        $data = $request->all();

        return $this->successResponse(
            FollowUpResource::make($followupUpdater->update($id, $data)),
            __("global.followup.update_success"),
            Response::HTTP_CREATED
        );
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, FollowUpUpdater $followupUpdater)
    {
        return $this->successResponse(
            $followupUpdater->delete($id),
            __('global.followup.delete_success')
        );
    }
}
