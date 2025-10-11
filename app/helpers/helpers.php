<?php
if (!function_exists('getUserFullName')) {
    function getUserFullName(): string
    {

        $user = auth()->user();

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

}
