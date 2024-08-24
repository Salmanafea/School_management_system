<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\PromotionRepositoryInterface;

class PromotionController extends Controller
{

   protected $Promotion;
   public function __construct(PromotionRepositoryInterface $Promotion){
    $this->Promotion=$Promotion;

   }

    public function index()
    {
        return $this->Promotion->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Promotion->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Promotion->store($request);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Promotion->destroy($request);
    }
}
