<?php

namespace App\Repositories\Appointment;

use App\Models\Appointment;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AppointmentRepository extends Repository
{

    /**
     * AppointmentRepository constructor.
     * @param Appointment $appointment
     */
    public function __construct(Appointment $appointment)
    {
        parent::__construct($appointment);
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
            ->filter(new AppointmentFilter($request))
            ->latest()
            ->paginate($limit);
    }
}
