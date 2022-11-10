<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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


// //logins forms
// Route::get('/admin/login',[App\Http\Controllers\Auth\AdminLoginConTroller::class,'showLoginForm'])->name('admin.login');
//Route::get('/stock/login',[App\Http\Controllers\Auth\StockLoginController::class,'showLoginForm'])->name('stock.login');
//Route::get('/pharma/login',[App\Http\Controllers\Auth\PharmaLoginController::class,'showLoginForm'])->name('pharma.login');
// Route::get('/poulailler/login',[App\Http\Controllers\Auth\PoulaillerLoginController::class,'showLoginForm'])->name('poulailler.login');


// //submit forms
// Route::post('/admin/login',[App\Http\Controllers\Auth\AdminLoginConTroller::class,'Login'])->name('admin.login.submit');





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('home');


//admin
Route::prefix('admin')->group(function(){

        Route::get('/login',[App\Http\Controllers\Auth\AdminLoginConTroller::class,'showLoginForm'])->name('admin.login');
        Route::post('/login',[App\Http\Controllers\Auth\AdminLoginConTroller::class,'Login'])->name('admin.login.submit');
        Route::get('/',[App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/newAccount',[App\Http\Controllers\AdminController::class, 'insertAccountview'])->name('admin.newAccount');
        Route::post('/newaccount',[App\Http\Controllers\AdminController::class, 'insertNewAccount'])->name('admin.insertNewAccount');
});

//stock
Route::prefix('/stock')->group(function(){ 

        Route::get('/login',[App\Http\Controllers\Auth\StockLoginController::class,'showLoginForm'])->name('stock.login');
        Route::post('/login',[App\Http\Controllers\Auth\StockLoginConTroller::class,'Login'])->name('stock.login.submit');
        Route::get('/',[App\Http\Controllers\StockConTroller::class, 'index'])->name('stock.dashboard');
        Route::get('/addproduct',[App\Http\Controllers\StockController::class,'addNewProduct'])->name('stock.addNewproduct');
        Route::post('/insertproduct',[App\Http\Controllers\StockController::class,'insertProduct'])->name('stock.newproduct');
        Route::get('/retreiveProductview',[App\Http\Controllers\StockController::class,'getretreiveview'])->name('stock.retreiveProductView');
       
        //jquery fetch data from the DB
        Route::get('/dataloading/{stockId}',[App\Http\Controllers\StockController::class,'DataLiveSearch'])->name('stock.productsearch');
        
        Route::post('/TransfertProductCollected', [App\Http\Controllers\StockController::class,'TransferredProduct'])->name('stock.transfertProduct');
        Route::get('/addedProduct',[App\Http\Controllers\StockController::class,'AddedData'])->name('stock.AddedData');
        Route::get('/retrievedProduct',[App\Http\Controllers\StockController::class,'RetreivedData'])->name('stock.RetreivedData');
        Route::get('/historic/{id}',[App\Http\Controllers\StockController::class,'historicAdded'])->name('stock.historic');

});

//pharma
Route::prefix('/pharma')->group(function(){

        Route::get('/login',[App\Http\Controllers\Auth\PharmaLoginController::class,'showLoginForm'])->name('pharma.login');
        Route::post('/login',[App\Http\Controllers\Auth\PharmaLoginController::class,'Login'])->name('pharma.login.submit');
        Route::get('/',[App\Http\Controllers\PharmaController::class, 'index'])->name('pharma.dashboard');
        

});

//poulailler
Route::prefix('/poulailler')->group(function(){

        Route::get('/login',[App\Http\Controllers\Auth\PoulaillerLoginController::class,'showLoginForm'])->name('poulailler.login');
        Route::post('/login',[App\Http\Controllers\Auth\PoulaillerLoginController::class,'Login'])->name('poulailler.login.submit');
        Route::get('/',[App\Http\Controllers\PoulaillerController::class, 'index'])->name('poulailler.dashboard');
        Route::get('/newStock',[App\Http\Controllers\PoulaillerController::class, 'newstock'])->name('poulailler.newstock');
        Route::post('/newStock',[App\Http\Controllers\PoulaillerController::class, 'AddStockPoulailler'])->name('addpoulailler');
        Route::get('/poulaillerSpecificStock/{id}',[App\Http\Controllers\PoulaillerController::class,'poulaillerSpecificStock'])->name('getstockview');
        Route::get('/vente/{id}',[App\Http\controllers\PoulaillerController::class,'venteView'])->name('venteView');
        Route::post('/vente',[App\Http\Controllers\PoulaillerController::class,'vente'])->name('ventePost');
        Route::get('/retreive/{id}',[App\Http\Controllers\PoulaillerController::class,'retreive'])->name('retreive');
        Route::post('/retreive',[App\Http\Controllers\PoulaillerController::class,'retreivepostData'])->name('poulailler.retreive');
        Route::get('/vente/{id}',[App\Http\Controllers\PoulaillerController::class,'getVenteForm'])->name('poulailler.vente');
        Route::get('/retreivehistory/{id}',[App\Http\Controllers\PoulaillerController::class,'historyView'])->name('poulailler.retreivehistory');
        Route::get('/charge/{id}',[App\Http\Controllers\PoulaillerController::class,'getChargeview'])->name('poulailler.charge');
        Route::post('/charge/{id}',[App\Http\Controllers\PoulaillerController::class,'insertcharges'])->name('poulailler.insertcharges');
        Route::get('/chargehistoric/{id}',[App\Http\Controllers\PoulaillerController::class,'getchargesList'])->name('poulailler.Chargehistoric');
});