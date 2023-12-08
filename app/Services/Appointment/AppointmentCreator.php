<?php

namespace App\Services\Appointment;

use App\Events\AppointmentNotification;
use App\Repositories\Appointment\AppointmentRepository;


/**
 * Class  AppointmentCreator
 * @package App\Services\Appointment
 */
class AppointmentCreator
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
    public function store(array $data)
    {
        $data['created_by'] = getAuthUser();
        $appointment =  $this->appointmentRepository->store($data);
        $message = 'New Appointment has been created';
        broadcast(new AppointmentNotification($message))->toOthers();
        return $appointment->refresh();
    }
}
