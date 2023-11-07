<?php

namespace App\Repositories\Prescription;

use App\Models\Prescription;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PrescriptionRepository extends Repository
{

    /**
     * PrescriptionRepository constructor.
     * @param Prescription $Prescription
     */
    public function __construct(Prescription $Prescription)
    {
        parent::__construct($Prescription);
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
