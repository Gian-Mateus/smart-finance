<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\Import;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ImportsTransaction
 * 
 * @property int $id
 * @property int $import_id
 * @property int $transaction_id
 * 
 * @property Import $import
 * @property Transaction $transaction
 *
 * @package App\Models
 */
class ImportsTransaction extends Model
{
	protected $table = 'imports_transactions';
	public $timestamps = false;

	protected $casts = [
		'import_id' => 'int',
		'transaction_id' => 'int'
	];

	protected $fillable = [
		'import_id',
		'transaction_id'
	];

	public function import()
	{
		return $this->belongsTo(Import::class);
	}

	public function transaction()
	{
		return $this->belongsTo(Transaction::class);
	}
}
