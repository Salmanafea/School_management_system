<?php

namespace App\Http\Controllers\Teachers;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;
use App\Http\Requests\StoreTeachers;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $Teacher;
    public function __construct(TeacherRepositoryInterface $Teacher){
        $this->Teacher =$Teacher;

    }

    public function index()
    {
        $Teachers=$this->Teacher->getAllTeachers();
        return view('pages.Teachers.Teachers',compact('Teachers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $specializations= $this->Teacher->Getspecialization();
       $genders=$this->Teacher->GetGender();
        return view('pages.Teachers.create',compact('specializations','genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeachers $request)
    {
        $this->Teacher->StoreTeachers($request);


        return redirect()->route('Teachers.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      $Teachers= $this ->Teacher->editTeachers($id);
      $specializations = $this->Teacher->Getspecialization();
      $genders = $this->Teacher->GetGender();
        return view('pages.Teachers.Edit',compact('Teachers','specializations','genders'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Teacher->UpdateTeachers($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
         return $this->Teacher->DeleteTeacher($request);

    }
}
