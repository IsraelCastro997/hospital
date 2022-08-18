<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class User extends Model implements AuthenticatableContract
{
	use Authenticatable;
	use HasFactory;
	protected $table = 'users';

	protected $casts = [
		'gender' => 'int',
		'weight' => 'float',
		'height' => 'float',
		'salary' => 'float'
	];

	protected $dates = [
		'email_verified_at',
		'birth_date'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'image',
		'remember_token',
		'address',
		'birth_date',
		'phone',
		'ns',
		'CURP',
		'gender',
		'occupation',
		'marita_status',
		'weight',
		'height',
		'phone_sec',
		'status',
		'cetificate_number',
		'salary'
	];

	public function diagnoses()
	{
		return $this->hasMany(Diagnose::class, 'id_doctor');
	}

	public function patients()
	{
		return $this->hasMany(Patient::class, 'id_user');
	}

	public function schedule_medics()
	{
		return $this->hasMany(ScheduleMedic::class, 'id_employee');
	}
	 public function roles()
    {
        return $this
            ->belongsToMany(Role::class)
            ->withTimestamps();
    }
	public function schedule()
	{
		return $this->belongsTo(Schedule::class, 'id_schedule');
	}
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
	public function getrole()
    {
        $val=$this->roles()->first();
		return $val->name;
    }

}
