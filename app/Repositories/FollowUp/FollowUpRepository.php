<?php

namespace App\Repositories\Doctor;

use App\Models\FollowUp;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FollowUpRepository extends Repository
{

    /**
     * FollowUpRepository constructor.
     * @param FollowUp $FollowUp
     */
    public function __construct(FollowUp $followUp)
    {
        parent::__construct($followUp);
    }

    /**
     * @param Request $request
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        $medicalRecordId = $request->medical_record_id;
        return $this->model->newQuery()
            ->where('date', $request->date)
            ->where(function ($query) use ($medicalRecordId) {
                if ($medicalRecordId)
                    $query->where('medical_record_id', $medicalRecordId);
            })
            ->latest()
            ->paginate($limit);
    }
}
