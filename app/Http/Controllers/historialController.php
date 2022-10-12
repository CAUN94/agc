<?php

namespace App\Http\Controllers;

use App\Models\historial;
use Illuminate\Http\Request;

class historialController extends Controller
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
        return view('admin.historial.index');
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
     * @param  \App\Models\historial  $mesActual
     * @return \Illuminate\Http\Response
     */
    public function show(historial $historial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\historial  $historial
     * @return \Illuminate\Http\Response
     */
    public function edit(historial $historial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\historial $historial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, historial $historial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\historial  $historial
     * @return \Illuminate\Http\Response
     */
    public function destroy(historial $historial)
    {
        //
    }
}
