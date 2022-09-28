<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Session as FlashSession;

class AdminStudentController extends Controller {
	public function __construct() {
		$this->middleware('intranet');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('admin.students.index');
	}

	public function wireframe() {
		return view('admin.students.wireframe');
	}

	public function wireframe2() {
		return view('admin.students.wireframe2');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Student  $student
	 * @return \Illuminate\Http\Response
	 */
	public function show($adminstudent) {

		$adminstudent = User::where('rut',$adminstudent)->first();
		return view('admin.students.show', compact('adminstudent'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Student  $student
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Student $adminstudent) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Student  $student
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $student) {
		$student = Student::find($student);
		if (Training::find($request->training_id)->price == 0){
			FlashSession::flash('primary', 'No se puede contratar este plan');
			return redirect('/trainings');
		}
		$student = $student->lastPlan();
		$request->merge(['user_id' => $student->user->id,'terms' => 1]);
		$attributes = $request->validate([
			'training_id' => ['required', 'exists:trainings,id'],
			'user_id' => ['required', 'exists:users,id'],
			'extra' => 'sometimes'
		]);

		$student->newPlan($request, $request->months);
		FlashSession::flash('primary', 'Nuevo Plan registrado');
		return redirect('/adminstudents/'.$student->user->rut);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Student  $student
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Student $student) {
		//
	}
}
