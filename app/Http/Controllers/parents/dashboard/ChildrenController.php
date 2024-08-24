<?php

namespace App\Http\Controllers\parents\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Degree;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fee_invoice;
use App\Models\ReceiptStudent;
use App\Models\My_Parent;
use Illuminate\Support\Facades\Hash;

class ChildrenController extends Controller
{
    public function index(){
        $students = Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.children.index',compact('students'));
    }
    public function results($id)
    {

        $student = Student::findorFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            toastr()->error(trans('main_trans.There_is_an_error'));
            return redirect()->route('sons.index');
        }
        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            toastr()->error(trans('main_trans.There_are_no_results'));
            return redirect()->route('sons.index');
        }

        return view('pages.parents.degrees.index', compact('degrees'));

    }

    public function attendances(){
        $students = Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.Attendance.index',compact('students'));
    }

    public function attendancesSearch(Request $request)
    {
        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);

        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();

        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
            return view('pages.parents.Attendance.index', compact('Students', 'students'));
        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.parents.Attendance.index', compact('Students', 'students'));

        }

    }

    public function feessons(){
        $students_ids = Student::where('parent_id', auth()->user()->id)->pluck('id');
        $Fee_invoices = Fee_invoice::whereIn('student_id',$students_ids)->get();
         return view('pages.parents.fees.index', compact('Fee_invoices'));
    }
    public function receiptstudent($id){
        $student = Student::findorFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            toastr()->error(trans('main_trans.There_is_an_error'));
            return redirect()->route('sons.fees');
        }
        $receipt_students = ReceiptStudent::where('student_id',$id)->get();
        if ($receipt_students->isEmpty()) {
            toastr()->error(trans('main_trans.There_are_no_payments'));
            return redirect()->route('sons.fees');
        }
        return view('pages.parents.Reciept.index', compact('receipt_students'));

    }

    public function profile(){
        $information=My_Parent::findorfail(auth()->user()->id);
        return view('pages.parents.profile',compact('information'));

    }
    public function update(Request $request,string $id){
        $information=My_Parent::findorfail($id);

        if(!empty($request->password)){
            $information->Name_Father=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
            $information->password=Hash::make($request->password);
            $information->save();

        }else{
            $information->Name_Father=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
            $information->save();

        }
        toastr()->success(trans('message.Update'));
        return redirect()->back();

    }


}

