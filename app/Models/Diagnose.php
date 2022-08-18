<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Diagnose
 * 
 * @property int $id
 * @property int $id_patient
 * @property int $id_doctor
 * @property string|null $disease
 * @property string|null $description
 * @property float|null $weight
 * @property string|null $notes
 * @property string|null $drugs
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Patient $patient
 * @property Collection|File[] $files
 *
 * @package App\Models
 */
class Diagnose extends Model
{
	protected $table = 'diagnose';

	protected $casts = [
		'id_patient' => 'int',
		'id_doctor' => 'int',
		'weight' => 'float'
	];

	protected $fillable = [
		'id_patient',
		'id_doctor',
		'disease',
		'description',
		'weight',
		'notes',
		'drugs'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_doctor');
	}

	public function patient()
	{
		return $this->belongsTo(Patient::class, 'id_patient');
	}

	public function files()
	{
		return $this->hasMany(File::class, 'id_diagnose');
	}
}
