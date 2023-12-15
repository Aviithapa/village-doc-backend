<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  CategoryUpdater
 * @package App\Services\Category
 */
class CategoryUpdater
{
    protected $categoryRepository;
    /**
     * @var CategoryRepository
    */

    /**
     * CategoryUpdater constructor.
     * @param CategoryRepository $categoryRepository
    */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Update an Category
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id,array $data)
    {
        $category = $this->categoryRepository->find($id);
        try{
            DB::beginTransaction();
            $category =  $this->categoryRepository->update($id,$data);
            DB::commit();
            $category = $this->categoryRepository->find($id);
            return $category->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        $category = $this->categoryRepository->delete($id);
        return true;
    }
}
