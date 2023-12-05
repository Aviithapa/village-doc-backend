<?php

namespace App\Services\Doctor;

use App\Models\User;
use App\Repositories\Doctor\DoctorRepository;
use Exception;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class  DoctorUpdater
 * @package App\Services\Doctor
 */
class DoctorUpdater
{
    /**
     * @var DoctorRepository
     */
    protected $doctorRepository;

    /**
     * DoctorGetter constructor.
     * @param DoctorRepository $doctorRepository
     */
    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }

    /**
     * Store an doctor
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $doctor = $this->doctorRepository->findOrFail($id);
        try{
            $doctorUpdate = $this->doctorRepository->update($doctor->id,$data);
            $doctor =  $this->doctorRepository->find($id);
            return $doctor;

        }catch(Exception $e){
            throw $e;
        }
    }


    /** Delete an doctor
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        $doctor = $this->doctorRepository->findOrFail($id);

        User::where('email',$doctor->email)->update(['status'=>'in-active']);
        
        $this->doctorRepository->delete($id);
        //Todo: Delete doctor
        return true;
    }
}
