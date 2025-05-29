<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class PaymentMethod
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|BanksAccount[] $transactionsBanksAccounts
 * @property Collection|RecurrenceType[] $transactionsRecurrenceTypes
 * @property Collection|Subcategory[] $transactionsSubcategories
 * @property Collection|Transaction[] $transactions
 */
class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

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
            'name' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<Transaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'payment_methods_id', 'id');
    }

    /**
     * @return BelongsToMany<BanksAccount, $this>
     */
    public function transactionsBanksAccounts(): BelongsToMany
    {
        return $this->belongsToMany(BanksAccount::class, 'transactions', 'id', 'id')
            ->withPivot('bank_account_id', 'subcategory_id', 'recurrence_types_id', 'payment_methods_id', 'value', 'date', 'description', 'observation', 'type')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany<RecurrenceType, $this>
     */
    public function transactionsRecurrenceTypes(): BelongsToMany
    {
        return $this->belongsToMany(RecurrenceType::class, 'transactions', 'id', 'id')
            ->withPivot('bank_account_id', 'subcategory_id', 'recurrence_types_id', 'payment_methods_id', 'value', 'date', 'description', 'observation', 'type')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany<Subcategory, $this>
     */
    public function transactionsSubcategories(): BelongsToMany
    {
        return $this->belongsToMany(Subcategory::class, 'transactions', 'id', 'id')
            ->withPivot('bank_account_id', 'subcategory_id', 'recurrence_types_id', 'payment_methods_id', 'value', 'date', 'description', 'observation', 'type')
            ->withTimestamps();
    }
}
