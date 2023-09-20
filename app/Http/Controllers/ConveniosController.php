<?php

namespace App\Http\Controllers;

use App\Models\convenios;
use Illuminate\Http\Request;

class ConveniosController extends Controller
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
        return view('admin.convenios.index');
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
        return view('admin.convenios.show',compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\convenios  $professionaAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(convenios $convenios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\convenios  $professionalAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, convenios $convenios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\convenios  $mesActual
     * @return \Illuminate\Http\Response
     */
    public function destroy(convenios $convenios)
    {
        //
    }
}
