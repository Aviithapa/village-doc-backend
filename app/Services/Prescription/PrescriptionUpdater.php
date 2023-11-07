<?php

namespace App\Services\Prescription;


use App\Repositories\Prescription\PrescriptionRepository;

/**
 * Class  PrescriptionUpdater
 * @package App\Services\Prescription
 */
class PrescriptionUpdater
{
    /**
     * @var PrescriptionRepository
     */
    protected $prescriptionRepository;



    /**
     * PrescriptionGetter constructor.
     * @param PrescriptionRepository $prescriptionRepository
     */
    public function __construct(PrescriptionRepository $prescriptionRepository)
    {
        $this->prescriptionRepository = $prescriptionRepository;
    }

    /**
     * Store an prescription
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $prescription = $this->prescriptionRepository->findOrFail($id);
        $this->prescriptionRepository->store($data);
        return true;
    }


    /** Delete an prescription
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        //Todo: Delete prescription
        return false;
    }
}
