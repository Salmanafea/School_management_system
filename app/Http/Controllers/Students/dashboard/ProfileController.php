<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    public function index(){
        $information=Student::findorfail(auth()->user()->id);
        return view('pages.Students.dashboard.profile',compact('information'));

    }


    public function update(Request $request,string $id){
        $information=Student::findorfail($id);

        if(!empty($request->password)){
            $information->name=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
            $information->password=Hash::make($request->password);
            $information->save();

        }else{
            $information->name=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
            $information->save();

        }
        toastr()->success(trans('message.Update'));
        return redirect()->back();

    }
}
