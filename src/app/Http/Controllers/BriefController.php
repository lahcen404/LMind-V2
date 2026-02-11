<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brief;
use App\Models\Skill;
use App\Models\TrainingClass;
use App\Enums\SkillLevel;
use App\Enums\BriefType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class BriefController extends Controller
{
    /**
     * Display the list of briefs created by trainers.
     */
    public function index()
    {
        $briefs = Brief::with(['trainingClass', 'skills', 'trainer.user'])->latest()->get();
        return view('trainer.briefs.index', compact('briefs'));
    }

    /**
     * Show the form for creating a new brief.
     */
    public function create()
    {
        $classes = TrainingClass::all();
        $skills = Skill::all();
        $skillLevels = SkillLevel::cases();
        $briefTypes = BriefType::cases();

        return view('trainer.briefs.create', compact('classes', 'skills', 'skillLevels', 'briefTypes'));
    }

    /**
     * Store a newly created brief.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'duration'          => 'required|integer|min:1',
            'type'              => ['required', new Enum(BriefType::class)],
            'training_class_id' => 'required|exists:training_classes,id',
            'skills'            => 'required|array',
            'levels'            => 'required|array',
        ]);

        $brief = Brief::create([
            'title'             => $validated['title'],
            'description'       => $validated['description'],
            'duration'          => $validated['duration'],
            'type'              => $validated['type'],
            'training_class_id' => $validated['training_class_id'],
            'trainer_id'        => Auth::user()->trainer->id,
        ]);

        $syncData = [];
        foreach ($request->skills as $skillId) {
            $syncData[$skillId] = [
                'expected_level' => $request->input("levels.$skillId")
            ];
        }
        $brief->skills()->sync($syncData);

        return redirect()->route('trainer.briefs.index')->with('success', 'Project brief deployed successfully.');
    }

    /**
     * Show the form for editing the specified brief.
     */
    public function edit(Brief $brief)
    {
        $classes = TrainingClass::all();
        $skills = Skill::all();
        $skillLevels = SkillLevel::cases();
        $briefTypes = BriefType::cases();

        return view('trainer.briefs.edit', compact('brief', 'classes', 'skills', 'skillLevels', 'briefTypes'));
    }

    /**
     * Update the specified brief in storage.
     */
    public function update(Request $request, Brief $brief)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'duration'          => 'required|integer|min:1',
            'type'              => ['required', new Enum(BriefType::class)],
            'training_class_id' => 'required|exists:training_classes,id',
            'skills'            => 'nullable|array',
            'levels'            => 'nullable|array',
        ]);

        $brief->update([
            'title'             => $validated['title'],
            'description'       => $validated['description'],
            'duration'          => $validated['duration'],
            'type'              => $validated['type'],
            'training_class_id' => $validated['training_class_id'],
        ]);

        if ($request->has('skills')) {
            $syncData = [];
            foreach ($request->skills as $skillId) {
                $syncData[$skillId] = [
                    'expected_level' => $request->input("levels.$skillId")
                ];
            }
            $brief->skills()->sync($syncData);
        } else {
            //if unchecked all skills,  clears  piiivot table
            $brief->skills()->detach();
        }

        return redirect()->route('trainer.briefs.index')->with('success', 'Pedagogical brief updated successfully.');
    }

    /**
     * Remove the specified brief from storage.
     */
    public function destroy(Brief $brief)
    {
               $brief->delete();

        return redirect()->route('trainer.briefs.index')->with('success', 'Brief aDeleted successfully:!!');
    }
}
