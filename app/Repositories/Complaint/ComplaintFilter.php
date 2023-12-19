<?php

namespace App\Repositories\Complaint;

use App\Infrastructure\Filters\BaseFilter;
use Carbon\Carbon;

class ComplaintFilter extends BaseFilter
{
    /**
     * Filter is allowed with following parameters.
     *
     * @var array
     */
    protected $filters = ['keyword', 'category'];


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
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }
    }


    public function category()
    {
        if ($this->request->has('category')) {
            $category =$this->request->get('category');
            $this->builder->whereHas('category',function($query) use ($category){
                $query->whereIn('categories.id', $category);
            });
        }
    }
}
