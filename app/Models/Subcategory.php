<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Subcategory
 * 
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property User $user
 * @property Collection|Budget[] $budgets
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class Subcategory extends Model
{
	protected $table = 'subcategories';

	protected $casts = [
		'category_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'category_id',
		'user_id',
		'name'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function budgets()
	{
		return $this->hasMany(Budget::class);
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}
}
