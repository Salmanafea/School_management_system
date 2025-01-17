<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $information=Teacher::findorfail(auth()->user()->id);
        return view('pages.Teachers.dashboard.profile',compact('information'));

    }
    public function update(Request $request,string $id){
        $information=Teacher::findorfail($id);

        if(!empty($request->password)){
            $information->Name=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
            $information->password=Hash::make($request->password);
            $information->save();

        }else{
            $information->Name=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
            $information->save();

        }
        toastr()->success(trans('message.Update'));
        return redirect()->back();

    }
}
