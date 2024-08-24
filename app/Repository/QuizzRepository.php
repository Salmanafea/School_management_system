<?php

namespace App\Repository;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Grade;



class QuizzRepository implements QuizzRepositoryInterface
{
  public function index(){
    $quizzes =Quizze::all();
    return view('pages.Quizzes.index',compact('quizzes'));

  }

  public function create(){
    $data['grades']=Grade::all();
    $data['subjects']=Subject::all();
    $data['teachers']=Teacher::all();
    return view('pages.Quizzes.create',$data);

  }
  public function store($request){
    try{
        $quizzes = new Quizze();
        $quizzes->name =['ar'=>$request->Name_ar,'en'=>$request->Name_en];
        $quizzes->subject_id=$request->subject_id;
        $quizzes->grade_id=$request->Grade_id;
        $quizzes->classroom_id=$request->Classroom_id;
        $quizzes->section_id=$request->section_id;
        $quizzes->teacher_id=$request->teacher_id;
        $quizzes->save();
        toastr()->success(trans('message.success'));
        return redirect()->route('quizzes.index');

     } catch (\Exception $e) {

        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }



  }
  public function edit($id){
    $quizz=Quizze::findorfail($id);
    $data['grades']=Grade::all();
    $data['subjects']=Subject::all();
    $data['teachers']=Teacher::all();
    return view('pages.Quizzes.edit',$data,compact('quizz'));


  }

  public function update($request){
    try{
        $quizzes = Quizze::findorfail($request->id);
        $quizzes->name =['ar'=>$request->Name_ar,'en'=>$request->Name_en];
        $quizzes->subject_id=$request->subject_id;
        $quizzes->grade_id=$request->Grade_id;
        $quizzes->classroom_id=$request->Classroom_id;
        $quizzes->section_id=$request->section_id;
        $quizzes->teacher_id=$request->teacher_id;
        $quizzes->save();
        toastr()->success(trans('message.Update'));
        return redirect()->route('quizzes.index');


    } catch (\Exception $e) {

        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

  }

  public function destroy($request){
    try{
        Quizze::destroy($request->id);
        toastr()->error(trans('message.Delete'));
            return redirect()->back();

    } catch (\Exception $e) {

        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }


}

