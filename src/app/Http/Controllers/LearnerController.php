<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brief;
use App\Models\Livrable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearnerController extends Controller
{
    // display all briefs assigned to learner 
    public function index()
    {
        $learner = Auth::user()->learner;

        // cheeckif the learner is in a class
        if (!$learner || !$learner->training_class_id) {
            return view('learner.dashboard', [
                'briefs' => collect(),
                'submissions' => [],
                'stats' => ['done' => 0, 'pending' => 0]
            ]);
        }

        // get Briefs assigned to Learner's Class
        $briefs = Brief::where('training_class_id', $learner->training_class_id)
            ->with(['trainer.user', 'skills', 'sprint'])
            ->latest()
            ->get();

        // Map submissions to briefs to show "Done" status
        $submissions = Livrable::where('learner_id', $learner->id)
            ->pluck('brief_id')
            ->toArray();

        // statistics
        $stats = [
            'done' => count($submissions),
            'pending' => $briefs->count() - count($submissions)
        ];

        return view('learner.dashboard', compact('briefs', 'submissions', 'stats'));
    }

    /**
     * Show brief details and the submission portal.
     */
    public function show(Brief $brief)
    {
        $learner = Auth::user()->learner;

        // Security check: Ensure the brief belongs to the learner's class
        if ($brief->training_class_id !== $learner->training_class_id) {
            return redirect()->route('learner.dashboard')->with('error', 'Access Denied: This project is not assigned to your promotion.');
        }

        // get existing submission if it exists
        $submission = Livrable::where('learner_id', $learner->id)
            ->where('brief_id', $brief->id)
            ->first();

        return view('learner.briefs.show', compact('brief', 'submission'));
    }

  //submit or update a submission for a brief
    public function submit(Request $request, Brief $brief)
    {
        $request->validate([
            'url' => 'required|url|active_url'
        ]);

        $learner = Auth::user()->learner;

        // Verify again that the brief is assigned to this learner's class
        if ($brief->training_class_id !== $learner->training_class_id) {
            return redirect()->back()->with('error', 'Invalid Submission Attempt.');
        }

        // syync link with the database
        Livrable::updateOrCreate(
            [
                'learner_id' => $learner->id,
                'brief_id' => $brief->id
            ],
            [
                'url' => $request->url
            ]
        );

        return redirect()->back()->with('success', 'Your livrable has been successfully deployed and synchronized.');
    }
}
