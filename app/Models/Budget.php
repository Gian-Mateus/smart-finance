<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\MoneyBRL;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\RecurrenceType;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Budget
 * 
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property int $subcategory_id
 * @property int|null $recurrence_type_id
 * @property float $target_value
 * @property string $types
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * 
 * @property Category $category
 * @property RecurrenceType|null $recurrence_type
 * @property Subcategory $subcategory
 * @property User $user
 *
 * @package App\Models
 */
class Budget extends Model
{
	use MoneyBRL;
	protected $table = 'budgets';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'category_id' => 'int',
		'subcategory_id' => 'int',
		'recurrence_type_id' => 'int',
		'target_value' => 'int',
		'start_date' => 'datetime',
		'end_date' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'category_id',
		'subcategory_id',
		'recurrence_type_id',
		'target_value',
		'types',
		'start_date',
		'end_date'
	];

	// Accessor para obter o valor formatado
	public function getFormattedTargetValueAttribute()
	{
		// Primeiro converte para decimal, depois formata
		$decimalValue = $this->toDecimal($this->attributes['target_value']);
		return $this->showBRL($decimalValue);
	}
	
	// Accessor para converter automaticamente ao acessar
	public function getTargetValueAttribute($value)
	{
		return $this->toDecimal($value);
	}
	
	// Mutator para converter automaticamente ao salvar
	public function setTargetValueAttribute($value)
	{
		$this->attributes['target_value'] = $this->toInteger($value);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function recurrence_type()
	{
		return $this->belongsTo(RecurrenceType::class);
	}

	/* public function subcategory()
	{
		return $this->belongsTo(Subcategory::class);
	}
 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
