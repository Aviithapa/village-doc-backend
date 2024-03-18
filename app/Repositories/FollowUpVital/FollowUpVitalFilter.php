<?php

namespace App\Repositories\FollowUp;

use App\Infrastructure\Filters\BaseFilter;

class FollowUpVitalFilter extends BaseFilter
{
    /**
     * Filter is allowed with following parameters.
     *
     * @var array
     */
    protected $filters = ['follow_up_id'];


    /**
     * keyword
     *
     * @return void
     */

    public function follow_up_id()
    {
        if ($this->request->has('follow_up_id')) {
            $this->builder->where('follow_up_id', $this->request->get('follow_up_id'));
        }
    }
}
