<?php

namespace App\Repositories\Medication;

use App\Models\Medication;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MedicationRepository extends Repository
{

    /**
     * DoctorRepository constructor.
     * @param Doctor $Doctor
     */
    public function __construct(Medication $Medication)
    {
        parent::__construct($Medication);
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
            // ->filter(new DoctorFilter($request))
            ->latest()
            ->paginate($limit);
    }
}
