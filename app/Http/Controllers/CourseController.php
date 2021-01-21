<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class CourseController extends Controller {
    private $validations;

    public function __construct() {
        $this->validations = [
            'title' => 'required',
            'description' => 'required',
            'video_url' => '',
            'subject' => 'required',
            'level' => 'required',
            'duration' => 'required',
            'validity' => '',
        ];
    }

    public function index() {
        $courses = Course::with('user')->get();

        // Récupère le rôle
        $userRole = auth()->user()->role;

        return Inertia::render('Courses/Index', [
            'courses' => $courses,
            'userRole' => $userRole,
        ]);
    }

    public function show($id) {
        if (is_numeric($id)) {
            $course = Course::where('id', $id)->with('user')->first();

            // Récupère le nom de l'utilisateur
            $userName = auth()->user()->name;
            $userRole = auth()->user()->role;

            return Inertia::render('Courses/Show', [
                'course' => $course,
                'userName' => $userName,
                'userRole' => $userRole
            ]);
        }

        abort(404);
    }

    public function create() {
        return Inertia::render('Courses/Create');
    }

    public function store(Request $request) {
        $postData = $this->validate($request, $this->validations);

        Course::create([
            'title' => $postData['title'],
            'description' => $postData['description'],
            'video_url' => $postData['video_url'],
            'subject' => $postData['subject'],
            'level' => $postData['level'],
            'date' => Carbon::now(),
            'duration' => $postData['duration'],
            'validity' => $postData['validity'],
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('courses.index')->with('status', 'Le cours a bien été créé.');
    }

    public function destroy(Request $request) {
        Course::find($request->input('id'))->delete();
        return redirect()->route('courses.index')->with('status', 'Le cours a bien été supprimé.');
    }

    public function edit($id) {
        if (is_numeric($id)) {
            $course = Course::where('id', $id)->with('user')->first();
            $this->authorize('edit', $course);

            return Inertia::render('Courses/Edit', [
                'course' => $course,
            ]);
        } else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $rules = $this->validations;
        $rules['id'] = 'required|exists:courses';

        $postData = $this->validate($request, $rules);
        $course = Course::where('id', $postData['id']);
        $course->update($postData);

        return redirect()->route('courses.index');
    }
}
