<?php

namespace App\Http\Controllers;

use App\Models\TrainAppointment;
use Illuminate\Http\Request;

class AdminTrainAppointmentsController extends Controller
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
        return view('admin.trainAppointments.index');
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
     * @param  \App\Models\TrainAppointment  $trainAppointment
     * @return \Illuminate\Http\Response
     */
    public function show(TrainAppointment $trainAppointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrainAppointment  $trainAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(TrainAppointment $trainAppointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TrainAppointment  $trainAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrainAppointment $trainAppointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrainAppointment  $trainAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrainAppointment $trainAppointment)
    {
        //
    }

    public function confirmTrainAppointment(){
        return view('admin.trainAppointments.confirm');
    }
}
