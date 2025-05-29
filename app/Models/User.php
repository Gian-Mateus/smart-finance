<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
 * @property Collection|Bank[] $banksAccountsBanks
 * @property Collection|Category[] $budgetsCategories
 * @property Collection|RecurrenceType[] $budgetsRecurrenceTypes
 * @property Collection|Subcategory[] $budgetsSubcategories
 * @property Collection|Category[] $subcategoriesCategories
 * @property Collection|BanksAccount[] $banksAccounts
 * @property Collection|Budget[] $budgets
 * @property Collection|Category[] $categories
 * @property Collection|Import[] $imports
 * @property Collection|Subcategory[] $subcategories
 */
class User extends Authenticatable
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'email' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'string',
            'remember_token' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<BanksAccount, $this>
     */
    public function banksAccounts(): HasMany
    {
        return $this->hasMany(BanksAccount::class, 'user_id', 'id');
    }

    /**
     * @return HasMany<Budget, $this>
     */
    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'user_id', 'id');
    }

    /**
     * @return HasMany<Category, $this>
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'user_id', 'id');
    }

    /**
     * @return HasMany<Import, $this>
     */
    public function imports(): HasMany
    {
        return $this->hasMany(Import::class, 'user_id', 'id');
    }

    /**
     * @return HasMany<Subcategory, $this>
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class, 'user_id', 'id');
    }

    /**
     * @return BelongsToMany<Bank, $this>
     */
    public function banksAccountsBanks(): BelongsToMany
    {
        return $this->belongsToMany(Bank::class, 'banks_accounts', 'id', 'id')
            ->withPivot('user_id', 'bank_id', 'name', 'account_number')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany<Category, $this>
     */
    public function budgetsCategories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'budgets', 'id', 'id')
            ->withPivot('user_id', 'category_id', 'subcategory_id', 'recurrence_type_id', 'target_value', 'types', 'start_date', 'end_date');
    }

    /**
     * @return BelongsToMany<RecurrenceType, $this>
     */
    public function budgetsRecurrenceTypes(): BelongsToMany
    {
        return $this->belongsToMany(RecurrenceType::class, 'budgets', 'id', 'id')
            ->withPivot('user_id', 'category_id', 'subcategory_id', 'recurrence_type_id', 'target_value', 'types', 'start_date', 'end_date');
    }

    /**
     * @return BelongsToMany<Subcategory, $this>
     */
    public function budgetsSubcategories(): BelongsToMany
    {
        return $this->belongsToMany(Subcategory::class, 'budgets', 'id', 'id')
            ->withPivot('user_id', 'category_id', 'subcategory_id', 'recurrence_type_id', 'target_value', 'types', 'start_date', 'end_date');
    }

    /**
     * @return BelongsToMany<Category, $this>
     */
    public function subcategoriesCategories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'subcategories', 'id', 'id')
            ->withPivot('category_id', 'user_id', 'name')
            ->withTimestamps();
    }
}
