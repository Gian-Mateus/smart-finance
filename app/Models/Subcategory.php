<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Subcategory
 *
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Category $category
 * @property User $user
 * @property Collection|Category[] $budgetsCategories
 * @property Collection|User[] $budgetsUsers
 * @property Collection|BanksAccount[] $transactionsBanksAccounts
 * @property Collection|PaymentMethod[] $transactionsPaymentMethods
 * @property Collection|RecurrenceType[] $transactionsRecurrenceTypes
 * @property Collection|User[] $transactionsUsers
 * @property Collection|Budget[] $budgets
 * @property Collection|Transaction[] $transactions
 */
class Subcategory extends Model
{
    protected $table = 'subcategories';

    protected $primaryKey = 'id';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'category_id',
        'user_id',
        'name',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'category_id' => 'integer',
            'user_id' => 'integer',
            'name' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($subcategory) {
            $subcategory->budgets()->delete();
        });
    }

    /**
     * @return MorphMany<Budget, $this>
     */
    public function budgets(): MorphMany
    {
        return $this->morphMany(Budget::class, 'budgetable');
    }

    /**
     * @return HasMany<Transaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'subcategory_id', 'id');
    }

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsToMany<Category, $this>
     */
    public function budgetsCategories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'budgets', 'id', 'id')
            ->withPivot('user_id', 'category_id', 'subcategory_id', 'recurrence', 'target_value', 'types', 'start_date', 'end_date');
    }

    /**
     * @return BelongsToMany<User, $this>
     */
    public function budgetsUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'budgets', 'id', 'id')
            ->withPivot('user_id', 'category_id', 'subcategory_id', 'recurrence', 'target_value', 'types', 'start_date', 'end_date');
    }

    /**
     * @return BelongsToMany<BanksAccount, $this>
     */
    public function transactionsBanksAccounts(): BelongsToMany
    {
        return $this->belongsToMany(BanksAccount::class, 'transactions', 'id', 'id')
            ->withPivot('user_id', 'bank_account_id', 'subcategory_id', 'recurrence_types_id', 'payment_methods_id', 'value', 'date', 'description', 'observation', 'type')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany<PaymentMethod, $this>
     */
    public function transactionsPaymentMethods(): BelongsToMany
    {
        return $this->belongsToMany(PaymentMethod::class, 'transactions', 'id', 'id')
            ->withPivot('user_id', 'bank_account_id', 'subcategory_id', 'recurrence_types_id', 'payment_methods_id', 'value', 'date', 'description', 'observation', 'type')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany<RecurrenceType, $this>
     */
    public function transactionsRecurrenceTypes(): BelongsToMany
    {
        return $this->belongsToMany(RecurrenceType::class, 'transactions', 'id', 'id')
            ->withPivot('user_id', 'bank_account_id', 'subcategory_id', 'recurrence_types_id', 'payment_methods_id', 'value', 'date', 'description', 'observation', 'type')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany<User, $this>
     */
    public function transactionsUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'transactions', 'id', 'id')
            ->withPivot('user_id', 'bank_account_id', 'subcategory_id', 'recurrence_types_id', 'payment_methods_id', 'value', 'date', 'description', 'observation', 'type')
            ->withTimestamps();
    }
}
