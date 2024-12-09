@extends('layouts.home')

@section("content")
<div>
    <form method="POST" action="{{ route('students.update', $student->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
        </div>
        <div>
            <label class="form-label">Subjects and Grades:</label>
            <div class="row">
                @foreach (json_decode($student->subjects, true) as $subject => $grade)
                    <div class="col">
                        <div class="mb-3">
                            <input type="number" class="form-control" id="{{ $subject }}" name="subjects[{{ $subject }}]" value="{{ $grade }}" placeholder="{{ $subject }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div>
            <label class="form-label">Attendance:</label>
            <div class="row">
                @foreach (json_decode($student->attendance, true) as $subject => $attendance)
                    <div class="col">
                        <div class="mb-3">
                            <input type="number" class="form-control" id="{{ $subject }}" name="attendance[{{ $subject }}]" value="{{ $attendance }}" placeholder="{{ $subject }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-3">
            <label for="graduation_year" class="form-label">Graduation Year</label>
            <input type="number" class="form-control" id="graduation_year" name="graduation_year" value="{{ $student->graduation_year }}">
        </div>
        <button type="submit" class="btn btn-primary">Edit Student</button>
    </form>
</div>
@endsection