<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class RecurrenceType
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int|null $interval
 * @property int|null $day_of_month
 * @property string|null $week_day
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property int|null $occurrences
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property Collection|Budget[] $budgets
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
        'name',
        'type',
        'interval',
        'day_of_month',
        'week_day',
        'start_date',
        'end_date',
        'occurrences',
        'user_id',
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
            'type' => 'string',
            'interval' => 'integer',
            'day_of_month' => 'integer',
            'week_day' => 'string',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'occurrences' => 'integer',
            'user_id' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<Budget, $this>
     */
    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'recurrence_types_id', 'id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
