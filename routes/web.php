<?php

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/{slug}', 'StoreController@index')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function(){

    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');

    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');

});

Route::prefix('checkout')->name('checkout.')->group(function (){
   Route::get('/', 'CheckoutController@index')->name('index');
   Route::post('/process', 'CheckoutController@process')->name('process');
   Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');
});

//Route::get('/model', function () {

//    $user = \App\User::find(4);
//
//    return $user->store; //O objeto único (Store) se for Collection de dados (Objeto)

//    $loja = \App\Store::find(1);

//    return $loja->products->count();
//    return $loja->products;
//    return $loja->products()->where('id', 1)->get();

//    $categoria = \App\Category::find(1);
//    $categoria->products;

    //Criar uma loja para um usuário

//    $user = \App\User::find(10);
//    $store = $user->store()->create([
//       'name' => 'Loja Teste',
//       'description' => 'Loja Teste de produtos de informática',
//       'mobile_phone' => 'xx-xxxxx-xxxx',
//       'phone' => 'xx-xxxxx-xxxx',
//       'slug' => 'loja-teste'
//    ]);

//    dd($store);

    //Criar um produto para uma loja

//    $store = \App\Store::find(41);
//    $product = $store->products()->create([
//        'name' => 'Notebook Dell',
//        'description' => 'CORE I5 8GBs',
//        'body' => 'Notebook muito bom',
//        'price' => 2999.00,
//        'slug' => 'notebook-dell'
//    ]);
//
//    dd($product);

    //Criar uma categoria

//    \App\Category::create([
//        'name' => 'Games',
//        'description' => null,
//        'slug' => 'games'
//    ]);
//
//    \App\Category::create([
//        'name' => 'Notebooks',
//        'description' => null,
//        'slug' => 'notebooks'
//    ]);
//
//    return \App\Category::all();

    //Adicionar um produto para uma categoria e vice-versa

//    $product = \App\Product::find(49);

//    dd($product->categories()->attach([1]));
//    dd($product->categories()->detach([1]));

//        dd($product->categories()->sync([1,2]));
//
//    return $product->categories;
//
//    return \App\User::all();

//});



Route::group(['middleware' => ['auth']], function(){

    Route::get('my-orders', 'UserOrderController@index')->name('user.orders');

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function (){
        Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
        Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
        Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');
//    Route::prefix('stores')->name('stores.')->group(function(){
//
//        Route::get('/', 'StoreController@index')->name('index');
//        Route::get('create', 'StoreController@create')->name('create');
//        Route::post('store', 'StoreController@store')->name('store');
//        Route::get('{store}/edit', 'StoreController@edit')->name('edit');
//        Route::post('update/{store}', 'StoreController@update')->name('update');
//        Route::get('destroy/{store}', 'StoreController@destroy')->name('destroy');
//
//    });

        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');

        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');

        Route::get('orders/my', 'OrdersController@index')->name('orders.my');

    });
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');//->middleware('auth');

Route::get('not', function (){

//    $stores = [1, 2];
//
//    $stores = App\Store::whereIn('id', $stores)->get();
//
//    return $stores->map(function ($store){
//       return $store->user;
//    });

   $user = \App\User::find(1);
   $user->notify(new App\Notifications\StoreReceiveNewOrder());

   return $user->unreadNotifications->all();
});
