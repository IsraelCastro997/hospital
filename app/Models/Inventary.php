<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Inventary
 * 
 * @property int $id
 * @property string|null $name
 * @property int|null $quantity
 * @property int $id_area
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Area $area
 *
 * @package App\Models
 */
class Inventary extends Model
{
	protected $table = 'inventary';

	protected $casts = [
		'quantity' => 'int',
		'id_area' => 'int'
	];

	protected $fillable = [
		'name',
		'quantity',
		'id_area'
	];

	public function area()
	{
		return $this->belongsTo(Area::class, 'id_area');
	}
}
