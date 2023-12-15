<?php

namespace App\Repositories\Patients;

use App\Models\Informant;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class InformantRepository extends Repository
{

    /**
     * InformantRepository constructor.
     * @param Informant $Informant
     */
    public function __construct(Informant $Informant)
    {
        parent::__construct($Informant);
    }

    /**
     * @param Request $request
     * @param array $columns
     * @return LengthAwarePaginator
    */
    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->model->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
