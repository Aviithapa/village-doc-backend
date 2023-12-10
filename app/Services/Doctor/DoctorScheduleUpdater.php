<?php

namespace App\Services\Doctor;


use App\Repositories\Doctor\DoctorScheduleRepository;
use Exception;

/**
 * Class  DoctorScheduleUpdater
 * @package App\Services\Doctor
 */
class DoctorScheduleUpdater
{
    /**
     * @var DoctorScheduleRepository
     */
    protected $doctorScheduleRepository;

    /**
     * DoctorGetter constructor.
     * @param DoctorScheduleRepository $doctorScheduleRepository
     */
    public function __construct(DoctorScheduleRepository $doctorScheduleRepository)
    {
        $this->doctorScheduleRepository = $doctorScheduleRepository;
    }

    /**
     * Store an doctor
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $schedule =  $this->doctorScheduleRepository->find($id);
        if ($schedule) {
            $data['updated_by'] = getAuthUser();
            $scheduleUpdate = $this->doctorScheduleRepository->update($schedule->id,$data);
            if ($scheduleUpdate === false) {
                return response()->json(['error' => 'Internal Error'], 500);
            }
            $schedule =  $this->doctorScheduleRepository->find($id);

            return $schedule;
        }
        return response()->json(['error' => 'Not Found'], 404);
    }


    /** Delete an doctor
     * @param int $id
     * @return false
     */
    public function delete(int $id)
    {
        return $this->doctorScheduleRepository->delete($id);
    }
}
