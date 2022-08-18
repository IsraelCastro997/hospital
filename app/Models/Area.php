<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Area
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $place
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Inventary[] $inventaries
 * @property Collection|Schedule[] $schedules
 *
 * @package App\Models
 */
class Area extends Model
{
	protected $table = 'area';

	protected $fillable = [
		'name',
		'place'
	];

	public function inventaries()
	{
		return $this->hasMany(Inventary::class, 'id_area');
	}

	public function schedules()
	{
		return $this->hasMany(Schedule::class, 'id_area');
	}
}
