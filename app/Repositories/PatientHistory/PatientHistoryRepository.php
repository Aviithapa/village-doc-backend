<?php

namespace App\Repositories\PatientHistory;

use App\Models\PatientHistory;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PatientHistoryRepository extends Repository
{

    /**
     * PatientHistoryRepository constructor.
     * @param PatientHistory $PatientHistory
     */
    public function __construct(PatientHistory $patientHistory)
    {
        parent::__construct($patientHistory);
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
