<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['auth:sanctum', 'verified'], function () {

    // Page principale avec les cours
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

    // Page avec la description d'un cours
    Route::get('/course/{id}', [CourseController::class, 'show'])->name('courses.show');

    // Création d'un cours et stockage sur la bd
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create')->middleware('checkrole');
    Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');

    // Suppression d'un cours
    Route::delete('/course/destroy/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');

    // Édition d'un cours
    Route::get('/course/edit/{id}', [CourseController::class, 'edit'])->name('courses.edit');
    Route::patch('/course/{id}', [CourseController::class, 'update'])->name('courses.update');

    // Page de crédits
    Route::get('/credits', function () {
        return Inertia\Inertia::render('Credits');
    })->name('credits');

    // Page de contact
    Route::get('/contact', function () {
        return Inertia\Inertia::render('Contact');
    })->name('contact');
});
