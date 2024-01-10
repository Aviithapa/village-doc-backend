<?php

namespace App\Repositories\PackYear;

use App\Models\PackYear;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PackYearRepository extends Repository
{

    /**
     * PackYearRepository constructor.
     * @param PackYear $packYear
     */
    public function __construct(PackYear $packYear)
    {
        parent::__construct($packYear);
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
