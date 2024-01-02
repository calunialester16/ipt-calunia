@extends('base')

@section('content')
    <h1>Grade Student - {{ $student->name }}</h1>

    <h2>Existing Grades:</h2>
    @if(count($grades) > 0)
        <ul>
            @foreach($grades as $grade)
                <li>{{ $grade->subject }}: {{ $grade->score }}</li>
            @endforeach
        </ul>
    @else
        <p>No grades found for this student.</p>
    @endif

    <form method="POST" action="{{ route('grades.store', $student) }}">
        @csrf
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="score">Score:</label>
            <input type="number" name="score" id="score" class="form-control" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Grade</button>
    </form>

    <a href="{{ route('students.show', $student) }}" class="btn btn-secondary mt-3">Back to Student Details</a>
@endsection
