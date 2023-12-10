<?php

namespace App\Repositories\User;

use App\Infrastructure\Filters\BaseFilter;

class UserFilter extends BaseFilter
{
    /**
     * Filter is allowed with following parameters.
     *
     * @var array
     */
    protected $filters = ['keyword', 'type', 'status'];


    /**
     * keyword
     *
     * @return void
     */
    public function keyword()
    {
        if ($this->request->has('keyword')) {
            $keyword = $this->request->get('keyword');
            $this->builder->where(function ($query) use ($keyword) {
                $query->where('username', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            });
        }
    }


    public function type()
    {
        if ($this->request->has('type')) {
            $this->builder->where('type', $this->request->get('type'));
        }
    }

    public function status()
    {
        if ($this->request->has('status')) {
            $this->builder->where('status', $this->request->get('status'));
        }
    }
}
