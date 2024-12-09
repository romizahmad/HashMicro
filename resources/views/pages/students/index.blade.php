@extends('layouts.home')

@section("content")
<div>
    <a class="btn btn-primary mb-5" href="{{ route('students.create') }}">Create Data</a>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" rowspan="2" class="text-center align-middle">#</th>
                <th scope="col" rowspan="2" class="text-center align-middle">Name</th>
                <th scope="col" colspan="3" class="text-center align-middle">Subjects</th>
                <th scope="col" colspan="3" class="text-center align-middle">Attendance (days)</th>
                <th scope="col" rowspan="2" class="text-center align-middle" style="width: 200px;">Action</th>
            </tr>
            <tr>
                <th scope="col" class="text-center">Math</th>
                <th scope="col" class="text-center">English</th>
                <th scope="col" class="text-center">Science</th>
                <th scope="col" class="text-center">Math</th>
                <th scope="col" class="text-center">English</th>
                <th scope="col" class="text-center">Science</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach ($students as $student)
                <tr>
                    <th scope="row" rowspan="2" class="text-center align-middle">{{ $no++ }}</th>
                    <td rowspan="2" class="align-middle">{{ $student['name'] }}</td>
                    @foreach (json_decode($student['subjects'], true) as $subject => $grade)
                        <td class="text-end align-middle">{{ $grade ? $grade : "" }}</td>
                    @endforeach
                    @foreach (json_decode($student['attendance'], true) as $subject => $attendance)
                        <td rowspan="2" class="text-end align-middle">{{ $attendance ? $attendance : "" }}</td>
                    @endforeach
                    <td rowspan="2" class="text-center align-middle">
                        <a href="{{ route('graduates.show', $student['id']) }}" class="btn btn-info mb-1">Show</a>
                        <a href="{{ route('students.edit', $student['id']) }}" class="btn btn-warning mb-1">Edit</a>
                        <form method="POST" action="{{ route('students.destroy', $student['id']) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end align-middle">
                        Average : {{ $student['calculate'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <div>
        <p>Total Student: {{ count($students) }}</p>
        <p>Average Attendance: {{ number_format($averageAttendance, 2) }} days</p>
        <p>Total Passing Students: {{ $passingStudents }}</p>
    </div>
</div>
@endsection
