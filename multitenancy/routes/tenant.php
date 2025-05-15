<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant. The id of the current tenant is ' . tenant('id');
//         $user = User::get();
// dd($user);
    });

    Route::get('/login',[AuthController::class,'login'])->name('tenant.login');
    Route::post('/login',[AuthController::class,'loginStore'])->name('tenant.login.store');

    Route::get('/register',[AuthController::class,'register'])->name('tenant.login.register');
    Route::post('/register',[AuthController::class,'registerStore'])->name('tenant.register.store');

    Route::post('/logout',[AuthController::class,'logout'])->name('tenant.logout');

    Route::get('/dashboard',function(){
        return view('tenant.dashboard');
        // dd(auth()->user()->toArray());
        // dd('This is your tenant dashboard');
    })->name('tenant.dashboard');
    

});
