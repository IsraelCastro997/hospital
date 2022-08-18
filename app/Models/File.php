<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 * 
 * @property int $id
 * @property int $id_diagnose
 * @property string|null $ulr_file
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Diagnose $diagnose
 *
 * @package App\Models
 */
class File extends Model
{
	protected $table = 'files';

	protected $casts = [
		'id_diagnose' => 'int'
	];

	protected $fillable = [
		'id_diagnose',
		'ulr_file'
	];

	public function diagnose()
	{
		return $this->belongsTo(Diagnose::class, 'id_diagnose');
	}
}
