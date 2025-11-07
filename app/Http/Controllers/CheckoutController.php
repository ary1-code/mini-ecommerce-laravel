<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductQtyException;
use App\Http\Requests\CheckoutPostRequest;
use App\Services\UserCartManager;
use App\Services\UserOrderManager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class CheckoutController extends Controller
{
    public function index()
    {

        $title = 'تسویه حساب';

        $userCartProduct = UserCartManager::getItemsDetail();
        $cartPrices = UserCartManager::getCartPrices();


        return view('checkout', compact('title', 'userCartProduct', 'cartPrices'));

    }


    /**
     * @throws Throwable
     */
    public function post(CheckoutPostRequest $request)
    {
        $userOrderManager = new UserOrderManager(Auth::user(), $request->validated());

        try {
            $userOrderManager->checkStock();
            DB::beginTransaction();
            $userOrderManager->register();
            DB::commit();
        } catch (ProductQtyException $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());

            return back()->withErrors([
                'general' => $exception->getMessage()
            ]);
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            return back()->withErrors([
                'general' => 'خطایی در ثبت سفارش لطفا با پشتیبانی ارتباط بگیرید'

            ]);
        }

        return redirect()->route('account.profile.index');

    }

}
