<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
class User extends Model
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

	public function file()
	{
		return $this->belongsTo(File::class, 'avatar_file_id');
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
}
