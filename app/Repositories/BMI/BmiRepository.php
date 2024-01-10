<?php

namespace App\Repositories\BMI;

use App\Models\BMI;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BmiRepository extends Repository
{

    /**
     * BmiRepository constructor.
     * @param BMI $Bmi
     */
    public function __construct(BMI $bmi)
    {
        parent::__construct($bmi);
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
