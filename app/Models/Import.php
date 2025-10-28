<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Import
 *
 * @property int $id
 * @property int $user_id
 * @property string $file_original_name
 * @property string $file_locale_name
 * @property string $file_path
 * @property string $file_type
 * @property Carbon $imported_at
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $banks_accounts_id
 * @property User $user
 * @property BanksAccount $banksAccounts
 * @property Collection|Transaction[] $transactions
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
        'imported_at',
        'status',
        'banks_accounts_id',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        '$status' => 'pending',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'user_id' => 'integer',
            'file_original_name' => 'string',
            'file_locale_name' => 'string',
            'file_path' => 'string',
            'file_type' => 'string',
            'imported_at' => 'datetime',
            'status' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'banks_accounts_id' => 'integer',
        ];
    }

    /**
     * @return HasMany<Transaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'imports_id', 'id');
    }

    /**
     * @return BelongsTo<BanksAccount, $this>
     */
    public function banksAccounts(): BelongsTo
    {
        return $this->belongsTo(BanksAccount::class, 'banks_accounts_id');
    }
}
