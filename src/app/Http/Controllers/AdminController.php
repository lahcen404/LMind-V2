<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\TrainingClass;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {


        return view('admin.dashboard');
    }
}
