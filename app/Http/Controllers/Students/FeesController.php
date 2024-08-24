<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\FeesRepositoryInterface;
use App\Http\Requests\StoreFeesRequest;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    protected $Fees;
    public function __construct(FeesRepositoryInterface $Fees){
        $this->Fees=$Fees;
    }

    public function index()
    {
       return $this->Fees->index();

    }


    public function create()
    {
        return $this->Fees->create();

    }


    public function store(StoreFeesRequest $request)
    {
        return $this->Fees->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Fees->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFeesRequest $request)
    {
        return $this->Fees->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Fees->destroy($request);

    }
}
