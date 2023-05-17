<?php

namespace App\Http\Controllers;

use App\Mail\AdminNewStudent;
use App\Mail\NewStudent;
use App\Models\Student;
use App\Models\Training;
use App\Models\User;
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
			'terms' => 'required',
			'extra' => 'sometimes',
			'comment' => 'sometimes',
		]);
		$student = Student::create($attributes);
		$student->end_day = $student->lastPlan()->endMonth();
		$student->save();
		$student->newPlan($request, $request->months - 1);

		$user = User::find($student->user_id);
		\Mail::to($user->email)->send(new NewStudent($user));
		\Mail::to('desarrollo@justbetter.cl')->bcc('clinica@justbetter.cl')->bcc('you@justbetter.cl')->send(new AdminNewStudent($user));

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
		if (Training::find($request->training_id)->price == 0){
			FlashSession::flash('primary', 'No se puede contratar este plan');
			return redirect('/trainings');
		}
		$student = $student->lastPlan();
		$request->merge(['user_id' => Auth::id(),'terms' => 1,'comment' => $student->comment]);
		$attributes = $request->validate([
			'training_id' => ['required', 'exists:trainings,id'],
			'user_id' => ['required', 'exists:users,id'],
			'extra' => 'sometimes',

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
