<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


Route::prefix('admin-dashboard')->name('admin.')->group(function () {
    Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('', 'index')->name('index');
    });
    
});

Route::get('/', [UserController::class, 'home'])->name('index');

Route::get('/product_details/{id}', [UserController::class, 'productDetails'])->name('product_details');


Route::get('/addtocart/{id}', [UserController::class, 'addToCart'])
    ->middleware(['auth', 'verified'])
    ->name('add_to_cart');

Route::get('/cartproducts', [UserController::class, 'cartProducts'])
    ->middleware(['auth', 'verified'])
    ->name('cartproducts');

Route::delete('/cart/remove/{id}', [UserController::class, 'removeFromCart'])
    ->middleware(['auth', 'verified'])
    ->name('cart.remove');

Route::get('/dashboard', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::patch('/cart/update/{id}', [UserController::class, 'updateCart'])
    ->middleware(['auth', 'verified'])
    ->name('cart.update');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/add_category', [AdminController::class, 'addCategory'])->name('admin.addcategory');
    Route::post('/add_category', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');
    Route::get('/view_category', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');
    Route::delete('/delete_category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categorydelete');
    Route::get('/update_category/{id}', [AdminController::class, 'editCategory'])->name('admin.editcategory');
    Route::put('/update_category/{id}', [AdminController::class, 'updateCategory'])->name('admin.updatecategory');

    Route::get('/users', [AdminController::class, 'viewUser'])->name('admin.viewuser');
    Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteuser');
    Route::post('/cart/checkout', [UserController::class, 'checkout'])->name('cart.checkout');

    Route::get('/add_product', [AdminController::class, 'addProduct'])->name('admin.addproduct');
    Route::post('/add_product', [AdminController::class, 'postAddProduct'])->name('admin.postaddproduct');
    Route::get('/viewproduct', [AdminController::class, 'index'])->name('admin.viewproduct');
    Route::get('/update_product/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateproduct');
    Route::put('/update_product/{id}', [AdminController::class, 'postUpdateProduct'])->name('admin.postupdateproduct');
    Route::delete('/delete_product/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteproduct');
    Route::get('/vieworder', [AdminController::class, 'viewOrder'])->name('admin.vieworder');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/vieworder', [AdminController::class, 'viewOrder'])->name('admin.vieworder');
    Route::post('/admin/approve-order/{id}', [AdminController::class, 'approveOrder'])->name('admin.order.approve');
    Route::post('/admin/reject-order/{id}', [AdminController::class, 'rejectOrder'])->name('admin.order.reject');
});




// Temporary testing route

Route::get('/test-order', function () {
    $user = \App\Models\User::first();
    $product = \App\Models\Product::first();

    if (!$user || !$product) return 'No user or product found';

    $order = \App\Models\UserOrder::create([
        'user_id' => $user->id,
        'status' => 'pending',
    ]);

    $order->products()->attach($product->id, ['quantity' => 2]);

    return 'Test order created';
});





require __DIR__ . '/auth.php';
