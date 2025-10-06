<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property int|null $image_file_id
 * @property bool $is_active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property File|null $file
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'categories';
	public static $snakeAttributes = false;

	protected $casts = [
		'image_file_id' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'image_file_id',
		'is_active'
	];

	public function file()
	{
		return $this->belongsTo(File::class, 'image_file_id');
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
