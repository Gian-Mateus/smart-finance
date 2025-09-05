<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use App\Models\Bank;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class BanksAccount
 *
 * @property int $id
 * @property int $user_id
 * @property int $bank_id
 * @property string $name
 * @property int|null $account_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property Bank $bank
 */
class BanksAccount extends Model
{
    protected $table = 'banks_accounts';

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
        'bank_id',
        'name',
        'account_number',
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
            'bank_id' => 'integer',
            'name' => 'string',
            'account_number' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Bank, $this>
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
