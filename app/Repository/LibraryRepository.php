<?php

namespace App\Repository;
use App\Models\Library;
use App\Models\Grade;
use App\Http\Traits\AttachFilesTrait;

class LibraryRepository implements LibraryRepositoryInterface
{
    use AttachFilesTrait;
    public function index(){
        $books = Library::all();
        return view('pages.library.index',compact('books'));
    }
    public function create(){
        $grades =Grade::all();
        return view('pages.library.create',compact('grades'));

    }


    public function store($request){
        try {
            $books = new Library();
            $books->title = $request->title;
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();
            $this->uploadFile($request,'file_name');

            toastr()->success(trans('message.success'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function downloadAttachment  ($filename)
    {
        return response()->download (public_path('attachments/library/'.$filename));
    }

    public function edit($id){
        $grades =Grade::all();
        $book = Library::findorfail($id);
        return view('pages.library.edit',compact('grades','book'));
    }
    public function update($request){
        try{


        $book =Library::findorfail($request->id);
        $book->title =$request->title;
        if($request->hasfile('file_name')){

            $this->deleteFile($book->file_name);

            $this->uploadFile($request,'file_name');

            $file_name_new = $request->file('file_name')->getClientOriginalName();
            $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
        }


        $book->Grade_id = $request->Grade_id;
        $book->classroom_id = $request->Classroom_id;
        $book->section_id = $request->section_id;
        $book->teacher_id = 1;
        $book->save();
        toastr()->success(trans('message.Update'));
        return redirect()->route('library.index');
    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }

    }

    public function destroy($request){
        try{


        $this->deleteFile($request->file_name);
        Library::destroy($request->id);
        toastr()->success(trans('message.Delete'));
        return redirect()->route('library.index');

    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }

}

}
