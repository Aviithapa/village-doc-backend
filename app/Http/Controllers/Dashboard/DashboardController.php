<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\DashboardGetter;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ApiResponser;

    public function dashboard(DashboardGetter $dashboardGetter)
    {
        return $this->successResponse($dashboardGetter->dashboard());
    }
}
