<?php

namespace App\Http\Controllers;

use App\Models\mesActual;
use Illuminate\Http\Request;

class mesActualController extends Controller
{
    public function __construct() {
        $this->middleware('intranet');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.mesActual.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('admin.mesActual.show',compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mesActual  $professionaAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(mesActual $mesActual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mesActual  $professionalAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mesActual $mesActual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mesActual  $mesActual
     * @return \Illuminate\Http\Response
     */
    public function destroy(mesActual $mesActual)
    {
        //
    }
}
