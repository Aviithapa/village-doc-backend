<?php

namespace App\Repositories\Allergies;

use App\Models\Allergies;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AllergiesRepository extends Repository
{

    /**
     * AllergiesRepository constructor.
     * @param Allergies $Allergies
     */
    public function __construct(Allergies $Allergies)
    {
        parent::__construct($Allergies);
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
            ->filter(new AllergiesFilter($request))
            ->latest()
            ->paginate($limit);
    }
}
