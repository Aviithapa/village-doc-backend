<?php

namespace App\Services\Examination;


use App\Repositories\Examination\ExaminationRepository;
use Exception;

/**
 * Class  ExaminationUpdater
 * @package App\Services\Examination
 */
class ExaminationUpdater
{
    /**
     * @var ExaminationRepository
     */
    protected $ExaminationRepository;



    /**
     * ExaminationGetter constructor.
     * @param ExaminationRepository $ExaminationRepository
     */
    public function __construct(ExaminationRepository $ExaminationRepository)
    {
        $this->ExaminationRepository = $ExaminationRepository;
    }

    /**
     * Store an Examination
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $Examinations = $this->ExaminationRepository->findOrFail($id);
        try {
            $data['updated_by'] = getAuthUser();
            $ExaminationUpdate = $this->ExaminationRepository->update($Examinations->id, $data);
            $Examinations =  $this->ExaminationRepository->find($id);
            return $Examinations;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /** Delete an Examination
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        $this->ExaminationRepository->delete($id);
        return true;
    }
}
