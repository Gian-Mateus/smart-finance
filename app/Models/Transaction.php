<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Transaction
 *
 * @property int $id
 * @property string $id_transaction_external
 * @property int $user_id
 * @property int $bank_account_id
 * @property int|null $category_id
 * @property int|null $subcategory_id
 * @property int|null $recurrence_types_id
 * @property int|null $payment_methods_id
 * @property int $value
 * @property Carbon $date
 * @property string $description
 * @property string|null $observation
 * @property bool $type
 * @property int|null $running_balance
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $imports_id
 * @property PaymentMethod $paymentMethods
 * @property RecurrenceType $recurrenceTypes
 * @property Subcategory $subcategory
 * @property Category $category
 * @property BanksAccount $bankAccount
 * @property User $user
 * @property Import $imports
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
        'id_transaction_external',
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
        'running_balance',
        'imports_id',
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
            'id_transaction_external' => 'string',
            'user_id' => 'integer',
            'bank_account_id' => 'integer',
            'category_id' => 'integer',
            'subcategory_id' => 'integer',
            'recurrence_types_id' => 'integer',
            'payment_methods_id' => 'integer',
            'value' => 'integer',
            'date' => 'datetime',
            'description' => 'string',
            'observation' => 'string',
            'type' => 'boolean',
            'running_balance' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'imports_id' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<BanksAccount, $this>
     */
    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BanksAccount::class, 'bank_account_id');
    }

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo<Subcategory, $this>
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    /**
     * @return BelongsTo<RecurrenceType, $this>
     */
    public function recurrenceType(): BelongsTo
    {
        return $this->belongsTo(RecurrenceType::class, 'recurrence_types_id');
    }

    /**
     * @return BelongsTo<PaymentMethod, $this>
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_methods_id');
    }

    /**
     * @return BelongsTo<Import, $this>
     */
    public function import(): BelongsTo
    {
        return $this->belongsTo(Import::class, 'imports_id');
    }
}
