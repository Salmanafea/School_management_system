<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Online_classe;
use App\Models\Grade;

class OflineZoomClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $online_classes=Online_classe::where('created_by',auth()->user()->email)->get();
        return view('pages.Teachers.dashboard.online_classes.index',compact('online_classes'));
    }


    public function create()
    {
        $Grades = Grade::all();
        return view('pages.Teachers.dashboard.online_classes.add',compact('Grades'));
    }


    public function store(Request $request)
    {
        try {
            online_classe::create([

                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            toastr()->success(trans('message.success'));
            return redirect()->route('online_zoom_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function destroy(Request $request,string $id)
    {
        try{
            Online_classe::destroy($request->id);


        toastr()->success(trans('message.Delete'));
        return redirect()->route('online_zoom_classes.index');
        }catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }

    }
}
