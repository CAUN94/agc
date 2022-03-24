<?php

namespace App\Http\Controllers;

use App\Models\UserMl;
use Illuminate\Http\Request;

class UserMlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.usersml.index');
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
     * @param  \App\Models\UserMl  $userMl
     * @return \Illuminate\Http\Response
     */
    public function show(UserMl $userMl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMl  $userMl
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMl $userMl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMl  $userMl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMl $userMl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMl  $userMl
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMl $userMl)
    {
        //
    }
}
