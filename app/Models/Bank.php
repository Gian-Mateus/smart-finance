<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Bank
 *
 * @property int $id
 * @property string $name
 * @property string|null $full_name
 * @property string|null $ispb
 * @property string|null $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|BanksAccount[] $banksAccounts
 */
class Bank extends Model
{
    protected $table = 'banks';

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
        'full_name',
        'ispb',
        'code',
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
            'full_name' => 'string',
            'ispb' => 'string',
            'code' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<BanksAccount, $this>
     */
    public function banksAccounts(): HasMany
    {
        return $this->hasMany(BanksAccount::class, 'bank_id', 'id');
    }
}
