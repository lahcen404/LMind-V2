<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sprint;
use App\Models\TrainingClass;
use Illuminate\Http\Request;

class SprintController extends Controller
{
    /**
     * Display the academic timeline grouped by promotion.
     */
    public function index()
    {
        // eageer loading 
        $classes = TrainingClass::with(['sprints' => function($query) {
            $query->orderBy('order_sprint', 'asc');
        }])->get();

        return view('admin.sprints.index', compact('classes'));
    }

    /**
     * Show form to define a new sprint.
     */
    public function create()
    {
        $classes = TrainingClass::all();
        return view('admin.sprints.create', compact('classes'));
    }

    /**
     * Store the sprint in the sequence.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'duration'          => 'required|integer|min:1',
            'order_sprint'      => 'required|integer|min:1',
            'training_class_id' => 'required|exists:training_classes,id',
        ]);

        Sprint::create($validated);

        return redirect()->route('admin.sprints.index')
            ->with('success', 'New sprint successfully added to the timeline.');
    }

    /**
     * Show form to edit an existing sprint.
     */
    public function edit(Sprint $sprint)
    {
        $classes = TrainingClass::all();
        return view('admin.sprints.edit', compact('sprint', 'classes'));
    }

    /**
     * Update the sprint details.
     */
    public function update(Request $request, Sprint $sprint)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'duration'          => 'required|integer|min:1',
            'order_sprint'      => 'required|integer|min:1',
            'training_class_id' => 'required|exists:training_classes,id',
        ]);

        $sprint->update($validated);

        return redirect()->route('admin.sprints.index')
            ->with('success', 'Sprint sequence updated successfully.');
    }

    /**
     * Remove a sprint from the timeline.
     */
    public function destroy(Sprint $sprint)
    {
        $sprint->delete();
        return redirect()->route('admin.sprints.index')
            ->with('success', 'Sprint removed from the academic registry.');
    }
}
