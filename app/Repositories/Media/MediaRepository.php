<?php


namespace App\Repositories\Media;


use App\Models\Media;
use App\Models\Medias;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;

class MediaRepository extends Repository
{

    public function __construct(Medias $model)
    {
        parent::__construct($model);
    }
}
