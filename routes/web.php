<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CgpaController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    $semesters = $user->semesters()
        ->with('courses')
        ->orderBy('year', 'desc')
        ->orderByRaw("
            CASE season
                WHEN 'Autumn' THEN 1
                WHEN 'Summer' THEN 2
                WHEN 'Spring' THEN 3
                ELSE               4
            END ASC
        ")
        ->get();

    // Calculate overall CGPA
    $totalPoints = 0.0;
    $totalCredits = 0.0;
    foreach ($semesters as $semester) {
        foreach ($semester->courses as $course) {
            $totalPoints += $course->grade * $course->credits;
            $totalCredits += $course->credits;
        }
    }
    $cgpa = ($totalCredits > 0) ? round($totalPoints / $totalCredits, 2) : 0.00;

    return view('dashboard', compact('semesters', 'cgpa', 'totalCredits'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cgpa/create', [CgpaController::class, 'create'])->name('cgpa.create');
Route::post('/cgpa/store', [CgpaController::class, 'store'])->name('cgpa.store');


require __DIR__.'/auth.php';
