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
use App\Product;

Auth::routes();

Route::get('/', 'HomeController@show');

Route::get('productdetails/{id}', 'ProductController@index');

Route::get('/home', 'HomeController@index');

Route::get('/storeregister', function () {
    return view('auth/storeregister');
});

// Route::get('/addwishlist','WishlistController@addwish');
Route::get('sig/edit/{pro}', 'WishlistController@addwish');

//  Route::get('addwishlist/{pro}/{user}',
//         ['as'=> 'test', 'uses'=>'WishlistController@addwish']
// );

Route::get('/wishlisttable/{id}', ['as' => 'userid', 'uses' => 'WishlistController@showwish']);

Route::get('/wishlisttt/{pro}/{user}', ['as' => 'remove', 'uses' => 'WishlistController@removewish'], function () {

    return view('product.wishlist');
});

Route::get('addwishlist/{pro}/{user}',
    ['as' => 'test', 'uses' => 'WishlistController@addwish'], function () {
        return view('store.index');
    });


// Route::get('/wishlisttable','WishlistController@showwish', function () {
//    // $tasks=DB::table('wishlists')->get();
//     return view('product.wishlist');
// });

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', 'AdminController@index');

    Route::resource('stores', 'StoreController');
    Route::resource('dropdowns', 'DropdownController');
    Route::resource('specifications', 'SpecificationController');
    Route::resource('categories', 'CategoryController');
    Route::post('/dropdownValues/update', 'DropdownController@updateDropdownValue');

});

Route::get('autocomplete-ajax/store', array('as' => 'autocomplete.ajax', 'uses' => 'HomeController@autocompleteStore'));
Route::get('autocomplete-ajax/product', array('as' => 'autocomplete.ajax', 'uses' => 'HomeController@autocompleteProduct'));


Route::group(['prefix' => 'store'], function () {

    Route::get('/', 'HomeController@profile');

    Route::get('/blog', function () {
        return view('temp.blog');
    });
    Route::get('/blog-single', function () {
        return view('temp.blog-single');
    });
    Route::get('/cart', function () {
        return view('temp.cart');
    });
    Route::get('/checkout', function () {
        return view('temp.checkout');
    });
    Route::get('/contactus', function () {
        return view('temp.contactus');
    });
    Route::get('/login', function () {
        return view('auth.login');
    });
    Route::get('/shop', function () {
        return view('temp.shop');
    });
    Route::get('/search', 'HomeController@search');
});

Route::resource("products", 'ProductController');

Route::group(['prefix' => 'api'], function () {

    Route::get('subCategory/{id}', 'CategoryController@getSubCategories');
    Route::get('specifications/{id}', 'CategoryController@getSpecificationsByCategoryId');
    Route::get('specification/{id}/type', 'SpecificationController@getSpecTypeAndUnit');
    Route::get('dropdownValues/{id}', 'DropdownController@getDropdownValues');
    Route::post('uploadFile', 'UploadFileController@upload');
    Route::get('deleteCover/{id}', 'StoreController@deleteCover');
    Route::get('specifications/', 'SpecificationController@getSpecifications');
    Route::get('specificationValues/', 'SpecificationController@getSpecificationValues');
    Route::get('comments/{id}', 'ProductController@getComments');
    Route::get('storeComments/{id}', 'ProductController@storeComments');

});

Route::get('/403', function () {
    return view('403.403');
});
