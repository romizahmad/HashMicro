<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        $students = $students->map(function ($student) {
            return array_merge(
                $student->toArray(),
                ['calculate' => $this->calculateGrade($student)]
            );
        });

        $calculateTotal = $this->calculate($students);

        return view('pages.students.index', [
            'students' => $students,
            'averageAttendance' => $calculateTotal['averageAttendance'],
            'passingStudents' => $calculateTotal['passingStudents']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->subjects = json_encode($request->subjects);
        $student->attendance = json_encode($request->attendance);
        $student->save();

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.students.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->subjects = json_encode($request->subjects);
        $student->attendance = json_encode($request->attendance);
        $student->graduation_year = $request->graduation_year;
        $student->save();

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index');
    }

    /**
     * Calculate average grade 
     *
     * @return \Illuminate\Http\Response
     */
    public function calculateGrade($student)
    {
        $subjects = json_decode($student->subjects, true);
        $totalGrades = 0;
        $subjectCount = count($subjects);

        foreach ($subjects as $grade) {
            $totalGrades += $grade;
        }

        return $subjectCount > 0 ? $totalGrades / $subjectCount : 0;
    }

    /**
     * Calculate total 
     *
     * @return \Illuminate\Http\Response
     */
    public function calculate($students)
    {
        try {
            $passingStudents = 0;
            $totalAttendance = 0;
            $avg = 0;

            foreach ($students as $student) {
                $gradeByStudent = 0;
                $pass = false;

                $subjects = json_decode($student['subjects'], true);
                $attendance = json_decode($student['attendance'], true);

                foreach ($subjects as $subject => $grade) {
                    $gradeByStudent += $grade;

                    if (isset($attendance[$subject])) {
                        $totalAttendance += $attendance[$subject];
                        if ($attendance[$subject] < 10) {
                            $pass = false;
                        }
                    }
                }
                if ($gradeByStudent / count($subjects) >= 70) {
                    $pass = true;
                }

                if ($pass) $passingStudents++;
                $avg = count($students) * count($subjects);
            }

            $averageAttendance = $totalAttendance > 0 ? $totalAttendance / $avg : 0;

            return ['averageAttendance' => $averageAttendance, 'passingStudents' => $passingStudents];
        } catch (\Throwable $th) {
            return ['averageAttendance' => 0, 'passingStudents' => 0];
        }
    }
}
