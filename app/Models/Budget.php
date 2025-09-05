<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\RecurrenceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Budget
 *
 * @property int $id
 * @property int $user_id
 * @property string $budgetable_type
 * @property int $budgetable_id
 * @property int $target_value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $recurrence_types_id
 * @property User $user
 * @property RecurrenceType $recurrenceTypes
 */
class Budget extends Model
{
    protected $table = 'budgets';

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
        'budgetable_type',
        'budgetable_id',
        'target_value',
        'recurrence_types_id',
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
            'budgetable_type' => 'string',
            'budgetable_id' => 'integer',
            'target_value' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'recurrence_types_id' => 'integer',
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
     * @return BelongsTo<RecurrenceType, $this>
     */
    public function recurrenceTypes(): BelongsTo
    {
        return $this->belongsTo(RecurrenceType::class, 'recurrence_types_id');
    }

    /**
     * @return MorphTo<Model, $this>
     */
    public function budgetable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'budgetable_type', 'budgetable_id');
    }
}
