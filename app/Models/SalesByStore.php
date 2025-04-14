<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SalesByStore
 * 
 * @property string|null $store
 * @property string|null $manager
 * @property float|null $total_sales
 *
 * @package App\Models
 */
class SalesByStore extends Model
{
	protected $table = 'sales_by_store';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'total_sales' => 'float'
	];

	protected $fillable = [
		'store',
		'manager',
		'total_sales'
	];
}
