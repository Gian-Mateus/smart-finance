<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RecurrenceType
 * 
 * @property int $id
 * @property string $name
 * @property int|null $interval
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Budget[] $budgets
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class RecurrenceType extends Model
{
	protected $table = 'recurrence_types';

	protected $casts = [
		'interval' => 'int'
	];

	protected $fillable = [
		'name',
		'interval'
	];

	public function budgets()
	{
		return $this->hasMany(Budget::class);
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'recurrence_types_id');
	}
}
