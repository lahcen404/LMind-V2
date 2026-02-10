<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Learner;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        $user =User::create([
            'full_name' => $validated['full_name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'role'      => $validated['role'],
        ]);

        if ($validated['role'] === UserRole::LEARNER->value || $validated['role'] === UserRole::LEARNER) {
            Learner::create([
                'user_id' => $user->id,
                'training_class_id' => null 
            ]);
        } elseif ($validated['role'] === UserRole::TRAINER->value || $validated['role'] === UserRole::TRAINER) {
            Trainer::create([
                'user_id' => $user->id
            ]);
        }

        return redirect()->route('admin.users.index')->with('success','User Created successfully !!!');

    }


    public function show(string $id)
    {
        //
    }

    // display edit form
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // update user
   public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'role'      => ['required', new Enum(UserRole::class)],
            'password'  => 'nullable|min:8',
        ]);

        $user->full_name = $validated['full_name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!!!');
    }

    // delete user
    public function destroy(User $user)
    {

        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
