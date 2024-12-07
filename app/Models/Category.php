<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Budget;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Category
 * 
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|Budget[] $budgets
 * @property Collection|Subcategory[] $subcategories
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'categories';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'name'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function budgets()
	{
		return $this->hasMany(Budget::class);
	}

	public function subcategories()
	{
		return $this->hasMany(Subcategory::class);
	}
}
