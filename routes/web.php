<?php


Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.shops.index')->with('status', session('status'));
    }

    return redirect()->route('admin.shops.index');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('location/{shop}', 'HomeController@show')->name('location');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/blog/{post}', 'HomeController@Post')->name('posts.show');
Route::get('/roads','HomeController@getRoad')->name('getRoad');
Route::post('register/media', 'Auth\RegisterController@storeMedia')->name('users.storeMedia');
//Auth::routes(['verify' => true]); for email verification
//Route::get('profile', function () {
//    // Only verified users may enter...
//})->middleware('verified');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('profile/me', 'ProfileController@profile')->name('profile.me');
    Route::post('profile/upload','ProfileController@updatePicture')->name('profile.upload');
    Route::post('profile/update','ProfileController@updateProfile')->name('profile.update');
    Route::post('profile/change/password','ProfileController@changePassword')->name('profile.change.password');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::resource('users', 'UsersController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Road
    Route::delete('roads/destroy', 'RoadsController@massDestroy')->name('roads.massDestroy');
    Route::resource('roads', 'RoadsController');
    Route::resource('roads', RoadsController::class)->names([
        'create' => 'roads.build',
        'update' => 'roads.update',
    ]);
    // Posts
    Route::delete('posts/destroy', 'PostController@massDestroy')->name('posts.massDestroy');
    Route::post('posts/media', 'PostController@storeMedia')->name('posts.storeMedia');
    Route::resource('posts', 'PostController');
    // Size
    Route::delete('sizes/destroy', 'SizeController@massDestroy')->name('sizes.massDestroy');
    Route::resource('sizes', 'SizeController');

    // Shops
    Route::delete('shops/destroy', 'ShopsController@massDestroy')->name('shops.massDestroy');
    Route::post('shops/media', 'ShopsController@storeMedia')->name('shops.storeMedia');
    Route::get('shops/roads','ShopsController@getRoad')->name('getRoad');
    Route::resource('shops', 'ShopsController');

    // Slider
    Route::delete('sliders/destroy', 'SliderController@massDestroy')->name('sliders.massDestroy');
    Route::post('sliders/media', 'SliderController@storeMedia')->name('sliders.storeMedia');
    Route::resource('sliders', 'SliderController');

    // Size
    Route::delete('videos/destroy', 'VideoController@massDestroy')->name('videos.massDestroy');
    Route::resource('videos', 'VideoController');

    // Banner
    Route::delete('banners/destroy', 'BannerController@massDestroy')->name('banners.massDestroy');
    Route::post('banners/media', 'BannerController@storeMedia')->name('banners.storeMedia');
    Route::resource('banners', 'BannerController');
});
