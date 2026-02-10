<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Learner;
use App\Models\TrainingClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    /**
     * Display classes assigned to the logged-in trainer.
     */
    public function index()
    {
        $trainer = Auth::user()->trainer;

        $classes = $trainer->training_Classes()->withCount('learners')->get();

        return view('trainer.classes.index', compact('classes'));
    }

    /**
     * Show the form to assign learners to a specific class.
     */
    public function showAssignForm(TrainingClass $class)
    {
        if (!$class->trainers->contains(Auth::user()->trainer->id)) {
            return redirect()->back()->with('error', 'Access Denied.');
        }

        $currentLearners = $class->learners()->with('user')->get();


        $availableLearners = Learner::whereNull('training_class_id')
            ->with('user')
            ->get();

        return view('trainer.classes.assign_learners', compact('class', 'currentLearners', 'availableLearners'));
    }

    /**
     * Process the assignment/removal of learners.
     */
    public function syncLearners(Request $request, TrainingClass $class)
    {
        $request->validate([
            'learner_ids' => 'nullable|array',
            'learner_ids.*' => 'exists:learners,id'
        ]);

        $selectedIds = $request->input('learner_ids', []);

        Learner::where('training_class_id', $class->id)
            ->whereNotIn('id', $selectedIds)
            ->update(['training_class_id' => null]);

        // add new selected learners to  cllass
        if (!empty($selectedIds)) {
            Learner::whereIn('id', $selectedIds)
                ->update(['training_class_id' => $class->id]);
        }

        return redirect()->route('trainer.classes.assign', $class->id)
            ->with('success', 'Class roster updated successfully.');
    }
}
