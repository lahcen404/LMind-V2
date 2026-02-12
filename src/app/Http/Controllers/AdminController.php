<?php

namespace App\Http\Controllers;

use App\Models\Learner;
use App\Models\Trainer;
use App\Models\Skill;
use App\Models\TrainingClass;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $learnersCount = Learner::count();
        $trainersCount = Trainer::count();
        $classesCount = TrainingClass::count();
        $skillsCount = Skill::count();


        $classes = TrainingClass::with(['trainers.user'])
            ->withCount('learners')
            ->latest()
            ->get();

        return view('admin.dashboard', compact(
            'learnersCount',
            'trainersCount',
            'classesCount',
            'skillsCount',
            'classes'
        ));
    }
}
