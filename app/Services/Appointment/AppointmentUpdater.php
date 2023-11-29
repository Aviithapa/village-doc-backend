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

        if ($appointment) {
            if($appointment->status == "queried" || $appointment->status == "scheduled"){
                $appointmentUpdate = $this->appointmentRepository->update($appointment->id,$data);
                if ($appointmentUpdate === false) {
                    return response()->json(['error' => 'Internal Error'], 500);
                }
                $appointment =  $this->appointmentRepository->find($id);
    
                return $appointment;
            }

            return response()->json(['error' => 'Appointment canot be edited'], 403);
            
        }
        return response()->json(['error' => 'Not Found'], 404);
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
