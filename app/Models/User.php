<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Alliance;
use App\Models\AppointmentMl;
use App\Models\Nutrition;
use App\Models\Professional;
use App\Models\Reception;
use App\Models\Search;
use App\Models\StravaUser;
use App\Models\Student;
use App\Models\TrainAppointment;
use App\Models\TrainBook;
use Carbon\Carbon;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Strava;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable {
	use HasApiTokens, HasFactory, Notifiable;
	use Search;

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
		'password_change_at'
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

	protected $searchable = [
        'rut',
        'name',
		'email',
		'lastnames',
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
		if(Rut::parse($value)->quiet()->validate()){
			$this->attributes['rut'] = strtolower(Rut::parse(Rut::parse($value)->normalize())->format(Rut::FORMAT_WITH_DASH));
        } else{
            $this->attributes['RUT'] = $value;
        }
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
	public function student() {
		return $this->students->first();
	}

	public function students() {
		$students = User::select("students.id","students.start_day","trainings.days")
                ->join('students','users.id', '=' ,'students.user_id')
                ->join('trainings','students.training_id', '=', 'trainings.id')
                ->where('users.id','=',$this->id)
                ->get();


        foreach ($students as $key => $student) {
			$start_day = \Carbon\Carbon::parse($student->start_day);
			$end_day = \Carbon\Carbon::parse($student->start_day)->addDays($student->days);
			$now = \Carbon\Carbon::now();
			if($now>=$start_day and $now <= $end_day){
				return $this->hasMany(Student::class)->where('students.id','=',$student->id);
			}
        }
        return $this->hasMany(Student::class)->orderby('id','asc');

	}

	public function allStudentPlan() {
		return $this->hasMany(Student::class)->orderby('start_day', 'desc');
	}

	public function notSettledPlan() {
		return $this->allStudentPlan()->where('settled', '0');
	}

	public function notSettledSumPlan() {
		$plans = $this->notSettledPlan()->pluck('training_id')->toArray();
		return Training::whereIN('id',$plans)->sum('price');
	}

	public function notSettledSumPlanIsHigh() {
		if($this->notSettledSumPlan()>0){
			return True;
		}
		return False;
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

    public function strava(){
        return $this->hasOne(StravaUser::class);
    }

    public function hasStrava(){
    	if (!is_null($this->strava())){
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
		if ($this->Student()) {
			return True;
		}
		return False;
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

	public function Reception() {
		return $this->hasOne(Reception::class);
	}

	public function isReception() {
		if (is_null($this->Reception)) {
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

	public function hasIntranet(){
		if($this->isAdmin() or $this->isProfessional() or $this->isTrainer() or $this->isReception() or $this->isNutritionist()){
			return true;
		}
		return false;
	}

	public function TrainBooks() {
		return $this->hasMany(TrainBook::class)->where('train_appointment_id','!=','null');
	}

	public function canBook($train_id) {
		if(in_array($this->training->id, [1,2,3,4])){
			if($this->countWeekBooks($train_id) >= 3){
				return false;
			}
			return true;
		}
		if ($this->countBooks() >= $this->training->class()) {
			return False;
		}
		return True;
	}

	public function countBooks() {
		return $this->TrainBooks()->whereIN('train_appointment_id', $this->training->TrainAppointments->pluck('id')->toArray())->count();
	}

	public function countWeekBooks($train_id) {
		$date = TrainAppointment::find($train_id)->date;
		$startOfWeek = \Carbon\Carbon::parse($date)->startOfWeek()->format('Y-m-d');
		$endOfWeek = \Carbon\Carbon::parse($date)->endOfWeek()->format('Y-m-d');
		$train_ids = $this->training->TrainAppointments
			->where('date','>=', $startOfWeek)
			->where('date','<=', $endOfWeek)
			->pluck('id')
			->toArray();

		return $this->TrainBooks()
			->whereIN('train_appointment_id', $train_ids)
			->count();

	}

	public function age() {
		return \Carbon\Carbon::parse($this->birthday)->diffInYears(\Carbon\Carbon::now());
	}

	public function newPlan() {
		return 'new plan';
	}

	public function appointments(){
		return AppointmentMl::where('Rut_Paciente',$this->rut);
	}

	public function nextAppointments(){
		return $this->appointments()
			->whereIN('Estado',['Confirmado por teléfono','Agenda Online','No confirmado'])
			->where('Fecha','>=',Carbon::tomorrow()->format('Y-m-d'))
			->orderby('Fecha','asc')->orderby('Hora_inicio','asc');
	}

	public function getAppointments(){
		return $this->appointments()->get();
	}

	public function payments(){
		return PaymentMl::where('Rut',$this->rut);
	}

	public function getPayments(){
		return $this->payments()->get();
	}

	public function activitiesStrava(){
        $user = $this->strava->first();
        $token = $user->access_token;
        return Strava::activities($token,1,200);
    }

    // public function balance(){
    // 	$this->
    // }
    //

    public function sports(){
    	$activities = $this->activitiesStrava();
    	$sports = [];
    	foreach ($activities as $key => $value) {
    		$sports[] = $value->type;
    	}
    	return array_count_values($sports);
    }

    public function nutrition(){
		return Nutrition::where('rut',$this->rut)->orderby('fecha','desc');
	}

	public function hasNutrition(){
		if ($this->nutrition()->count()>0){
			return True;
		}
		return False;
	}

	public function nutritionist(){
		return $this->hasOne(Nutritionist::class);
	}

	public function isNutritionist(){
		if (Auth::guest()){
			return False;
		}
		if (is_null($this->nutritionist)){
			return False;
		}
		return True;
	}

	public function allRoles(){
		// check if user has any of this roles isProfessional() isAdmin() isReception() isTrainer() isNutritionist()

		$roles = [];
		if ($this->isProfessional()){
			$roles[] = 'professional';
		}
		if ($this->isAdmin()){
			$roles[] = 'admin';
		}
		if ($this->isReception()){
			$roles[] = 'reception';
		}
		if ($this->isTrainer()){
			$roles[] = 'trainer';
		}
		if ($this->isNutritionist()){
			$roles[] = 'nutritionist';
		}
		return $roles;

	}
}
