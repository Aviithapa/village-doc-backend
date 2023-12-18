<?php

namespace App\Repositories\Address;

use App\Models\Province\District;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DistrictRepository extends Repository
{

    /**
     * DistrictRepository constructor.
     * @param District $district
     */
    public function __construct(District $district)
    {
        parent::__construct($district);
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
