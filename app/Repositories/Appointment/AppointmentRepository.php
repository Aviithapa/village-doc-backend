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
        $doctorId = $request->doctor_id;

        return $this->model->newQuery()
            ->filter(new AppointmentFilter($request))
            ->where(function ($query) use ($doctorId) {
                if ($doctorId)
                    $query->where('doctor_id', $doctorId);
            })
            ->latest()
            ->paginate($limit);
    }
}
