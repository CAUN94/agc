<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Session as FlashSession;

class StudentController extends Controller {
	public function __construct() {
		$this->middleware('student')->only(['index']);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('students.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		abort(401);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$request->merge(['user_id' => Auth::id()]);
		$attributes = $request->validate([
			'training_id' => ['required', 'exists:trainings,id'],
			'user_id' => ['required', Rule::unique('students', 'user_id')],
			'start_day' => ['required', 'date', 'after:yesterday', 'before:' . \Carbon\Carbon::Now()->addMonth()->endOfMonth()],
		]);
		$student = Student::create($attributes);
		$student->newPlan($request, $request->months - 1);
		FlashSession::flash('primary', 'Registrado');
		return redirect('/users');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Student  $student
	 * @return \Illuminate\Http\Response
	 */
	public function show(Student $student) {
		abort(401);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Student  $student
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Student $student) {
		abort(401);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Student  $student
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Student $student) {
		$student = $student->lastPlan();
		$request->merge(['user_id' => Auth::id()]);
		$attributes = $request->validate([
			'training_id' => ['required', 'exists:trainings,id'],
			'user_id' => ['required', 'exists:users,id'],
		]);

		$student->newPlan($request, $request->months);
		FlashSession::flash('primary', 'Nuevo Plan registrado');
		return redirect('/users');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Student  $student
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Student $student) {
		abort(401);
	}
}
