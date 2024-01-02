<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\UserLog;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'course' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'year_level' => 'required|integer',
            'age' => 'required|integer',
        ]);

        $imagePath = $request->file('image')->store('students', 'public');

        $student = new Student([
            'name' => $request->input('name'),
            'course' => $request->input('course'),
            'image' => $imagePath,
            'year_level' => $request->input('year_level'),
            'age' => $request->input('age'),
        ]);

        $student->save();

        $log_entry = Auth::user()->name . " added a student " . $student->name . " with the id# " . $student->id;
        event(new UserLog($log_entry));

        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'course' => 'required',
            'year_level' => 'required|integer',
            'age' => 'required|integer',
        ]);

        $data = $request->only(['name', 'course', 'year_level', 'age']);

        if ($request->hasFile('image')) {
            // Handle image update if a new image is uploaded
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            Storage::delete($student->image); // Delete the old image
            $imagePath = $request->file('image')->store('students', 'public');
            $data['image'] = $imagePath;
        }

        $student->update($data);

        $log_entry = Auth::user()->name . " updated a student " . $student->name . " with the id# " . $student->id;
        event(new UserLog($log_entry));

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        Storage::delete($student->image); // Delete the student's image file
        $student->delete();

        $log_entry = Auth::user()->name . " deleted a student " . $student->name . " with the id# " . $student->id;
        event(new UserLog($log_entry));

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
