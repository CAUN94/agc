<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Alliance;
use App\Models\Professional;
use App\Models\Student;
use App\Models\TrainBook;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var string[]
	 */
	protected $fillable = [
		'name',
		'email',
		'lastnames',
		'rut',
		'gender',
		'phone',
		'password',
		'birthday',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function setnameAttribute($value) {
		$this->attributes['name'] = ucfirst(strtolower(trim($value)));
	}

	public function setrutAttribute($value) {
		$this->attributes['rut'] = Rut::parse($value)->format(Rut::FORMAT_WITH_DASH);
	}

	public function setpasswordAttribute($value) {
		$this->attributes['password'] = bcrypt($value);
	}

	public function setlastnamesAttribute($value) {
		$this->attributes['lastnames'] = ucwords(strtolower(trim($value)));
	}

	// public function setpasswordAttribute($value)
	// {
	//     $this->attributes['password'] = bcrypt($value);
	// }

	public function profilePic() {
		if (is_null($this->profile)) {
			return "/img/icon.png";
		}

		return Storage::url($this->profile);
	}

	public function fullName() {
		return $this->name . " " . $this->lastnames;
	}

	public function address() {
		if (is_null($this->address)) {
			return "Vacio";
		}
		return $this->address;
	}

	public function description() {
		if (is_null($this->description)) {
			return "Vacio";
		}
		return $this->description;
	}

	public function gender() {
		$gender = [
			'm' => 'Masculino',
			'f' => 'Femenino',
			'n' => 'No Especifica',
		];
		return $gender[$this->gender];
	}

	public function genderLetter() {
		$genderLetter = [
			'm' => 'o',
			'f' => 'a',
			'n' => '@',
		];
		return $genderLetter[$this->gender];
	}

	public function Student() {
		$student = $this->hasOne(Student::class)
			->where('start_day', '<=', \Carbon\Carbon::NOW())
			->where('start_day', '>=', \Carbon\Carbon::NOW()->subdays(31))
			->orderby('start_day', 'desc');

		if ($student->count() == 0) {
			$student = $this->hasOne(Student::class)
				->where('start_day', '<=', \Carbon\Carbon::NOW()->endOfMonth())
				->where('start_day', '>=', \Carbon\Carbon::NOW()->startOfMonth())
				->orderby('start_day', 'asc');
		}

		return $student;
	}

	public function allStudentPlan() {
		return $this->hasMany(Student::class)->orderby('start_day', 'asc');
	}

	public function notSettledPlan() {
		return $this->allStudentPlan()->where('settled', '0');
	}

	public function Training() {
		if ($this->isStudent()) {
			return $this->Student()->first()->Training();
		}
		return False;
	}

	public function alliance(){
        return $this->belongsToMany(Alliance::class,
            'users_alliances_pivot',
            'user_id',
            'alliance_id')->first();
    }

    public function hasAlliance(){
    	if (!is_null($this->alliance())){
    		return True;
    	}
        return False;
    }

    public function allianceDesc(){
    	if($this->hasAlliance()){
    		return (100-($this->alliance()->desc))/100;
    	}
    	return 1;

    }


	public function isStudent() {
		if (is_null($this->Student)) {
			return False;
		}
		return True;
	}

	public function Professional() {
		return $this->hasOne(Professional::class);
	}

	public function isProfessional() {
		if (is_null($this->Professional)) {
			return False;
		}
		return True;
	}

	public function Admin() {
		return $this->hasOne(Admin::class);
	}

	public function isAdmin() {
		if (is_null($this->Admin)) {
			return False;
		}
		return True;
	}

	public function Trainer() {
		return $this->hasOne(Trainer::class);
	}

	public function isTrainer() {
		if (is_null($this->Trainer)) {
			return False;
		}
		return True;
	}

	public function TrainBooks() {
		return $this->hasMany(TrainBook::class);
	}

	public function canBook() {
		if ($this->countBooks() >= $this->training->class()) {
			return False;
		}
		return True;
	}

	public function countBooks() {
		return $this->TrainBooks()->whereIN('train_appointment_id', $this->training->TrainAppointments->pluck('id')->toArray())->count();
	}

	public function age() {
		return \Carbon\Carbon::parse($this->birthday)->diffInYears(\Carbon\Carbon::now());
	}

	public function newPlan() {
		return 'new plan';
	}
}
