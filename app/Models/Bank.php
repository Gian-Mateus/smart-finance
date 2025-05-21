<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use App\Models\BanksAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Bank
 * 
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|BanksAccount[] $banks_accounts
 *
 * @package App\Models
 */
class Bank extends Model
{
	protected $table = 'banks';

	protected $fillable = [
		'ispb',
		'name',
		'code',
		'full_name',
		'ispb'
	];

	public function banks_accounts()
	{
		return $this->hasMany(BanksAccount::class);
	}
}
