<?php

namespace App\Repositories\Doctor;

use App\Models\DoctorSchedule;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DoctorScheduleRepository extends Repository
{

    /**
     * DoctorScheduleRepository constructor.
     * @param DoctorSchedule $DoctorSchedule
     */
    public function __construct(DoctorSchedule $doctorSchedule)
    {
        parent::__construct($doctorSchedule);
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
            ->where('date',$request->date)
            ->where(function ($query) use ($doctorId) {
                if($doctorId)
                    $query->where('doctor_id',$doctorId);
            })
            ->latest()
            ->paginate($limit);
    }
}
