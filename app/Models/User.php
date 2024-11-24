<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|BanksAccount[] $banks_accounts
 * @property Collection|Budget[] $budgets
 * @property Collection|Category[] $categories
 * @property Collection|Import[] $imports
 * @property Collection|Subcategory[] $subcategories
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token'
	];

	public function banks_accounts()
	{
		return $this->hasMany(BanksAccount::class);
	}

	public function budgets()
	{
		return $this->hasMany(Budget::class);
	}

	public function categories()
	{
		return $this->hasMany(Category::class);
	}

	public function imports()
	{
		return $this->hasMany(Import::class);
	}

	public function subcategories()
	{
		return $this->hasMany(Subcategory::class);
	}
}
