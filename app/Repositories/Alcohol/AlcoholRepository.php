<?php

namespace App\Repositories\Alcohol;

use App\Models\AlcoholUnit;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AlcoholRepository extends Repository
{

    /**
     * AlcoholRepository constructor.
     * @param AlcoholUnit $alcoholUnit
     */
    public function __construct(AlcoholUnit $alcoholUnit)
    {
        parent::__construct($alcoholUnit);
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
