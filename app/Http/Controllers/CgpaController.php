<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Semester;
use App\Models\Course;

class CgpaController extends Controller
{
    public function create()
    {
        return view('cgpa.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'semester_season'         => 'required|in:Autumn,Spring,Summer',
            'semester_year'           => 'required|integer|min:2000|max:' . (date('Y') + 6),
            'courses'                 => 'required|array|min:1',
            'courses.*.code'          => 'required|string|max:20',
            'courses.*.title'         => 'required|string|max:150',
            'courses.*.credits'       => 'required|numeric|min:1|max:6|decimal:0,1',
            'courses.*.grade'         => 'required|numeric|between:0,4.00',
        ]);

        //Find or create the semester
        $semester = Semester::firstOrCreate(
            [
                'user_id' => $user->id,
                'season'  => $validated['semester_season'],
                'year'    => $validated['semester_year'],
            ],
            [
                'name' => $validated['semester_season'] . ' ' . $validated['semester_year'],
            ]
        );

        //Save all submitted courses
        foreach ($validated['courses'] as $courseData) {
            Course::create([
                'semester_id' => $semester->id,
                'code'        => $courseData['code'],
                'title'       => $courseData['title'],
                'credits'     => $courseData['credits'],
                'grade'       => $courseData['grade'],
            ]);
        }
        $semester->load('courses');

        //Calculate real GPA
        $totalPoints  = 0.0;
        $totalCredits = 0.0;

        foreach ($semester->courses as $course) {
            $totalPoints  += $course->grade * $course->credits;
            $totalCredits += $course->credits;
        }

        $gpa = ($totalCredits > 0) ? round($totalPoints / $totalCredits, 2) : 0.00;
        $semester->update(['gpa' => $gpa]);

        //Redirect back with session data
        return redirect()->route('cgpa.create')
            ->with('gpa', $gpa)
            ->with('semester', $semester->name);

    }

    public function index()
    {
        $query = Semester::where('user_id', Auth::id());

        if (request('season')) {
            $query->where('season', request('season'));
        }

        if (request('year')) {
            $query->where('year', request('year'));
        }

        $semesters = $query->with('courses')->get();

        $totalPoints = 0.0;
        $totalCredits = 0.0;

        foreach (Semester::where('user_id', Auth::id())->with('courses')->get() as $semester) {
            foreach ($semester->courses as $course) {
                $totalPoints += $course->grade * $course->credits;
                $totalCredits += $course->credits;
            }
        }

        $cgpa = ($totalCredits > 0) ? round($totalPoints / $totalCredits, 2) : 0.00;

        return view('dashboard', compact('semesters', 'cgpa', 'totalCredits'));
    }
}