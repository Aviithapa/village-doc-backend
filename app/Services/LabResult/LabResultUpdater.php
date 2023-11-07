<?php

namespace App\Services\LabResult;


use App\Repositories\LabResult\LabResultRepository;

/**
 * Class  LabResultUpdater
 * @package App\Services\LabResult
 */
class LabResultUpdater
{
    /**
     * @var LabResultRepository
     */
    protected $labResultRepository;



    /**
     * LabResultGetter constructor.
     * @param LabResultRepository $labResultRepository
     */
    public function __construct(LabResultRepository $labResultRepository)
    {
        $this->labResultRepository = $labResultRepository;
    }

    /**
     * Store an labResult
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $labResult = $this->labResultRepository->findOrFail($id);
        $this->labResultRepository->store($data);
        return true;
    }


    /** Delete an labResult
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        //Todo: Delete labResult
        return false;
    }
}
