<?php

namespace App\Services\Allergies;


use App\Repositories\Allergies\AllergiesRepository;

/**
 * Class  AllergiesUpdater
 * @package App\Services\Allergies
 */
class AllergiesUpdater
{
    /**
     * @var AllergiesRepository
     */
    protected $allergiesRepository;



    /**
     * AllergiesGetter constructor.
     * @param AllergiesRepository $allergiesRepository
     */
    public function __construct(AllergiesRepository $allergiesRepository)
    {
        $this->allergiesRepository = $allergiesRepository;
    }

    /**
     * Store an allergies
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $allergies = $this->allergiesRepository->findOrFail($id);
        $this->allergiesRepository->store($data);
        return true;
    }


    /** Delete an allergies
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        //Todo: Delete allergies
        return false;
    }
}
