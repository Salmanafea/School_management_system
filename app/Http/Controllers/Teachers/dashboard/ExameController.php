<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Degree;

class ExameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Quizze::where('teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.dashboard.Exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.dashboard.Exams.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $quizzes = new Quizze();
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = auth()->user()->id;
            $quizzes->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('Exams.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $questions= Question::where('quizze_id',$id)->get();
        $Exam = Quizze::findorFail($id);
        return view('pages.Teachers.dashboard.Questions.index',compact('questions','Exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Exam = Quizze::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.dashboard.Exams.edit', $data, compact('Exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $Exam = Quizze::findorFail($request->id);
            $Exam->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Exam->subject_id = $request->subject_id;
            $Exam->grade_id = $request->Grade_id;
            $Exam->classroom_id = $request->Classroom_id;
            $Exam->section_id = $request->section_id;
            $Exam->teacher_id = auth()->user()->id;
            $Exam->save();
            toastr()->success(trans('message.Update'));
            return redirect()->route('Exams.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Quizze::destroy($id);
            toastr()->error(trans('message.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Get_classroom($id){

        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;

    }

    //Get Sections
    public function Get_Section($id){

        $list_sections = Section::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }


    public function student_quizze($exam_id){

        $degrees=Degree::where('quizze_id',$exam_id)->get();
        return view('pages.Teachers.dashboard.Exams.student_quizze',compact('degrees'));

    }

    public function repeat_quizze(Request $request){

      Degree::where('student_id',$request->student_id)->where('quizze_id',$request->quizze_id)->delete();
      toastr()->success(trans('main_trans.The_test_was_opened'));
      return redirect()->back();

    }



}
