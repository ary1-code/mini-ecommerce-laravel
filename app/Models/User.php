<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Auth;
use Illuminate\Support\Facades\Request;

/**
 * Class User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $mobile
 * @property int|null $avatar_file_id
 * @property string $password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property File|null $file
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class User extends Auth
{
	protected $table = 'users';
	public static $snakeAttributes = false;

	protected $casts = [
		'avatar_file_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'mobile',
		'avatar_file_id',
		'password'
	];

    #[Scope]
    public function applyUserSort(Builder $query): void
    {
        $sort = Request::query('sort');

        switch ($sort) {
            case 'newest':
                $query->orderByDesc('created_at');
                break;

            case 'name_asc':
                $query->orderBy('first_name')->orderBy('last_name');
                break;

            case 'name_desc':
                $query->orderByDesc('first_name')->orderByDesc('last_name');
                break;

            default:
                $query->orderByDesc('id');
                break;

        }
    }
    #[Scope]
    public function applyUserSearch(Builder $query): Builder
    {
        $search = Request::query('search');

        if (!empty($search)) {
            $query->whereAny(
                ['first_name', 'last_name', 'email'],
                'like',
                "%{$search}%"
            );
        }

        return $query;
    }


	public function file()
	{
		return $this->belongsTo(File::class, 'avatar_file_id');
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
}
