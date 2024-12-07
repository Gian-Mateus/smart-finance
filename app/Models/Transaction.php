<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use App\Models\Import;
use App\Models\Subcategory;
use App\Models\BanksAccount;
use App\Models\RecurrenceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Transaction
 * 
 * @property int $id
 * @property int $bank_account_id
 * @property int|null $subcategory_id
 * @property int $recurrence_types_id
 * @property float $value
 * @property Carbon $date
 * @property string $description
 * @property string|null $observation
 * @property bool $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property BanksAccount $banks_account
 * @property RecurrenceType $recurrence_type
 * @property Subcategory|null $subcategory
 * @property Collection|Import[] $imports
 *
 * @package App\Models
 */
class Transaction extends Model
{
	protected $table = 'transactions';

	protected $casts = [
		'bank_account_id' => 'int',
		'subcategory_id' => 'int',
		'recurrence_types_id' => 'int',
		'value' => 'float',
		'date' => 'datetime',
		'type' => 'bool'
	];

	protected $fillable = [
		'bank_account_id',
		'subcategory_id',
		'recurrence_types_id',
		'value',
		'date',
		'description',
		'observation',
		'type'
	];

	public function banks_account()
	{
		return $this->belongsTo(BanksAccount::class, 'bank_account_id');
	}

	public function recurrence_type()
	{
		return $this->belongsTo(RecurrenceType::class, 'recurrence_types_id');
	}

	public function subcategory()
	{
		return $this->belongsTo(Subcategory::class);
	}

	public function imports()
	{
		return $this->belongsToMany(Import::class, 'imports_transactions')
					->withPivot('id');
	}
}
