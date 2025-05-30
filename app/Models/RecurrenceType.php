<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class RecurrenceType
 *
 * @property int $id
 * @property string $interval
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|BanksAccount[] $transactionsBanksAccounts
 * @property Collection|PaymentMethod[] $transactionsPaymentMethods
 * @property Collection|Subcategory[] $transactionsSubcategories
 * @property Collection|User[] $transactionsUsers
 * @property Collection|Transaction[] $transactions
 */
class RecurrenceType extends Model
{
    protected $table = 'recurrence_types';

    protected $primaryKey = 'id';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        '`interval`',
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
            'interval' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<Transaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'recurrence_types_id', 'id');
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
     * @return BelongsToMany<Subcategory, $this>
     */
    public function transactionsSubcategories(): BelongsToMany
    {
        return $this->belongsToMany(Subcategory::class, 'transactions', 'id', 'id')
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
