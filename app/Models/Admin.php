<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Enums\AdminStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Auth;

/**
 * Class Admin
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Admin extends Auth
{
    protected $table = 'admins';
    public static $snakeAttributes = false;

    protected $casts = [
        'status' => AdminStatus::class
    ];

    protected $hidden = [
        'password'
    ];

    #[Scope]
    public function ApplyAdminSort(Builder $query): void
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

            case 'email':
                $query->orderBy('email');
                break;

            default:
                $query->orderByDesc('id');
                break;

        }
    }
    #[Scope]
    public function applyAdminSearch(Builder $query): Builder
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
    protected
        $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'status'
    ];
}
