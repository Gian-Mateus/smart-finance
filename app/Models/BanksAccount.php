<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use App\Models\Bank;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BanksAccount
 * 
 * @property int $id
 * @property int $user_id
 * @property int $bank_id
 * @property string $name
 * @property string|null $account_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Bank $bank
 * @property User $user
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class BanksAccount extends Model
{
	protected $table = 'banks_accounts';

	protected $casts = [
		'user_id' => 'int',
		'bank_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'bank_id',
		'name',
		'account_number'
	];

	public function bank()
	{
		return $this->belongsTo(Bank::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'bank_account_id');
	}
}
