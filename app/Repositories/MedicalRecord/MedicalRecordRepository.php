<?php

namespace App\Repositories\MedicalRecord;

use App\Models\MedicalRecord;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MedicalRecordRepository extends Repository
{

    /**
     * MedicalRecordRepository constructor.
     * @param MedicalRecord $MedicalRecord
     */
    public function __construct(MedicalRecord $MedicalRecord)
    {
        parent::__construct($MedicalRecord);
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
