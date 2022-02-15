<?php

namespace App\Models;

use App\Models\Training;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Student extends Model {
	use HasFactory;

	protected $guarded = [];

	public function User() {
		return $this->belongsTo(User::class);
	}

	public function Training() {
		return $this->belongsTo(Training::class);
	}

	public function trainingPlan(){
		return $this->training->plan() ." ". ($this->extra > 0 ? '+ pauta' : '');
	}



	public function price() {
		if ($this->extra > 0){
			return ($this->training->price + $this->training->extra)*$this->user->alliancedesc();
		}
		return ($this->training->price)*$this->user->alliancedesc();
	}

	public function trainingPrice() {
		if ($this->extra){
			return Helper::moneda_chilena($this->training->price*$this->user->alliancedesc()) ." + ". Helper::moneda_chilena($this->training->extra*$this->user->alliancedesc());
		}
		return Helper::moneda_chilena($this->training->price*$this->user->alliancedesc());
	}

	public function isSettled() {
		if ($this->settled == 1) {
			return True;
		}
		return False;
	}

	public function isStartday($date) {
		$end_day = \Carbon\Carbon::parse($this->start_day);
		if ($end_day->dayOfWeek == 0) {
			$end_day->addDays(1);
		}
		$date = \Carbon\Carbon::parse($date);
		if ($end_day->diffInDays($date, false) == 0) {
			return true;
		}
		return false;
	}

	public function lastPlan() {
		$actual = $this;
		while ($actual->nextPlanAll()) {
			$actual = $actual->nextPlanAll();
		}
		return $actual;
	}

	public function lastPayPlan() {
		$actual = $this->nextPlan();
		while ($actual->nextPlan()) {
			if (!$actual->nextPlan()->isSettled()) {
				return $actual;
			}
			$actual = $actual->nextPlan();
		}
		return $actual;
	}

	public function islastday($date) {
		$end_day = \Carbon\Carbon::parse($this->start_day)->addDays($this->training->days);
		if ($end_day->dayOfWeek == 0) {
			$end_day->addDays(1);
		}
		$date = \Carbon\Carbon::parse($date);
		if ($end_day->diffInDays($date, false) == 0) {
			return $this;
		}
		$actual = $this;
		while ($actual->nextPlan()) {
			$actual = $actual->nextPlan();
			$end_day = \Carbon\Carbon::parse($actual->start_day)->addDays($this->training->days);
			if ($end_day->dayOfWeek == 0) {
				$end_day->addDays(1);
			}
			$date = \Carbon\Carbon::parse($date);
			if ($end_day->diffInDays($date, false) == 0) {
				return $actual;
			}
		}

		return false;
	}

	public function endMonth() {
		$endMonth = \Carbon\Carbon::parse($this->start_day);
		// if ($this->Training->isMonthly()) {
		// 	return $endMonth->addDays($this->training->days * $this->Training->class);
		// }
		return $endMonth->addDays($this->training->days);

	}

	public function start_day() {
		$start_day = \Carbon\Carbon::parse($this->start_day);
		return $start_day->format('d M Y');
	}

	public function availableday($date) {
		$start_day = \Carbon\Carbon::parse($this->start_day);
		$date = \Carbon\Carbon::parse($date);
		$now = \Carbon\Carbon::now();
		$diff = $start_day->diffInDays($date, false);
		$status = true;
		if ($start_day->diffInDays($date, false) < 0) {
			$status = false;
		}
		if ($now->diffInDays($date, false) < 0) {
			$status = false;
		}
		$days = 5;
		if ($this->isSettled()) {
			$days += $this->training->days;
		}
		if ($start_day->diffInDays($date, false) > $days) {
			$status = false;
		}
		return $status;
	}

	public function diffdaysPlan() {
		$days = \Carbon\Carbon::parse($this->start_day)->addDays($this->training->days)->diffInDays();

		if ($days == 1) {
			return $days . " día";
		}
		return $days . " días";
	}

	// public function getStart_dayAttribute()
	// {
	//     return \Carbon\Carbon::parse($this->attributes['start_day'])->format('H:i');
	// }

	public function nextPlan() {
		$start_day = \Carbon\Carbon::parse($this->start_day);
		$end_day = \Carbon\Carbon::parse($this->endMonth());
		$student = Student::where('user_id', Auth::id())
			->where('start_day', '>', $start_day)
			->where('start_day', '<=', $end_day)
			->where('settled', true);
		if ($student->count() >= 1) {
			return $student->first();
		}

		return False;
	}

	public function nextPlanAll() {
		$start_day = \Carbon\Carbon::parse($this->start_day);
		$end_day = \Carbon\Carbon::parse($this->endMonth());
		$student = Student::where('user_id', Auth::id())
			->where('start_day', '>', $start_day)
			->where('start_day', '<=', $end_day);
		if ($student->count() >= 1) {
			return $student->first();
		}

		return False;
	}

	public function isRenew() {
		if ($this->nextPlan()) {
			return $this->nextPlan()->isSettled();
		}
		return false;
	}

	public function newPlan($request, $it = 1) {
		$it = is_null($it) ? 1 : $it;
		for ($i = 0; $i < $it; $i++) {
			$new_student = new Student;
			$new_student->user_id = $this->user_id;
			$new_student->training_id = $request->training_id;
			$new_student->extra = $request->extra;
			$new_student->terms = $request->terms;
			$new_student->start_day = $this->lastPlan()->endMonth();
			$new_student->save();
		}
		return;
	}
}
