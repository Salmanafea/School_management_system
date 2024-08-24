<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\ProcessingFeeRepositoryInterface;

class ProcessingFeeController extends Controller
{
   protected $processing;
   public function __construct( ProcessingFeeRepositoryInterface $processing){
    $this->processing =$processing;
   }
    public function index()
    {
      return $this->processing->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->processing->store($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->processing->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->processing->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        return $this->processing->update($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->processing->destroy($request);

    }
}
