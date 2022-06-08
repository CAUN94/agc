<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use Session as FlashSession;

class AdminTrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('intranet');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.trainings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trainings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'class' => ['required', 'numeric'],
            'days' => ['required', 'numeric'],
            'period' => ['required', 'string'],
            'extra' => ['required', 'numeric'],
            'time_in_minutes' => ['required', 'numeric'],
            'type' => ['required', 'string'],
            'format' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'is_published' => ['required', 'numeric'],
        ]);
        $training = new Training;

        $training->name = $request->name;
        $training->class = $request->class;
        $training->days = $request->days;
        $training->period = $request->period;
        $training->extra = $request->extra;
        $training->time_in_minutes = $request->time_in_minutes;
        $training->type = $request->type;
        $training->format = $request->format;
        $training->price = $request->price;
        $training->description = $request->description;
        $training->is_published = $request->is_published;

        $training->save();

        FlashSession::flash('primary', 'Creado');
        return redirect('/adminclass/'.$training->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training = Training::find($id);
        return view('admin.trainings.edit',compact('training'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'class' => ['required', 'numeric'],
            'days' => ['required', 'numeric'],
            'period' => ['required', 'string'],
            'extra' => ['required', 'numeric'],
            'time_in_minutes' => ['required', 'numeric'],
            'type' => ['required', 'string'],
            'format' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'is_published' => ['required', 'numeric'],
        ]);
        $training = Training::find($id);

        $training->name = $request->name;
        $training->class = $request->class;
        $training->days = $request->days;
        $training->period = $request->period;
        $training->extra = $request->extra;
        $training->time_in_minutes = $request->time_in_minutes;
        $training->type = $request->type;
        $training->format = $request->format;
        $training->price = $request->price;
        $training->description = $request->description;
        $training->is_published = $request->is_published;

        $training->save();
        FlashSession::flash('primary', 'Actualizado');
        return redirect('/adminclass/'.$id.'/edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        //
    }
}
