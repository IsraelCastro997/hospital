<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ScheduleMedic
 * 
 * @property int $id
 * @property int $id_employee
 * @property int $id_schedule
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Schedule $schedule
 * @property User $user
 *
 * @package App\Models
 */
class ScheduleMedic extends Model
{
	protected $table = 'schedule_medic';

	protected $casts = [
		'id_employee' => 'int',
		'id_schedule' => 'int'
	];

	protected $fillable = [
		'id_employee',
		'id_schedule'
	];

	public function schedule()
	{
		return $this->belongsTo(Schedule::class, 'id_schedule');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_employee');
	}
}
