@extends('layouts.home')

@section("content")
<div>
    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Input Name">
        </div>
        <div>
            <label class="form-label">Subjects and Grades:</label>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <input type="number" class="form-control" id="math" name="subjects[math]" placeholder="Math Grade">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <input type="number" class="form-control" id="math" name="subjects[english]" placeholder="English Grade">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <input type="number" class="form-control" id="math" name="subjects[science]" placeholder="Science Grade">
                    </div>
                </div>
            </div>
        </div>
        <div>
            <label class="form-label">Attendance:</label>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <input type="number" class="form-control" id="math" name="attendance[math]" placeholder="Math Attendance">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <input type="number" class="form-control" id="math" name="attendance[english]" placeholder="English Attendance">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <input type="number" class="form-control" id="math" name="attendance[science]" placeholder="Science Attendance">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Create Student</button>
    </form>
</div>
@endsection