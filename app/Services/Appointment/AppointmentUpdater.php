<?php

namespace App\Services\Appointment;


use App\Repositories\Appointment\AppointmentRepository;

/**
 * Class  AppointmentUpdater
 * @package App\Services\Appointment
 */
class AppointmentUpdater
{
    /**
     * @var AppointmentRepository
     */
    protected $appointmentRepository;

    /**
     * AppointmentGetter constructor.
     * @param AppointmentRepository $appointmentRepository
     */
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * Store an appointment
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $appointment = $this->appointmentRepository->findOrFail($id);
        $this->appointmentRepository->store($data);
        return true;
    }


    /** Delete an appointment
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        //Todo: Delete appointment
        return false;
    }
}
