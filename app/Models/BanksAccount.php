<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class BanksAccount
 *
 * @property int $id
 * @property int $user_id
 * @property int $bank_id
 * @property string $name
 * @property int|null $account_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Bank $bank
 * @property User $user
 * @property Collection|User[] $transactionsUsers
 * @property Collection|Subcategory[] $transactionsSubcategories
 * @property Collection|RecurrenceType[] $transactionsRecurrenceTypes
 * @property Collection|PaymentMethod[] $transactionsPaymentMethods
 * @property Collection|Transaction[] $transactions
 */
class BanksAccount extends Model
{
    protected $table = 'banks_accounts';

    protected $primaryKey = 'id';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'bank_id',
        'name',
        'account_number',
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
            'user_id' => 'integer',
            'bank_id' => 'integer',
            'name' => 'string',
            'account_number' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<Transaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'bank_account_id', 'id');
    }

    /**
     * @return BelongsTo<Bank, $this>
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
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

    /**
     * @return BelongsToMany<Subcategory, $this>
     */
    public function transactionsSubcategories(): BelongsToMany
    {
        return $this->belongsToMany(Subcategory::class, 'transactions', 'id', 'id')
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
     * @return BelongsToMany<PaymentMethod, $this>
     */
    public function transactionsPaymentMethods(): BelongsToMany
    {
        return $this->belongsToMany(PaymentMethod::class, 'transactions', 'id', 'id')
            ->withPivot('user_id', 'bank_account_id', 'subcategory_id', 'recurrence_types_id', 'payment_methods_id', 'value', 'date', 'description', 'observation', 'type')
            ->withTimestamps();
    }
}
