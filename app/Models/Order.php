<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Enums\OrderStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $total_price
 * @property int $total_products
 * @property string $user_province
 * @property string $user_city
 * @property string $user_address
 * @property string $user_postal_code
 * @property string $user_mobile
 * @property string $description
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 *
 * @property User $user
 * @property Collection|OrderItem[] $orderItems
 *
 * @package App\Models
 */
class Order extends Model
{
	use SoftDeletes;
	protected $table = 'orders';
	public static $snakeAttributes = false;

	protected $casts = [
		'user_id' => 'int',
		'total_price' => 'int',
		'total_products' => 'int',
        'status'=> OrderStatus::class
	];
    #[Scope]
    public function applyOrderSort(Builder $query): void
    {
        $sort = Request::query('sort');

        switch ($sort) {
            case 'created_at_desc':
                $query->orderByDesc('created_at');
                break;

            case 'created_at_asc':
                $query->orderBy('created_at');
                break;

            case 'price_high':
                $query->orderByDesc('total_price');
                break;

            case 'price_low':
                $query->orderBy('total_price');
                break;

            case 'status':
                $query->orderBy('status');
                break;

            default:
                $query->orderByDesc('id');
                break;
        }
    }

    #[Scope]
    public function applyOrderSearch(Builder $query): Builder
    {
        $search = Request::query('search');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_email', 'like', "%{$search}%")
                    ->orWhere('customer_mobile', 'like', "%{$search}%");
            });
        }

        return $query;
    }


    protected $fillable = [
		'user_id',
		'total_price',
		'total_products',
		'user_province',
		'user_city',
		'user_address',
		'user_postal_code',
		'user_mobile',
		'description',
        'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function orderItems()
	{
		return $this->hasMany(OrderItem::class);
	}
}
