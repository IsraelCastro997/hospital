<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Patient
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property Carbon|null $birth_date
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $ns
 * @property string|null $CURP
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $gender
 * @property string|null $occupation
 * @property string|null $marita_status
 * @property float|null $weight
 * @property float|null $height
 * @property string|null $phone_sec
 * @property string|null $status
 * @property int $id_user
 * 
 * @property User $user
 * @property Collection|Diagnose[] $diagnoses
 *
 * @package App\Models
 */
class Patient extends Model
{
	use HasFactory;
	protected $table = 'patient';

	protected $casts = [
		'gender' => 'int',
		'weight' => 'float',
		'height' => 'float',
		'id_user' => 'int'
	];

	protected $dates = [
		'birth_date'
	];

	protected $fillable = [
		'name',
		'address',
		'birth_date',
		'phone',
		'email',
		'ns',
		'CURP',
		'gender',
		'occupation',
		'marita_status',
		'weight',
		'height',
		'phone_sec',
		'status',
		'id_user'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function diagnoses()
	{
		return $this->hasMany(Diagnose::class, 'id_patient');
	}
}
