<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class CategoryGetter
 * @package App\Services\Category
 */
class CategoryGetter
{
    protected $categoryRepository;

    /**
     * @var CategoryRepository
    */

    /**
     * CategoryGetter constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get paginated Category list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->categoryRepository->getPaginatedList($request);
    }

    /**
     * Get a single Category
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->categoryRepository->findOrFail($id);
    }

}
