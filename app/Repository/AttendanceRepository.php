<?php


namespace App\Repository;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Attendance;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function index(){
       $Grades =Grade::with(['Sections'])->get();
       $List_Grades =Grade::all();
       $teachers = Teacher::all();
        return view('pages.Attendance.sections',compact('Grades','List_Grades','teachers'));

    }

    public function show($id){
        $students = Student::with(['attendance'])->where('section_id',$id)->get();
        return view('pages.Attendance.index',compact('students'));

    }

    public function store($request){
        try {

            foreach ($request->attendences as $studentid => $attendence) {

                if( $attendence == 'presence' ) {
                    $attendence_status = true;
                } else if( $attendence == 'absent' ){
                    $attendence_status = false;
                }

                Attendance::create([
                    'student_id'=> $studentid,
                    'grade_id'=> $request->grade_id,
                    'classroom_id'=> $request->classroom_id,
                    'section_id'=> $request->section_id,
                    'teacher_id'=> 1,
                    'attendence_date'=> date('Y-m-d'),
                    'attendence_status'=> $attendence_status
                ]);

            }

            toastr()->success(trans('message.success'));
            return redirect()->back();

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
