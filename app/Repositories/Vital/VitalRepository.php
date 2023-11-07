<?php

namespace App\Repositories\Vital;

use App\Models\Vital;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class VitalRepository extends Repository
{

    /**
     * VitalRepository constructor.
     * @param Vital $Vital
     */
    public function __construct(Vital $vital)
    {
        parent::__construct($vital);
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
