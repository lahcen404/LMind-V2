<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brief;
use App\Models\TrainingClass;
use App\Models\Learner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    /**
     * Display the Trainer's Dashboard with Context Switching.
     */
    public function index(Request $request)
    {
        $trainer = Auth::user()->trainer;

        // get all my classes
        $allClasses = $trainer->training_classes()->get();

        if ($allClasses->isEmpty()) {
            return view('trainer.dashboard', [
                'currentClass' => null,
                'allClasses' => collect(),
                'learners' => collect(),
                'activeBrief' => null,
                'briefs' => collect(),
                'sprints' => collect()
            ]);
        }

        // chaange active class and chosen brief
        $classId = $request->query('class_id', session('trainer_class_context', $allClasses->first()->id));
        $currentClass = $allClasses->find($classId) ?? $allClasses->first();

        session(['trainer_class_context' => $currentClass->id]);

        // get all briefs for this class
        $briefs = Brief::where('training_class_id', $currentClass->id)->latest()->get();

        // get active brief context (for submissions and timeline)
        $briefId = $request->query('brief_id', session('trainer_brief_context'));
        $activeBrief = ($briefId && $briefs->find($briefId))
            ? $briefs->find($briefId)
            : $briefs->first();

        session(['trainer_brief_context' => $activeBrief ? $activeBrief->id : null]);

        // fetch learners with their submission status for the active brief
        $learners = $currentClass->learners()
            ->with(['user', 'livrables' => function($q) use ($activeBrief) {
                if($activeBrief) $q->where('brief_id', $activeBrief->id);
            }])
            ->get();

        // get sprints
        $sprints = $currentClass->sprints()->orderBy('order_sprint', 'asc')->get();

        return view('trainer.dashboard', compact(
            'currentClass',
            'allClasses',
            'learners',
            'activeBrief',
            'briefs',
            'sprints'
        ));
    }
}
