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
 * Class Transaction
 *
 * @property int $id
 * @property int $bank_account_id
 * @property int|null $subcategory_id
 * @property int $recurrence_types_id
 * @property int $payment_methods_id
 * @property float $value
 * @property Carbon $date
 * @property string $description
 * @property string|null $observation
 * @property bool $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property BanksAccount $bankAccount
 * @property PaymentMethod $paymentMethods
 * @property RecurrenceType $recurrenceTypes
 * @property Subcategory $subcategory
 * @property Collection|Import[] $imports
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
        'bank_account_id',
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
            'bank_account_id' => 'integer',
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
     * @return BelongsTo<BanksAccount, $this>
     */
    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BanksAccount::class, 'bank_account_id');
    }

    /**
     * @return BelongsTo<PaymentMethod, $this>
     */
    public function paymentMethods(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_methods_id');
    }

    /**
     * @return BelongsTo<RecurrenceType, $this>
     */
    public function recurrenceTypes(): BelongsTo
    {
        return $this->belongsTo(RecurrenceType::class, 'recurrence_types_id');
    }

    /**
     * @return BelongsTo<Subcategory, $this>
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    /**
     * @return BelongsToMany<Import, $this>
     */
    public function imports(): BelongsToMany
    {
        return $this->belongsToMany(Import::class, 'imports_transactions', 'id', 'id')
            ->withPivot('import_id', 'transaction_id');
    }
}
