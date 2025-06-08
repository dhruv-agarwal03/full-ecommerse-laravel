<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DairyController;

Route::get('/', [CustomerController::class, 'index']);
Route::get('/logout', [CustomerController::class, 'logout']);
Route::post('/', [CustomerController::class, 'indexCheck']);
Route::get('/home', [ProductsController::class, 'home']);
Route::get('/category', [CategoryController::class, 'categery']);

Route::get('/products/{cid}', [ProductsController::class, 'products']);
Route::get('/products', [ProductsController::class, 'productsall']); 

Route::get('/product/{id}', [ProductsController::class, 'product']);


Route::get('/register', [CustomerController::class, 'register']);
Route::post('/register', [CustomerController::class, 'registerit']);

Route::get('/cart', [ProductsController::class, 'cart']);
Route::post('/cart', [BillsController::class, 'billgenerate']);

//  Route::get('/bill', [CustomerController::class, 'registerit']);
Route::get('/bill/{id}', [BillsController::class, 'billDetails'])->name('bill.details');


Route::get('/history',[BillsController::class,'allbills']);

Route::prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'admin']);
    
    Route::get('/home', [AdminController::class, 'home']);
    Route::post('/home/{id}', [AdminController::class, 'homeupdate']);

    Route::get('/new', [AdminController::class, 'new']);
    Route::post('/new', [AdminController::class, 'newadd']);
    
    Route::get('/bills/{id}', [AdminController::class, 'billinfo'])->name('bill.info');
    Route::post('/bill/{id}', [AdminController::class, 'billdilevery'])->name('update.delivery');
    Route::post('/billss/{id}', [AdminController::class, 'billplaced'])->name('update.placed');
    
    Route::get('/diary',[AdminController::class,'dairy']);
    Route::get('/diaryget/{id}',[AdminController::class,'dairyget'])->name('customer.get');
    Route::post('/diaryget/{id}',[DairyController::class,'update_dairy'])->name('customer.get');

    Route::get('/products',[AdminController::class,'products']);
    Route::post('/products',[AdminController::class,'productsupdate']);
});