<?php
namespace App\Repository;
use App\Models\Grade;
use App\Models\Fee;
use App\Models\Classroom;
use Illuminate\Support\Facades\DB;
class FeesRepository implements FeesRepositoryInterface{

    public function index(){
        $Fees=Fee::all();
        $Grades=Grade::all();

        return view('pages.Fees.index',compact('Fees','Grades'));
    }
    public function create(){
        $Grades=Grade::all();
        $Classrooms=Classroom::all();
        return view('pages.Fees.add',compact('Grades','Classrooms'));
    }
    public function store($request){

        try {

            $fee = new Fee();
            $fee->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fee->amount  =$request->amount;
            $fee->Grade_id  =$request->Grade_id;
            $fee->Classroom_id  =$request->Classroom_id;
            $fee->description  =$request->description;
            $fee->year  =$request->year;
            $fee->Fee_type  =$request->Fee_type;
            $fee->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('Fees.index');

        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id){
        $Fee=Fee::FindOrFail($id);
        $Grades=Grade::all();
        // $feeTypes = DB::table('fees')->select('Fee_type')->distinct()->get();
        return view('pages.Fees.edit',compact('Fee','Grades'));
    }

    public function update($request){
        try{


        $Fee=Fee::FindOrFail($request->id);
        $Fee->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
        $Fee->amount  =$request->amount;
        $Fee->Grade_id  =$request->Grade_id;
        $Fee->Classroom_id  =$request->Classroom_id;
        $Fee->description  =$request->description;
        $Fee->year  =$request->year;
        // $Fee->Fee_type  =$request->Fee_type;
        $Fee->save();
        toastr()->success(trans('message.success'));
        return redirect()->route('Fees.index');


    }
    catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}

public function destroy($request){
    try{
        Fee::destroy($request->id);
        toastr()->error(trans('message.Delete'));
        return redirect()->back();

    }

    catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

}
}
