<?php

use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\AddressController;
// use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\CommentController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// User

Route::post('userLogin', [UserController::class, 'userLogin']);
Route::post('userRegister', [UserController::class, 'userRegister']);
Route::get('userDetail/{id}', [UserController::class, 'userDetail']);
Route::put('userUpdateProfile/{user}', [UserController::class, 'userUpdateProfile']);
Route::put('userUpdatePassword/{user}', [UserController::class, 'userUpdatePassword']);
Route::put('userImage/{id}', [UserController::class, 'userImage']);

// Social Login

Route::get('login/facebook', [LoginController::class, 'loginFacebook']);
Route::get('login/facebook/callback', [LoginController::class, 'loginFacebookCallback']);
Route::get('login/google', [LoginController::class, 'loginGoogle']);
Route::get('login/google/callback', [LoginController::class, 'loginGoogleCallback']);
Route::get('login/github', [LoginController::class, 'loginGithub']);
Route::get('login/github/callback', [LoginController::class, 'loginGithubCallback']);

// Product

Route::post('productCreate', [ProductController::class, 'productCreate']);
Route::put('productUpdate/{product}', [ProductController::class, 'productUpdate']);
Route::delete('productDelete', [ProductController::class, 'productDelete']);
Route::get('productList/{id}', [ProductController::class, 'productList']);
Route::post('productSell', [ProductController::class, 'productSell']);
Route::post('productSearch', [ProductController::class, 'productSearch']);
Route::get('productDetail/{id}', [ProductController::class, 'productDetail']);
Route::put('productIn/{id}', [ProductController::class, 'productIn']);
Route::put('productOut/{id}', [ProductController::class, 'productOut']);

// Offer

Route::post('offerPrice', [OfferController::class, 'offerPrice']);
Route::get('offerWaiting/{id}', [OfferController::class, 'offerWaiting']);
Route::get('offerAccepted/{id}', [OfferController::class, 'offerAccepted']);
Route::get('offerHistory/{id}', [OfferController::class, 'offerHistory']);
Route::put('offerCanceled/{id}', [OfferController::class, 'offerCanceled']);

Route::get('offerWaitingManage/{id}', [OfferController::class, 'offerWaitingManage']);
Route::get('offerHistoryManage/{id}', [OfferController::class, 'offerHistoryManage']);
Route::put('offerAccept/{id}', [OfferController::class, 'offerAccept']);
Route::put('offerReject/{id}', [OfferController::class, 'offerReject']);

Route::get('offerDetail/{id}', [OfferController::class, 'offerDetail']);

// Address

Route::post('addressCreate', [AddressController::class, 'addressCreate']);
Route::put('addressUpdate/{id}', [AddressController::class, 'addressUpdate']);
Route::delete('addressDelete/{id}', [AddressController::class, 'addressDelete']);
Route::get('addressList/{id}', [AddressController::class, 'addressList']);
Route::put('addressNonActived/{id}', [AddressController::class, 'addressNonActived']);
Route::put('addressActived/{id}', [AddressController::class, 'addressActived']);
Route::get('addressChecked/{id}', [AddressController::class, 'addressChecked']);

// Delivery

// Route::post('deliveryOffer', [DeliveryController::class, 'deliveryOffer']);

// Account

Route::post('accountCreate', [AccountController::class, 'accountCreate']);
Route::put('accountUpdate/{id}', [AccountController::class, 'accountUpdate']);
Route::delete('accountDelete', [AccountController::class, 'accountDelete']);
Route::get('accountList/{id}', [AccountController::class, 'accountList']);
Route::get('accountDetail/{id}', [AccountController::class, 'accountDetail']);
Route::delete('accountDelete/{id}', [AccountController::class, 'accountDelete']);

// Bank

Route::get('bankList', [BankController::class, 'bankList']);

// Transaction

Route::post('transactionOrder', [TransactionController::class, 'transactionOrder']);
Route::get('transactionPaid/{id}', [TransactionController::class, 'transactionPaid']);
Route::get('transactionPacked/{id}', [TransactionController::class, 'transactionPacked']);
Route::get('transactionSent/{id}', [TransactionController::class, 'transactionSent']);
Route::get('transactionHistory/{id}', [TransactionController::class, 'transactionHistory']);
Route::put('transactionProof/{id}', [TransactionController::class, 'transactionProof']);
Route::put('transactionAccepted/{id}', [TransactionController::class, 'transactionAccepted']);

// Transaction Manage

Route::get('transactionPackedManage/{id}', [TransactionController::class, 'transactionPackedManage']);
Route::get('transactionSentManage/{id}', [TransactionController::class, 'transactionSentManage']);
Route::get('transactionHistoryManage/{id}', [TransactionController::class, 'transactionHistoryManage']);
Route::put('transactionSend/{id}', [TransactionController::class, 'transactionSend']);

// Transaction All

Route::get('transactionDetail/{id}', [TransactionController::class, 'transactionDetail']);

// Comment

Route::post('commentCreate', [CommentController::class, 'commentCreate']);
Route::get('commentList/{id}', [CommentController::class, 'commentList']);
Route::get('commentCheck/{id}', [CommentController::class, 'commentCheck']);

// Bargain Seller

// Route::post('bargainManageWaiting', [BargainController::class, 'bargainManageWaiting']);
// Route::post('bargainManageHistory', [BargainController::class, 'bargainManageHistory']);

// Route::post('myBargain', [BargainController::class, 'myBargain']);
// Route::get('offerwaiting/{id}', [BargainController::class, 'offerwaiting']);
// Route::get('bargainReject/{id}', [BargainController::class, 'bargainReject']);
// Route::get('offeraccept/{id}', [BargainController::class, 'offeraccept']);
// Route::get('offerhistory/{id}', [BargainController::class, 'offerhistory']);

// Route::put('bargainAction/{id}', [BargainController::class, 'bargainAction']);
// Route::get('bargainDetail/{id}', [BargainController::class, 'bargainDetail']);
// Route::get('bargainDetailDelivery/{id}', [BargainController::class, 'bargainDetailDelivery']);

Route::post('add_cart', [TransactionController::class, 'add_cart']);
Route::post('get_cart', [TransactionController::class, 'get_cart']);
Route::post('delete_item_cart', [TransactionController::class, 'delete_item_cart']);
Route::post('delete_cart', [TransactionController::class, 'delete_cart']);
Route::post('checkout', [TransactionController::class, 'bargainTransaction']);
Route::post('get_transaction', [TransactionController::class, 'get_transaction']);
Route::post('get_detail_transaction', [TransactionController::class, 'get_detail_transaction']);

// Route::post('midtrans/callback', [MidtransController::class, 'callback']);

Route::get('tryMidtrans', [TransactionController::class, 'tryMidtrans']);

Route::apiResource('product', ProductController::class, array("as" => "api"));