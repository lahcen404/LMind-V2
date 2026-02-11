<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationLearnerController extends Controller
{
    /**
     * Display the learner's skill mastery portfolio and evaluation history.
     */
    public function index()
    {
        $learner = Auth::user()->learner;

        // get all evaluations
        $evaluationsByBrief = Evaluation::where('learner_id', $learner->id)
            ->with(['brief', 'skill'])
            ->get()
            ->groupBy('brief_id');

        // calcul skill mastery levels based on evaluations
        $skillMastery = Evaluation::where('learner_id', $learner->id)
            ->with('skill')
            ->get()
            ->groupBy('skill_id')
            ->map(function ($evals) {
                return $evals->sortByDesc(function($e) {
                    return match($e->achieved_level->value ?? $e->achieved_level) {
                        'TRANSPOSER' => 3,
                        'ADAPTER'    => 2,
                        'IMITER'     => 1,
                        default      => 0
                    };
                })->first();
            });

        return view('learner.evaluations.index', compact('evaluationsByBrief', 'skillMastery'));
    }
}
