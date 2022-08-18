<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Schedule
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $all_schedule
 * @property int $id_area
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Area $area
 * @property Collection|ScheduleMedic[] $schedule_medics
 *
 * @package App\Models
 */
class Schedule extends Model
{
	protected $table = 'schedule';

	protected $casts = [
		'id_area' => 'int'
	];
	protected $dates = [
		'end_date',
		'start_date'
	];
	protected $fillable = [
		'name',
		'all_schedule',
		'start_date',
		'end_date',
		'id_area'
	];

	public function area()
	{
		return $this->belongsTo(Area::class, 'id_area');
	}

	public function users()
	{
		return $this->hasMany(User::class, 'id_schedule');
	}
}
