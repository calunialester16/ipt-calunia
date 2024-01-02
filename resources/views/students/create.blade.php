@extends('base')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center">Create Student</h1>
                    <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="course" class="form-label">Course:</label>
                            <input type="text" name="course" id="course" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="year_level" class="form-label">Year Level:</label>
                            <input type="number" name="year_level" id="year_level" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age:</label>
                            <input type="number" name="age" id="age" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image:</label>
                            <input type="file" name="image" id="image" class="form-control-file" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Create Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
