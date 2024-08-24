<?php

namespace App\Repository;
use App\Models\Question;
use App\Models\Quizze;


class QuestionRepository implements QuestionRepositoryInterface
{
    public function index(){
        $questions=Question::get();
        return view('pages.Questions.index',compact('questions'));
    }
    public function create(){

        $quizzes =Quizze::get();
        return view('pages.Questions.create',compact('quizzes'));

    }
    public function store($request){
  try{
    $questions = new Question();
    $questions->title =['ar'=>$request->title_ar,'en'=>$request->title_en];
    $questions->answer=$request->answer;
    $questions->right_answer=$request->right_answer;
    $questions->score =$request->score;
    $questions->quizze_id=$request->quizze_id;
    $questions->save();
    toastr()->success(trans('message.success'));
    return redirect()->route('questions.index');

} catch (\Exception $e) {
    return redirect()->back()->with(['error' => $e->getMessage()]);
}

    }
    public function edit($id){
        $question=Question::findorfail($id);
        $quizzes =Quizze::all();
        return view('pages.Questions.edit',compact('question','quizzes'));
    }

    public function update($request){
        try{
            $questions = Question::findorfail($request->id);
            $questions->title =['en'=>$request->title_en,'ar'=>$request->title_ar];
            $questions->answer=$request->answer;
            $questions->right_answer=$request->right_answer;
            $questions->score =$request->score;
            $questions->quizze_id=$request->quizze_id;
            $questions->save();
            toastr()->success(trans('message.Update'));
            return redirect()->route('questions.index');


        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request){
        try{
        Question::destroy($request->id);
        toastr()->success(trans('message.Delete'));
        return redirect()->route('questions.index');

      } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}
