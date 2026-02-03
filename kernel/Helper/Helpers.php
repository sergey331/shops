<?php

use Kernel\Auth\Auth;
use Kernel\Container\Container;
use Kernel\Cookie\Cookie;
use Kernel\Redirect\Redirect;
use Kernel\Request\Request;
use Kernel\Session\Session;
use Shop\service\SettingService;

function container(): Container
{
    return Container::$application;
}

/**
 * @return Request
 * @throws Exception
 */
function request(): Request
{
    return container()->get('request');
}

/**
 * @return Session
 * @throws Exception
 */
function session(): Session
{
    return container()->get('session');
}

function cookie(): Cookie
{
    return container()->get('cookie');
}

/**
 * @return Auth
 * @throws Exception
 */
function auth(): Auth
{
    return container()->get('auth');
}

function model($name)
{
    return container()->get('db')->model($name);
}
function view()
{
    return container()->get('views');
}

function public_path($path): string
{
    return env('APP_URL') . '/' . $path;
}

function config($key, $default = null)
{
    return container()->get('config')->get($key, $default);
}

function setting()
{
    return (new SettingService())->getSetting();
}

function getBookPrice($book): mixed
{
    if ($book->discount) {
        if ($book->discount->type === "percentage") {
            $finalPrice = $book->price - ($book->price * $book->discount->price / 100);
        } else if ($book->discount->type === "fixed") {
            $finalPrice = $book->price - $book->discount->price;
        }

        $finalPrice = $finalPrice < 0 ? 0 : $finalPrice;
        $html = '<div class="price  font-bold text-lg"><span class="line-through">' . formatNumber($book->price) . ' ' . setting()->currency->symbol . '</span> ' . formatNumber($finalPrice) . ' ' . $book->currency->symbol . '</div>';
    } else {
        $html = '<div class="price  font-bold text-lg">' . formatNumber($book->price) . ' ' . setting()->currency->symbol . '</div>';
    }

    return $html;
}

function showDiscount($discount, $symbol, $key = 'price')
{
    $text = '';

    if ($discount->type === "percentage") {
        $text = formatNumber($discount->{$key}) . "% off";
    } else if ($discount->type === "fixed") {
        $text = $symbol . "" . formatNumber($discount->{$key}) . " off";
    }
    return $text;
}

function formatNumber($number) {
    return ($number == intval($number))
        ? number_format($number, 0)
        : number_format($number, 2);
}
