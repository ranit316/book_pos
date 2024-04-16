<?php

use App\Http\Controllers\Admin\v1\Bank\BankController;
use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('website/book/list',[WebsiteController::class,'booklist']);
Route::get('website/publisher/list',[WebsiteController::class, 'publisherlist']);
Route::get('website/category/list',[WebsiteController::class, 'categorylist']);
Route::get('website/store/list',[WebsiteController::class, 'storelist']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/payment-bank-api/{sale_id}',[BankController::class,'payment_bank_api'])->name('payment.bank.api');
