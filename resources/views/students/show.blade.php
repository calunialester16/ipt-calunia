@extends('base')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('storage/' . $student->image) }}" alt="{{ $student->name }}" class="card-img-top rounded-circle" style="max-height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h2 class="card-title">{{ $student->name }}</h2>
                    <p><strong>Course:</strong> {{ $student->course }}</p>
                    <p><strong>Year Level:</strong> {{ $student->year_level }}</p>
                    <p><strong>Age:</strong> {{ $student->age }}</p>
                </div>
                <a href="{{ route('students.index') }}" class="btn btn-primary mt-3 btn-block">Back to Student List</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Grades</h2>
                    @if(count($student->grades) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student->grades as $grade)
                            <tr>
                                <td>{{ $grade->subject }}</td>
                                <td>{{ $grade->score }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No grades found for this student.</p>
                    @endif
                </div>
            </div>
            <!-- Add a link/button for grades -->
            @role('admin')
            <a href="{{ route('grades.create', $student) }}" class="btn btn-info mt-3 btn-block">Add Grade</a>
            @endrole
        </div>
    </div>
</div>
@endsection
