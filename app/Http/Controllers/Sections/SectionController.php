<?php

namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Teacher;
use App\Http\Requests\StoreSectionRequest;

use Illuminate\Http\Request;

class SectionController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    // $Sections=Section::FindOrFail(3);
    // return $Sections->teachers;
    $Grades = Grade::with(['Sections'])->get();

    $list_Grades = Grade::all();
    $teachers=Teacher::all();

   return view('pages.Sections.Sections',compact('Grades','list_Grades','teachers'));

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreSectionRequest $request)
  {
    try{
        $validated = $request->validated();
        $sections=new Section;
        $sections->Name_Section=['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En];
        $sections->Grade_id=$request->Grade_id;
        $sections->Class_id=$request->Class_id;
        $sections->Status=1;
        $sections->save();
        $sections->teachers()->attach($request->teacher_id);

        toastr()->success(trans('message.success'));

        return redirect()->route('Sections.index');
    }
    catch(\Exception $e){
        return redirect()->back()->withErrors(['error'=>$e->getMessage()]);

    }



  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreSectionRequest $request)
  {
    try{
        $validated = $request->validated();
        $section=Section::FindOrFail($request->id);
        $section->Name_Section = ['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En];
        $section->Grade_id= $request->Grade_id;
        $section->Class_id= $request->Class_id;

        if(isset($request->Status)) {
            $section->Status = 1;
          } else {
            $section->Status = 2;
          }

           // update pivot tABLE
        if (isset($request->teacher_id)) {
            $section->teachers()->sync($request->teacher_id);
        } else {
            $section->teachers()->sync(array());
        }

          $section->save();
        toastr()->success(trans('message.Update'));

        return redirect()->route('Sections.index');


    }catch(\Exception $e){

        return redirect()->back()->withErrors(['error'=>$e->getMessage()]);

    }

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {

        $section=Section::FindOrFail($request->id)->delete();
        toastr()->success(trans('message.Delete'));
        return redirect()->route('Sections.index');







  }

  public function getclasses($id)
  {
      $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");

      return $list_classes;
  }


}

?>
