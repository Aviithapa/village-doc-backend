<?php

namespace App\Services\Appointment;

use App\Http\Controllers\Api\ApiResponser;
use App\Models\Appointment;
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
            if($appointment->status === Appointment::STATUS_QUERIED || $appointment->status === Appointment::STATUS_SCHEDULED){
                $data['updated_by'] = getAuthUser();
                if($data['status'] === Appointment::STATUS_RESCHEDULED){
                    $dataArray = [
                        'status' => $data['status'],
                        'reason' => $data['reason']
                    ];
                    $this->appointmentRepository->update($appointment->id,$dataArray);

                    $data['status'] = Appointment::STATUS_SCHEDULED;
                    $appointment = $this->appointmentRepository->store($data);
                    return $appointment;

                }else{
                    $appointmentUpdate = $this->appointmentRepository->update($appointment->id,$data);
                    $appointment =  $this->appointmentRepository->find($id);
                    return $appointment;
                }  
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
