<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Application;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::with('category' ,'brand', 'productImages')->orderBy('id' , 'desc')->limit(5)->get();
        return Inertia::render('User/Index', [
            'canLogin' => app('router')->has('login'),
            'canRegister' => app('router')->has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'products' => $products,
        ]);
    }
}


//'canLogin' => Route::has('login'),
//'canRegister' => Route::has('register'),
//'laravelVersion' => Application::VERSION,
//'phpVersion' => PHP_VERSION,
