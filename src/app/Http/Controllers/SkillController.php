<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Enums\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::all()->groupBy('category');
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        $categories = SkillCategory::cases();
        return view('admin.skills.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'     => 'required|string|max:10|unique:skills,code',
            'name'     => 'required|string|max:255',
            'category' => ['required', new Enum(SkillCategory::class)],
        ]);

        Skill::create($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'New skill added to the pedagogical library.');
    }

    public function edit(Skill $skill)
    {
        $categories = SkillCategory::cases();
        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'code'     => 'required|string|max:10|unique:skills,code,' . $skill->id,
            'name'     => 'required|string|max:255',
            'category' => ['required', new Enum(SkillCategory::class)],
        ]);

        $skill->update($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        // cheeeck if skill is linked to briefs before deleting
        if ($skill->briefs()->exists()) {
            return redirect()->back()->with('error', 'This skill is used in projects and cannot be deleted.');
        }

        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill removed.');
    }
}
