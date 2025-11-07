<?php

use App\Models\Product;
use App\Models\User;
use App\Services\UserCartManager;

if (!function_exists('getUserFullName')) {
    function getUserFullName(): string
    {

        $user = auth()->user();

        return "$user->first_name $user->last_name";

    }

}


if (!function_exists('getUserName')) {
    function getUserName(User|null $user = null): string
    {
        if (!$user) {
            $user = auth()->user();

        }
        return " $user->first_name $user->last_name";
    }

}

if (!function_exists('getAdminFullName')) {
    function getAdminFullName(): string
    {

        $user = auth()->guard('admin')->user();

        return "$user->first_name $user->last_name";

    }

}

if (!function_exists('activeSideMenuItem')) {
    function activeSideMenuItem(string $targetRoute): string
    {

        $activeClass = 'bg-blue-500/10 text-blue-500';
        $defaultClass = 'hover:text-blue-500';
        $currentRouteName = \Illuminate\Support\Facades\Route::currentRouteNamed();

        if ($currentRouteName == $targetRoute) {

            return $activeClass;

        }

        return $defaultClass;

    }


    if (!function_exists('activeAdminSidebarItem')) {
        function activeAdminSidebarItem(string|array $targetRoute, string $activeClass = 'active'): string
        {
            $currentRouteName = \Illuminate\Support\Facades\Route::currentRouteName();

            if (is_string($targetRoute)) {
                $targetRoute = [$targetRoute];
            }
            if (in_array($currentRouteName, $targetRoute)) {
                return $activeClass;

            }
            return '';
        }
    }


    if (!function_exists('getFullProductName')) {
        function getFullProductName(Product $product): string
        {

            return $product->name . ' | ' . $product->name_en;

        }
    }

    if (!function_exists('getDiscountPercent')) {
        function getDiscountPercent(Product $product): int
        {
            return (int)(($product->disscount * 100) / $product->price);

        }
    }

    if (!function_exists('generateSortColorClass')) {
        function generateSortColorClass(string $current): string
        {
            if (!request()->filled('sort') && $current == 'newest') {

                return 'text-blue-500';
            }

            $sortFromQs = request()->input('sort');

            if ($sortFromQs == $current) {

                return 'text-blue-500';
            }

            return "text-gray-400";

        }

        if (!function_exists('getUserProductCount')) {
            function getUserProductCount(): int
            {
                return UserCartManager::getProductCount();

            }
        }

        if (!function_exists('enumToValue')) {
            function enumToValue(string $enumClass): mixed
            {

                $values = [];

                foreach ($enumClass::cases() as $case) {
                    $values[] = $case->value;
                }
                return $values;
            }
        }
    }
    function getProductDefaultImageUrl(Product $product): ?string
    {

        $defaultImage = $product->defaultImage()->with('file')->first();

        if ($defaultImage && $defaultImage->file) {
            return asset('storage/' . $defaultImage->file->path);
        }

        return null;
    }
}


