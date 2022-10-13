<?php

namespace App\Http\Controllers;

use App\Models\mesVencido;
use Illuminate\Http\Request;

class mesVencidoController extends Controller
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
        return view('admin.mesVencido.index');
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mesVencido  $mesActual
     * @return \Illuminate\Http\Response
     */
    public function show(mesVencido $mesVencido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mesVencido  $professionaAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(mesVencido $mesVencido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mesVencido  $professionalAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mesVencido $mesVencido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mesVencido  $mesActual
     * @return \Illuminate\Http\Response
     */
    public function destroy(mesVencido $mesVencido)
    {
        //
    }
}
