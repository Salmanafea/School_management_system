<?php
namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Http\Requests\StoreGradesRequest;
use Illuminate\Http\Request;
use App\Models\Classroom;



class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Grades = Grade::all();
    return view('pages.Grades.Grades',compact('Grades'));
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
  public function store(StoreGradesRequest $request)
  {
// if(Grade::where('Name->ar',$request->Name)->orWhere('Name->en',$request->Name_en)->exists()){
//     return redirect()->back()->withErrors(trans('Grades_trans.exists'));
// }



    try{
        $validated = $request->validated();

        $Grade=new Grade;
        $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
       $Grade->Notes = $request->Notes;
        $Grade->save();

        toastr()->success(trans('message.success'));

        return redirect()->route('Grades.index');
    }catch(\Exception $e){
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
  public function update(StoreGradesRequest $request)
  {
    try{

        $validated = $request->validated();
        $Grades= Grade::FindOrFail($request->id);
        $Grades->update([
         $Grades->Name= ['en' => $request->Name_en, 'ar' => $request->Name],
          $Grades->Notes= $request->Notes

        ]);


        toastr()->success(trans('message.Update'));

        return redirect()->route('Grades.index');
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


        $My_Classes_id=Classroom::where('Grade_id',$request->id)->pluck('Grade_id');
        if($My_Classes_id->Count()==0){
            $Grades=Grade::FindOrFail($request->id)->delete();
            toastr()->success(trans('message.Delete'));
            return redirect()->route('Grades.index');



        }
        else{
            toastr()->error(trans('Grades_trans.delete_Grade_Error'));
            return redirect()->route('Grades.index');


        }

    }

}


