<?php

namespace App\Services\Complaint;

use App\Models\Category;
use App\Repositories\Complaint\ComplaintRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  ComplaintUpdater
 * @package App\Services\Complaint
 */
class ComplaintUpdater
{
    protected $complaintRepository;
    /**
     * @var ComplaintRepository
    */

    /**
     * complaintUpdater constructor.
     * @param ComplaintRepository $complaintRepository

     */
    public function __construct(ComplaintRepository $complaintRepository)
    {
        $this->complaintRepository = $complaintRepository;
    }

    /**
     * Update an complaint
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id,array $data)
    {
        $complaint = $this->complaintRepository->find($id);
        try{
            DB::beginTransaction();
            $currentCategory = $complaint->category()->pluck('category_id')->toArray();
            $newCategory = $data['category_id'];

            $categoryToDetach = array_diff($currentCategory, $newCategory);
            $categoryToAttach = array_diff($newCategory, $currentCategory);

            // $category = Category::where('id',$data['category_id'])->first();

            $complaint =  $this->complaintRepository->update($id,$data);

            DB::commit();
            $complaint = $this->complaintRepository->find($id);

            // Detach category
            $complaint->category()->detach($categoryToDetach);

            // Attach category
            $complaint->category()->attach($categoryToAttach);
            return $complaint->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        $complaint = $this->complaintRepository->delete($id);
        return true;
    }
}
