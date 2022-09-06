<?php

namespace App\Http\Controllers;

use App\Models\ProfesionalAppointment;
use Illuminate\Http\Request;

class AdminProfessionalAppointmentsController extends Controller
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
        return view('admin.professionalAppointments.index');
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
     * @param  \App\Models\ProfessionalAppointment  $professionalAppointment
     * @return \Illuminate\Http\Response
     */
    public function show(ProfessionalAppointment $professionalAppointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfessionalAppointment  $professionaAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfessionalAppointment $professionalAppointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfessionalAppointment  $professionalAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfessionalAppointment $professionalAppointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfessionalAppointment  $professionalAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfessionalAppointment $professionalAppointment)
    {
        //
    }
}
