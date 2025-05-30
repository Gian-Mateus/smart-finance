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
 * Class Category
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $icon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property Collection|Subcategory[] $budgetsSubcategories
 * @property Collection|User[] $budgetsUsers
 * @property Collection|User[] $subcategoriesUsers
 * @property Collection|Budget[] $budgets
 * @property Collection|Subcategory[] $subcategories
 */
class Category extends Model
{
    protected $table = 'categories';

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
        'name',
        'icon',
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
            'name' => 'string',
            'icon' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<Budget, $this>
     */
    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'category_id', 'id');
    }

    /**
     * @return HasMany<Subcategory, $this>
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsToMany<Subcategory, $this>
     */
    public function budgetsSubcategories(): BelongsToMany
    {
        return $this->belongsToMany(Subcategory::class, 'budgets', 'id', 'id')
            ->withPivot('user_id', 'category_id', 'subcategory_id', 'recurrence', 'target_value', 'types', 'start_date', 'end_date');
    }

    /**
     * @return BelongsToMany<User, $this>
     */
    public function budgetsUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'budgets', 'id', 'id')
            ->withPivot('user_id', 'category_id', 'subcategory_id', 'recurrence', 'target_value', 'types', 'start_date', 'end_date');
    }

    /**
     * @return BelongsToMany<User, $this>
     */
    public function subcategoriesUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'subcategories', 'id', 'id')
            ->withPivot('category_id', 'user_id', 'name')
            ->withTimestamps();
    }
}
