<?php

declare(strict_types=1);

namespace App\Models;

use App\MoneyBRL;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Budget
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property int $subcategory_id
 * @property string $recurrence
 * @property int $target_value
 * @property string $types
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property Category $category
 * @property Subcategory $subcategory
 * @property User $user
 */
class Budget extends Model
{
    use MoneyBRL;
    
    protected $table = 'budgets';

    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'recurrence',
        'target_value',
        'types',
        'start_date',
        'end_date',
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
            'recurrence' => 'string',
            'target_value' => 'integer',
            'types' => 'string',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    /**
     * Get the parent budgetable model (category or subcategory).
     *
     * @return MorphTo
     */
    public function budgetable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function targetValue(): Attribute {
        return Attribute::make(
            get: fn ($value) => $this->showBRL($value),
            set: fn ($value) => $this->toInteger($value),
        );
    }

    protected function recurrence(): Attribute {
        return Attribute::make(
            get: fn ($value) => match ($value) {
                'monthly' => 'Mensal',
                'daily' => 'Diário',
                'weekly' => 'Semanal',
                'yearly' => 'Anual',
                default => $value,
            },
            set: fn ($value) => $value,
        );
    }
}
