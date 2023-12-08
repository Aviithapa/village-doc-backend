<?php

namespace App\Services\Patients;

use App\Client\FileUpload\FileUploaderInterface;
use App\Models\Medias;
use App\Repositories\Media\MediaRepository;
use App\Repositories\Patients\PatientsRepository;

use Exception;

/**
 * Class  PatientsUpdater
 * @package App\Services\Patients
 */
class PatientsUpdater
{
    /**
     * @var PatientsRepository
     */
    protected $patientsRepository, $mediasRepository;
    private $fileUploader;

    /**
     * PatientsGetter constructor.
     * @param PatientsRepository $patientsRepository
     */
    public function __construct(PatientsRepository $patientsRepository, FileUploaderInterface $fileUploader,MediaRepository $mediasRepository)
    {
        $this->patientsRepository = $patientsRepository;
        $this->fileUploader = $fileUploader;
        $this->mediasRepository = $mediasRepository;
    }

    /**
     * Store an patients
     * @param array $dat
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $patient = $this->patientsRepository->findOrFail($id);
        try{
            if(isset($data["images"])){
                $media = $this->mediasRepository->all()->where('patient_id',$patient->id)->first();
                $response =  $this->fileUploader->uploadBase64($data['images'], "photos");
                if($media){
                    $this->fileUploader->unlink($media->path);
                    $media->update($response);
                }else{
                    $response['patient_id'] = $patient->id;
                    $response['type'] = Medias::TYPE_PHOTO;

                    $this->mediasRepository->store($response);
                }
            }
            $data['updated_by'] = getAuthUser();
            $patientUpdate = $this->patientsRepository->update($patient->id,$data);
            $patient =  $this->patientsRepository->find($id);
            return $patient;

        }catch(Exception $e){
            throw $e;
        }
    }


    /** Delete an patients
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        $this->patientsRepository->delete($id);
        return true;
    }
}
