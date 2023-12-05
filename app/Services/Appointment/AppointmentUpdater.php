<?php

namespace App\Services\Appointment;

use App\Http\Controllers\Api\ApiResponser;
use App\Repositories\Appointment\AppointmentRepository;
use Exception;
use Mockery\Expectation;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Throwable;

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
    use ApiResponser;

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
        try{
            if($appointment->status === "queried" || $appointment->status === "scheduled"){
                $appointmentUpdate = $this->appointmentRepository->update($appointment->id,$data);
                $appointment =  $this->appointmentRepository->find($id);
                return $appointment;
            }
            throw  new  BadRequestHttpException('Appointment Cannot be edited');          

        }catch(Exception $e){
            throw $e;
        }          
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
