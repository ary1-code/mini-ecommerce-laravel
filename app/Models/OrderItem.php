<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderItem
 * 
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $qty
 * @property int $total_price
 * @property int $price
 * @property int $disscount
 * @property int $total_disscount
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * 
 * @property Product $product
 * @property Order $order
 *
 * @package App\Models
 */
class OrderItem extends Model
{
	use SoftDeletes;
	protected $table = 'order_items';
	public static $snakeAttributes = false;

	protected $casts = [
		'order_id' => 'int',
		'product_id' => 'int',
		'qty' => 'int',
		'total_price' => 'int',
		'price' => 'int',
		'disscount' => 'int',
		'total_disscount' => 'int'
	];

	protected $fillable = [
		'order_id',
		'product_id',
		'qty',
		'total_price',
		'price',
		'disscount',
		'total_disscount'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
