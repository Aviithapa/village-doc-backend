<?php

namespace App\Services\FollowUp;

use App\Models\FollowUp;
use App\Repositories\FollowUp\FollowUpRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  FollowUpUpdater
 * @package App\Services\FollowUp
 */
class FollowUpUpdater
{
    /**
     * @var FollowUpRepository
     */
    protected $followupRepository;

    /**
     * FollowUpUpdater constructor.
     * @param FollowUpRepository $followupRepository
     */
    public function __construct(FollowUpRepository $followupRepository)
    {
        $this->followupRepository = $followupRepository;
    }

    /**
     * Update an FollowUp
     * @param int id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $followup = $this->followupRepository->find($id);
        try {
            DB::beginTransaction();
            $followup =  $this->followupRepository->update($id, $data);
            DB::commit();
            $followup = $this->followupRepository->find($id);
            return $followup;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        DB::beginTransaction();

        try {
            $followUp = FollowUp::findOrFail($id);
            $followUp->vitals()->delete();
            $followUp->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
