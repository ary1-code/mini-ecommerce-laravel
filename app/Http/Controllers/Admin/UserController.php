<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {

        $title = 'لیست کاربران';
        $users = User::query()
            ->applyUserSort()
            ->applyUserSearch()
            ->orderByDesc('created_at')
            ->paginate(20);
        return view('admin.users.index', compact('title', 'users'));

    }

    public function show(User $user)
    {
        $title = 'جزییات کاربر' . getUserName($user);

        $latestOrders = Order::query()
            ->where('user_id', $user->id)
            ->latest()
            ->limit(3)
            ->get();


        return view('admin.users.show', compact('title', 'user', 'latestOrders'));
    }

    public function edit(User $user)
    {
        $title = 'ویرایش کاربر' . getUserName($user);


        return view('admin.users.edit', compact('title', 'user'));

    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $inputs = $request->validated();
        unset($inputs['password']);

        if ($request->filled('password')) {
            $inputs['password'] = Hash::make($request->input('password'));
        }

        try {
            $user->update($inputs);
        }catch (Exception $exception){
            Log::error($exception);
            return back()->withErrors([
              'general'=>'تغییرات با موفقیت اعمال نشد'
            ]);
        }
        return redirect()->route('admin.users.index');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');

    }


}
