<?php

namespace App\Repositories\Doctor;

use App\Models\Doctor;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DoctorRepository extends Repository
{

    /**
     * DoctorRepository constructor.
     * @param Doctor $Doctor
     */
    public function __construct(Doctor $Doctor)
    {
        parent::__construct($Doctor);
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
            ->filter(new DoctorFilter($request))
            ->latest()
            ->paginate($limit);
    }
}
