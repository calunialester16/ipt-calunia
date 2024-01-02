@extends('base')

@section('content')
    <h1>Edit Student</h1>
    <form method="POST" action="{{ route('students.update', $student) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $student->name }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="course">Course:</label>
            <input type="text" name="course" id="course" value="{{ $student->course }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="year_level">Year Level:</label>
            <input type="text" name="year_level" id="year_level" value="{{ $student->year_level }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="text" name="age" id="age" value="{{ $student->age }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
@endsection
