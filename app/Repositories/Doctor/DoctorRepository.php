<?php

namespace App\Repositories\Doctor;

use App\Models\Patients;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DoctorRepository extends Repository
{

    /**
     * PatientsRepository constructor.
     * @param Patients $patients
     */
    public function __construct(Patients $patients)
    {
        parent::__construct($patients);
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
            ->filter(new PatientsFilter($request))
            ->latest()
            ->paginate($limit);
    }
}
