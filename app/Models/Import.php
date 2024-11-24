<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Import
 * 
 * @property int $id
 * @property int $user_id
 * @property string $file_name
 * @property string $file_type
 * @property Carbon $imported_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class Import extends Model
{
	protected $table = 'imports';

	protected $casts = [
		'user_id' => 'int',
		'imported_at' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'file_name',
		'file_type',
		'imported_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function transactions()
	{
		return $this->belongsToMany(Transaction::class, 'imports_transactions')
					->withPivot('id');
	}
}
