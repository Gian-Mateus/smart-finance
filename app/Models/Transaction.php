<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Transaction
 *
 * @property int $id
 * @property int $user_id
 * @property int $bank_account_id
 * @property int $category_id
 * @property int|null $subcategory_id
 * @property int|null $recurrence_types_id
 * @property int $payment_methods_id
 * @property float $value
 * @property Carbon $date
 * @property string $description
 * @property string|null $observation
 * @property bool $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property BanksAccount $bankAccount
 * @property Category $category
 * @property Subcategory $subcategory
 * @property RecurrenceType $recurrenceTypes
 * @property PaymentMethod $paymentMethods
 * @property Collection|ImportsTransaction[] $importsTransactions
 */
class Transaction extends Model
{
    protected $table = 'transactions';

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
        'bank_account_id',
        'category_id',
        'subcategory_id',
        'recurrence_types_id',
        'payment_methods_id',
        'value',
        'date',
        'description',
        'observation',
        'type',
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
            'bank_account_id' => 'integer',
            'category_id' => 'integer',
            'subcategory_id' => 'integer',
            'recurrence_types_id' => 'integer',
            'payment_methods_id' => 'integer',
            'value' => 'float',
            'date' => 'datetime',
            'description' => 'string',
            'observation' => 'string',
            'type' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<ImportsTransaction, $this>
     */
    public function importsTransactions(): HasMany
    {
        return $this->hasMany(ImportsTransaction::class, 'transaction_id', 'id');
    }

    /**
     * @return BelongsTo<PaymentMethod, $this>
     */
    public function paymentMethods(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_methods_id');
    }
}
