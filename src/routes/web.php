<?php

use App\Http\Controllers\SkillController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BriefAssignmentController;
use App\Http\Controllers\BriefController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvaluationLearnerController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});


Route::middleware('auth')->group(function () {

    Route::middleware(['role:ADMIN'])->prefix('admin')->name('admin.')->group(function(){

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users',[UserController::class,'index'])->name('users.index');
        Route::get('/users/create',[UserController::class,'create'])->name('users.create');
        Route::resource('users', UserController::class);
        Route::resource('classes', ClasseController::class);
        Route::resource('skills', SkillController::class);
        Route::resource('sprints', SprintController::class);


    });

    Route::middleware(['role:TRAINER'])->prefix('trainer')->name('trainer.')->group(function(){
        Route::get('/dashboard', [TrainerController::class, 'index'])->name('dashboard');
        Route::resource('briefs', BriefController::class);

        Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
        Route::get('/classes/{class}/assign', [ClassController::class, 'showAssignForm'])->name('classes.assign');
        Route::post('/classes/{class}/sync', [ClassController::class, 'syncLearners'])->name('classes.sync');

        Route::get('/classes/{class}/briefs', [BriefAssignmentController::class, 'showAssignForm'])->name('classes.briefs.assign');
        Route::post('/classes/{class}/briefs/attach', [BriefAssignmentController::class, 'attach'])->name('classes.briefs.attach');
        Route::post('/classes/{class}/briefs/{brief}/detach', [BriefAssignmentController::class, 'detach'])->name('classes.briefs.detach');

        Route::get('/evaluations/brief/{brief}/learner/{learner}', [EvaluationController::class, 'create'])->name('evaluations.create');
        Route::post('/evaluations/brief/{brief}/learner/{learner}', [EvaluationController::class, 'store'])->name('evaluations.store');

    });

   Route::middleware(['auth', 'role:LEARNER'])->prefix('learner')->name('learner.')->group(function () {

    Route::get('/dashboard', [LearnerController::class, 'index'])->name('dashboard');

    Route::prefix('briefs')->name('briefs.')->group(function() {
        Route::get('/', [LearnerController::class, 'index'])->name('index');
        Route::get('/{brief}', [LearnerController::class, 'show'])->name('show');
        Route::post('/{brief}/submit', [LearnerController::class, 'submit'])->name('submit');
    });

    Route::get('/evaluations', [EvaluationLearnerController::class, 'index'])->name('evaluations.index');
});

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
