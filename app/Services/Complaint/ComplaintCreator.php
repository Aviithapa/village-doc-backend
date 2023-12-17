<?php

namespace App\Services\Complaint;

use App\Models\Category;
use App\Repositories\Complaint\ComplaintRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  ComplaintCreator
 * @package App\Services\Complaint
 */
class ComplaintCreator
{
    /**
     * @var ComplaintRepository
     */
    protected $complaintRepository;


    /**
     * complaintCreator constructor.
     * @param complaintRepository $complaintRepository

     */
    public function __construct(complaintRepository $complaintRepository)
    {
        $this->complaintRepository = $complaintRepository;
    }

    /**
     * Store an complaint
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try{
            DB::beginTransaction();

            $category = Category::whereIn('id',$data['category_id'])->get();
            $complaint =  $this->complaintRepository->store($data);
            
            $complaint->category()->attach($category);
            DB::commit();
            return $complaint->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
