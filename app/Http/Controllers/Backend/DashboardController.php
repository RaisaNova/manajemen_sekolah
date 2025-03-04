<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        $data['meta_title'] = "dashboard";
        return view('backend.dashboard', $data);
    }
}
