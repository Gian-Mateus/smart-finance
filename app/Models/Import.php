<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Import
 *
 * @property int $id
 * @property int $user_id
 * @property string $file_name
 * @property string $file_type
 * @property Carbon $imported_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 */
class Import extends Model
{
    protected $table = 'imports';

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
        'file_original_name',
        'file_locale_name',
        'file_path',
        'file_type',
        'banks_accounts_id',
        'status',
        'imported_at',
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
            'banks_accounts_id' => 'integer',
            'file_original_name' => 'string',
            'file_locale_name' => 'string',
            'file_path' => 'string',
            'file_type' => 'string',
            'imported_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function banksAccount(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'banks_accounts_id');
    }
}
