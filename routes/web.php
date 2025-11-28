<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

//Livewire
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\Products;
use App\Livewire\Billing;
use App\Livewire\Users;
use App\Livewire\Settings;
use App\Livewire\Sales;
use App\Livewire\Providers;
use App\Livewire\Workers;

//Controller
use App\Http\Controllers\BillingController;


use Livewire\Livewire;

Route::get('/', Login::class)->name('login');
Route::get('/logout', [Login::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    //Index
    Route::get('/home', Dashboard::class)->name('home');
    //Productos
    Route::get('/products', Products::class)->name('products');
    //Facturar
    Route::get('/billing', Billing::class)->name('billing');
    Route::post('/billing/store', [BillingController::class, 'store'])->name('billing.store');
    //Usuario
    Route::get('/users', Users::class)->name('users');
    //Configuracion
    Route::get('/settings', Settings::class)->name('settings');
    //Ventas
    Route::get('/sales', Sales::class)->name('sales');
    //Proveedores
    Route::get('/providers', Providers::class)->name('providers');
    //Trabajadores
    Route::get('/workers', Workers::class)->name('workers');
});
