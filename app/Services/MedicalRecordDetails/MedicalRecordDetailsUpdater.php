<?php

namespace App\Services\MedicalRecordDetails;


use App\Repositories\MedicalRecordDetails\MedicalRecordDetailsRepository;
use Exception;

/**
 * Class  MedicalRecordDetailsUpdater
 * @package App\Services\MedicalRecordDetails
 */
class MedicalRecordDetailsUpdater
{
    /**
     * @var MedicalRecordDetailsRepository
     */
    protected $MedicalRecordDetailsRepository;



    /**
     * MedicalRecordDetailsGetter constructor.
     * @param MedicalRecordDetailsRepository $MedicalRecordDetailsRepository
     */
    public function __construct(MedicalRecordDetailsRepository $MedicalRecordDetailsRepository)
    {
        $this->MedicalRecordDetailsRepository = $MedicalRecordDetailsRepository;
    }

    /**
     * Store an MedicalRecordDetails
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $MedicalRecordDetailss = $this->MedicalRecordDetailsRepository->findOrFail($id);
        try {
            $data['updated_by'] = getAuthUser();
            $MedicalRecordDetailsUpdate = $this->MedicalRecordDetailsRepository->update($MedicalRecordDetailss->id, $data);
            $MedicalRecordDetailss =  $this->MedicalRecordDetailsRepository->find($id);
            return $MedicalRecordDetailss;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /** Delete an MedicalRecordDetails
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        $this->MedicalRecordDetailsRepository->delete($id);
        return true;
    }
}
