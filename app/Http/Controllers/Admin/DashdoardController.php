<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class DashdoardController extends Controller
{
    public function index(){
        $project = Project::class;
        $projectcount = $project::all()->count();

        return view('admin.dashboard',['projectcount'=>$projectcount]);
    }

    public function profile(){
        return view('admin.profile');
    }
}
