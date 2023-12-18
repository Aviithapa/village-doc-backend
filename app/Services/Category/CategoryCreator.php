<?php

namespace App\Services\Category;

use App\Models\Complaint;
use App\Repositories\Category\CategoryRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  CategoryCreator
 * @package App\Services\Category
 */
class CategoryCreator
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;


    /**
     * CategoryCreator constructor.
     * @param CategoryRepository $categoryRepository

     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Store an Category
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $category =  $this->categoryRepository->store($data);
            DB::commit();
            return $category->refresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
