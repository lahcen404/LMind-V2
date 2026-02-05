<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingClass;
use App\Models\User;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    /**
     * Display a listing of training promotions.
     */
    public function index()
    {
        $classes = TrainingClass::with('trainers.user')->get();
        
        // dd($classes);
        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new promotion.
     */
    public function create()
    {
        $trainers = User::where('role', 'Trainer')->get();
        // dd($trainers);
        return view('admin.classes.create', compact('trainers'));
    }

    /**
     * Store a newly created promotion in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255|unique:training_classes,name',
            'promotion'  => 'required|string|max:100',
            'user_id'    => 'required|exists:users,id',
        ]);

        // transaaction
        DB::transaction(function () use ($validated) {

            $class = TrainingClass::create([
                'name'      => $validated['name'],
                'promotion' => $validated['promotion'],
            ]);

            $trainer = Trainer::where('user_id', $validated['user_id'])->first();

            // attach trainer to pivot table maain
            if ($trainer) {
                $class->trainers()->attach($trainer->id, [
                    'trainer_type' => 'Main'
                ]);
            }
        });

        return redirect()->route('admin.classes.index')
            ->with('success', 'Promotion launched and trainer assigned successfully.');
    }

    /**
     * Show the form for editing a promotion.
     */
    public function edit(TrainingClass $class)
    {
        $trainers = User::where('role', 'Trainer')->get();

        return view('admin.classes.edit', compact('class', 'trainers'));
    }

    /**
     * Update the promotion details.
     */
    public function update(Request $request, TrainingClass $class)
    {
         $validated = $request->validate([
            'name'       => 'required|string|max:255|unique:training_classes,name,' . $class->id,
            'promotion'  => 'required|string|max:100',
            'user_id'    => 'required|exists:users,id',
        ]);

        DB::transaction(function () use ($validated, $class) {

            $class->update([
                'name'      => $validated['name'],
                'promotion' => $validated['promotion'],
            ]);


            $trainer = Trainer::where('user_id', $validated['user_id'])->first();

            // update pivot taable alsso
            if ($trainer) {
                $class->trainers()->sync([
                    $trainer->id => ['trainer_type' => 'Main']
                ]);
            }
        });

        return redirect()->route('admin.classes.index')
            ->with('success', 'Promotion registry updated successfully!!');
    }

    /**
     * Remove the promotion from the registry.
     */
    public function destroy(TrainingClass $class)
    {
        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Promotion DEleted successfully!!!');
    }
}
