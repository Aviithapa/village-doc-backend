<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Services\Category\CategoryCreator;
use App\Services\Category\CategoryGetter;
use App\Services\Category\CategoryUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,CategoryGetter $categoryGetter)
    {
        return  CategoryResource::collection($categoryGetter->getPaginatedList($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request, CategoryCreator $categoryCreator): JsonResponse
    {
        $data = $request->all();

        return $this->successResponse(CategoryResource::make($categoryCreator->store($data)),
                        __('global.category.create_success'),
                    Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,CategoryGetter $categoryGetter)
    {
        return $this->successResponse(CategoryResource::make($categoryGetter->show($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id,CategoryUpdater $categoryUpdater)
    {
        $data = $request->all();

        return $this->successResponse(CategoryResource::make($categoryUpdater->update($id,$data)),
                        __("global.category.update_success"),
                        Response::HTTP_CREATED
                    );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,CategoryUpdater $categoryUpdater)
    {
        return $this->successResponse($categoryUpdater->delete($id),
                        __('global.category.delete_success')
                    );
    }
}
