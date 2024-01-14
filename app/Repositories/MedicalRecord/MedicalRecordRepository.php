<?php

namespace App\Repositories\MedicalRecord;

use App\Models\MedicalRecord;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class MedicalRecordRepository extends Repository
{

    /**
     * MedicalRecordRepository constructor.
     * @param MedicalRecord $MedicalRecord
     */
    public function __construct(MedicalRecord $MedicalRecord)
    {
        parent::__construct($MedicalRecord);
    }

    /**
     * @param Request $request
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        $query = $this->model->newQuery()
            ->filter(new MedicalRecordFilter($request))
            ->latest();


        $userRole = Auth::user()->mainRole()->name;
        // dd($userRole);
        if ($userRole == 'admin' || $userRole == 'nurse') {
            // Display all patients for admin and nurse
            return $query->paginate($limit);
        } elseif ($userRole == 'ward-admin') {
            // Display only patients created by the ward user
            $userId = auth()->id();
            return $query->where('created_by', $userId)->paginate($limit);
        }
    }
}
