<?php

namespace App\Http\Controllers\Complaint;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Complaint\ComplaintRequest;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Services\Complaint\ComplaintCreator;
use App\Services\Complaint\ComplaintGetter;
use App\Services\Complaint\ComplaintUpdater;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ComplaintController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,ComplaintGetter $complaintGetter)
    {
        return  ComplaintResource::collection($complaintGetter->getPaginatedList($request));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ComplaintRequest $request, ComplaintCreator $complaintCreator): JsonResponse
    {
        $data = $request->all();

        return $this->successResponse(ComplaintResource::make($complaintCreator->store($data)),
                        __('global.complaint.create_success'),
                    Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,ComplaintGetter $complaintGetter)
    {
        return $this->successResponse(ComplaintResource::make($complaintGetter->show($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComplaintRequest $request, string $id,ComplaintUpdater $complaintUpdater)
    {
        $data = $request->all();

        return $this->successResponse(ComplaintResource::make($complaintUpdater->update($id,$data)),
                        __("global.complaint.update_success"),
                        Response::HTTP_CREATED
                    );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,ComplaintUpdater $complaintUpdater)
    {
        return $this->successResponse($complaintUpdater->delete($id),
                        __('global.complaint.delete_success')
                    );
    }
}
