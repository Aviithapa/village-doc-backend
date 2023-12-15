<?php

namespace App\Repositories\MedicalRecord;

use App\Models\MedicalRecordComplaint;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MedicalRecordComplaintRepository extends Repository
{

    /**
     * MedicalRecordComplaintRepository constructor.
     * @param MedicalRecordComplaint $medicalRecordComplaintRepository
     */
    public function __construct(MedicalRecordComplaint $medicalRecordComplaint)
    {
        parent::__construct($medicalRecordComplaint);
    }

    /**
     * @param Request $request
     * @param array $columns
     * @return LengthAwarePaginator
    */
    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->model->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
