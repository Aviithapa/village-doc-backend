<?php

namespace App\Repositories\MedicalRecord;

use App\Models\PastMedicalHistory;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PastMedicalHistoryRepository extends Repository
{

    /**
     * PastMedicalHistoryRepository constructor.
     * @param PastMedicalHistory $pastMedicalHistory
     */
    public function __construct(PastMedicalHistory $pastMedicalHistory)
    {
        parent::__construct($pastMedicalHistory);
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
