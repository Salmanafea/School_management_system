<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quizze;


class QuestioneController extends Controller
{

    public function store(Request $request)
    {


        try {
            $question = new Question();
            $question->title = $request->title;
            $question->answer = $request->answer;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizze_id = $request->quizz_id;
            $question->save();
            toastr()->success(trans('message.success'));
              return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $quizz_id=$id;
        return view('pages.Teachers.dashboard.questions.create',compact('quizz_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question=Question::findorfail($id);
        $quizzes =Quizze::all();
        return view('pages.Teachers.dashboard.questions.edit',compact('question','quizzes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        try{
            $question = Question::findorfail($id);
            $question->title = $request->title;
            $question->answer=$request->answer;
            $question->right_answer=$request->right_answer;
            $question->score =$request->score;
            $question->save();
            toastr()->success(trans('message.Update'));
            return redirect()->back();


        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {     try{
        Question::destroy($id);
      toastr()->success(trans('message.Delete'));
      return redirect()->back();
      } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
