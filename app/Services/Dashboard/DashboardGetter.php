<?php

namespace App\Services\Dashboard;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Patients;
use App\Models\User;
use App\Repositories\Department\DepartmentRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardGetter
 * @package App\Services\Department
 */
class DashboardGetter
{
    public function dashboard()
    {
        $user = Auth::user();
        $users = User::with('roles:id,name')->find($user->id);

        $userRoles = $users->roles;

        foreach($userRoles as $value){
            if($value->name == 'ward-admin'){
                $patientsCount = Patients::where('created_by',$users->id)->get()->count();
                $opdCount = MedicalRecord::where('created_by',$users->id)->get()->count();
                $appointmentCount = Appointment::where('created_by',$users->id)->get()->count();
            }else{
                $patientsCount = Patients::get()->count();
                $opdCount = MedicalRecord::get()->count();
                $appointmentCount = Appointment::get()->count();
            }
        }

        $data = [
            'patients_count' => $patientsCount,
            'opd_count' => $opdCount,
            'appointment_count' => $appointmentCount,
        ];
        
        return $data;
    }
}
