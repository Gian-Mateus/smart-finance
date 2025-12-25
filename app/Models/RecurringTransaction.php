<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\RecurrenceJson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class RecurringTransaction
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $bank_account_id
 * @property string $catorsub_type
 * @property int $catorsub_id
 * @property int $recurrence_id
 * @property User $user
 * @property BanksAccount $bankAccount
 * @property RecurrenceType $recurrence
 */
class RecurringTransaction extends Model
{
    protected $table = 'recurring_transactions';

    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'user_id',
        'recurrence',
        'bank_account_id',
        'catorsub_type',
        'catorsub_id',
        'recurrence_id',
        'transaction_id',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'user_id' => 'integer',
            'recurrence' => RecurrenceJson::class,
            'bank_account_id' => 'integer',
            'catorsub_type' => 'string',
            'catorsub_id' => 'integer',
            'recurrence_id' => 'integer',
            'transaction_id' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo<BanksAccount, $this>
     */
    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BanksAccount::class, 'bank_account_id');
    }

    /**
     * @return BelongsTo<RecurrenceType, $this>
     */
    public function recurrence(): BelongsTo
    {
        return $this->belongsTo(RecurrenceType::class, 'recurrence_id');
    }

    /**
     * @return MorphTo<Model, $this>
     */
    public function catorsub(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'catorsub_type', 'catorsub_id');
    }

    /**
     * @return BelongsTo<Transaction, $this>
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
