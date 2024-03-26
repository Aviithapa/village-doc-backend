<?php

namespace App\Services\FollowUp;

use App\Repositories\FollowUpVital\FollowUpVitalRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  FollowUpUpdater
 * @package App\Services\FollowUp
 */
class FollowUpUpdater
{
    /**
     * @var FollowUpVitalRepository
     */
    protected $followupVitalRepository;

    /**
     * FollowUpUpdater constructor.
     * @param FollowUpVitalRepository $followupVitalRepository
     */
    public function __construct(FollowUpVitalRepository $followupVitalRepository)
    {
        $this->followupVitalRepository = $followupVitalRepository;
    }

    /**
     * Update an FollowUp
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $followupVital = $this->followupVitalRepository->find($id);
        try {
            DB::beginTransaction();
            $followupVital =  $this->followupVitalRepository->update($id, $data);
            DB::commit();
            $followupVital = $this->followupVitalRepository->find($id);
            return $followupVital->refresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        $followupVital = $this->followupVitalRepository->delete($id);
        return true;
    }
}
