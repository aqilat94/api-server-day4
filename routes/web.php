<?php

use App\Models\Purchase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/return-url', function (Request $request){
    // dd($request->all());
    $purchase = Purchase::where('toyyibpay_bill_code', $request->billcode)->first();
    if($purchase)
    {
        if ($purchase->id == $request->order_id)
        {
            $purchase->update(['payment_status' => 1]);

            return 'Thank you for your purchase';
        }
        return 'response is not valid';
    }
    else
    {
        return 'please check your';
    }
});

Route::post('/callback-url', function (Request $request){
    dd($request->all());
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/purchase/phone',[App\Http\Controllers\PurchaseController::class, 'index']);
Route::get('/buy/laptop/{phone}',[App\Http\Controllers\PurchaseController::class, 'store'])->name('store');
Route::get('/make/purchase', [App\Http\Controllers\PurchaseController::class, 'show'])->name('show');
Route::get('/show/bill/{purchase}', [App\Http\Controllers\PurchaseController::class, 'showBill'])->name('showBill');
