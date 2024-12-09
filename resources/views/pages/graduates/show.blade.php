@extends("layouts.home")

@section("content")
    <style>
        h1 {
            font-size: 32px;
            color: #007bff;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }
        strong {
            font-weight: 600;
        }
        .subject-list,
        .attendance-list {
            list-style-type: none;
            padding: 0;
        }
        .subject-list li,
        .attendance-list li {
            padding: 8px;
            background-color: #e9ecef;
            margin: 5px 0;
            border-radius: 5px;
        }
        .status {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
    </style>

    <div>
        <h1>{{ $graduate->name }}</h1>

        <p><strong>Subjects:</strong></p>
        <ul class="subject-list">
            @foreach (json_decode($graduate->subjects, true) as $subject => $grade)
                <li><strong>{{ $subject }}:</strong> {{ $grade ? $grade : 'Not graded yet' }}</li>
            @endforeach
        </ul>

        <p><strong>Attendance:</strong></p>
        <ul class="attendance-list">
            @foreach (json_decode($graduate->attendance, true) as $attendance => $days)
                <li><strong>{{ $attendance }}:</strong> {{ $days ? $days : 'No data' }} days</li>
            @endforeach
        </ul>

        <p><strong>Graduation Status:</strong></p>
        <div class="status">{{ $graduationStatus }}</div>
    </div>
@endsection