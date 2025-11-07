<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 *
 * @property int $id
 * @property string $name
 * @property string $name_en
 * @property int $category_id
 * @property int $price
 * @property int $qty
 * @property int $disscount
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 *
 * @property Category $category
 * @property Collection|OrderItem[] $orderItems
 * @property Collection|ProductImage[] $productImages
 *
 * @package App\Models
 */
class Product extends Model
{
	use SoftDeletes;
	protected $table = 'products';
	public static $snakeAttributes = false;

	protected $casts = [
		'category_id' => 'int',
		'price' => 'int',
		'qty' => 'int',
		'disscount' => 'int'
	];

	protected $fillable = [
		'name',
		'name_en',
		'category_id',
		'price',
		'qty',
		'disscount',
		'description'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function orderItems()
	{
		return $this->hasMany(OrderItem::class);
	}

	public function productImages()
	{
		return $this->hasMany(ProductImage::class);
	}
    public function defaultImage()
    {
        return $this->hasOne(ProductImage::class)
            ->where('is_default', 1)
            ->with('file');
    }

}
