<?php

namespace App\Http\Controllers;

use App\Models\AdminRemuneracion;
use Illuminate\Http\Request;

class adminRemuneracionController extends Controller
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
        return view('admin.adminRemuneracion.index');
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
        return view('admin.adminRemuneracion.show',compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\adminRemuneracion  $professionaAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(adminRemuneracion $adminRemuneracion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\adminRemuneracion  $professionalAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, adminRemuneracion $adminRemuneracion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mesActual  $mesActual
     * @return \Illuminate\Http\Response
     */
    public function destroy(adminRemuneracion $adminRemuneracion)
    {
        //
    }
}