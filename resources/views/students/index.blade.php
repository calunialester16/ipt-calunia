@extends('base')

@section('content')
    <h1>Student List</h1>
    @role('admin')
    <a href="{{ route('students.create') }}" class="btn btn-success mb-3">Create Student</a>
    @endrole
    @if(count($students) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Age</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $student->image) }}" alt="{{ $student->name }}" width="50">
                        </td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->course }}</td>
                        <td>{{ $student->year_level }}</td>
                        <td>{{ $student->age }}</td>
                        <td>
                            <a href="{{ route('students.show', $student) }}" class="btn btn-info">Show</a> <!-- Add Show button -->
                            @role('admin')
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-secondary">Edit</a>
                            <form method="POST" action="{{ route('students.destroy', $student) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            @endrole
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No students found.</p>
    @endif
@endsection
