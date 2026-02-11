<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Learner;
use App\Models\Brief;
use App\Models\Evaluation;
use App\Models\Livrable;
use App\Enums\MasteryLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
   // create or updaate evaluation for learner
    public function create(Request $request, Brief $brief, Learner $learner)
    {
        // get livrable url
        $livrable = Livrable::where('learner_id', $learner->id)
            ->where('brief_id', $brief->id)
            ->first();

        // load brief with its skills
        $brief->load('skills');

        // get existing evaluations for this brief and learner
        $existingEvaluations = Evaluation::where('learner_id', $learner->id)
            ->where('brief_id', $brief->id)
            ->get()
            ->keyBy('skill_id');

        return view('trainer.evaluations.create', compact('learner', 'brief', 'livrable', 'existingEvaluations'));
    }

    // store or update evaluations for a learner and brief
    public function store(Request $request, Brief $brief, Learner $learner)
    {
        $request->validate([
            'skills' => 'required|array',
            'skills.*.achieved_level' => 'required|string',
            'skills.*.comment' => 'nullable|string|max:1000',
        ]);

        foreach ($request->skills as $skillId => $data) {
            Evaluation::updateOrCreate(
                [
                    'learner_id' => $learner->id,
                    'brief_id'   => $brief->id,
                    'skill_id'   => $skillId,
                ],
                [
                    'achieved_level' => $data['achieved_level'],
                    'comment'        => $data['comment'] ?? null,
                ]
            );
        }

        return redirect()->route('trainer.dashboard')
            ->with('success', "Pedagogical assessment for {$learner->user->full_name} has been synchronized.");
    }
}
