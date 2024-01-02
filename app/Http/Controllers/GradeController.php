<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Events\UserLog;
use App\Notifications\GradeAddedNotification;

class GradeController extends Controller
{
    public function create(Student $student)
    {
        // Load existing grades for the student
        $grades = $student->grades;

        return view('grades.create', compact('student', 'grades'));
    }

    public function store(Request $request, Student $student)
    {
        // Validate the incoming request data
        $request->validate([
            'subject' => 'required',
            'score' => 'required|numeric|min:0|max:100',
        ]);

        // Create a new grade instance
        $grade = new Grade([
            'subject' => $request->input('subject'),
            'score' => $request->input('score'),
        ]);

        // Associate the grade with the student
        $student->grades()->save($grade);

        auth()->user()->notify(new GradeAddedNotification($student, $grade));

        return redirect()->route('grades.create', $student)->with('success', 'Grade added successfully');
    }
}
