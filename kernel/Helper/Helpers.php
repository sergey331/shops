<?php

use Kernel\Auth\Auth;
use Kernel\Cart\Cart;
use Kernel\Container\Container;
use Kernel\Cookie\Cookie;
use Kernel\Redirect\Redirect;
use Kernel\Request\Request;
use Kernel\Session\Session;
use Shop\service\SettingService;
use Shop\service\Wishlist;

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

/**
 * @throws Exception
 */
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

/**
 * @throws Exception
 */
function model($name)
{
    return container()->get('db')->model($name);
}

/**
 * @throws Exception
 */
function view()
{
    return container()->get('views');
}

function public_path($path): string
{
    return env('APP_URL') . '/' . $path;
}

/**
 * @throws Exception
 */
function config($key, $default = null)
{
    return container()->get('config')->get($key, $default);
}

/**
 * @throws Exception
 */
function cart(): Cart
{
    return container()->get('cart');
}

function setting()
{
    return (new SettingService())->getSetting();
}

function getBookPrice($book,$count = 1): string
{
    if ($book->discount) {
        if ($book->discount->type === "percentage") {
            $finalPrice = $book->price - ($book->price * $book->discount->price / 100);
        } else if ($book->discount->type === "fixed") {
            $finalPrice = $book->price - $book->discount->price;
        }


        $finalPrice = $finalPrice < 0 ? 0 : $finalPrice * $count;
        $html = '<div class="price  font-bold text-lg"><span class="line-through">' . formatNumber($book->price) . ' ' . setting()->currency->symbol . '</span> ' . formatNumber($finalPrice) . ' ' . $book->currency->symbol . '</div>';
    } else {
        $html = '<div class="price  font-bold text-lg">' . formatNumber($book->price * $count) . ' ' . setting()->currency->symbol . '</div>';
    }

    return $html;
}

function showDiscount($discount, $symbol, $key = 'price'): string
{
    $text = '';

    if ($discount->type === "percentage") {
        $text = formatNumber($discount->{$key}) . "% off";
    } else if ($discount->type === "fixed") {
        $text = $symbol . "" . formatNumber($discount->{$key}) . " off";
    }
    return $text;
}

function formatNumber($number): string
{
    return ($number == intval($number))
        ? number_format($number, 0)
        : number_format($number, 2);
}

function checkInWishlist($bookId): bool
{
    $wishlist = (new Wishlist())->getByBookId($bookId);
    return !empty($wishlist);
}

function timeAgo(string $datetime): string
{
    try {

        // Convert DB time to proper timezone
        $datetimeDb  = new DateTime($datetime, new DateTimeZone('UTC'));
        $datetimeNow = new DateTime('now', new DateTimeZone('UTC'));

        $interval = $datetimeNow->diff($datetimeDb);


        if ($interval->m > 0) {
            return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
        }

        if ($interval->days > 0) {
            return $interval->days . ' day' . ($interval->days > 1 ? 's' : '') . ' ago';
        }

        if ($interval->h > 0) {
            return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
        }

        if ($interval->i > 0) {
            return $interval->i . ' min ago';
        }

        return 'Just now';
    } catch (Exception $e) {
        return '';
    }
}
