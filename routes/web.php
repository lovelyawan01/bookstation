<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
        // Route::get('test2/', function() {
        //     // $role = Role::create(['name' => 'customer']);
        //     // $permission = Permission::create(['name' => 'view customer']);
        //     // // $role->givePermissionTo($permission);
        //     // $user = \Auth::user();
        //     // $user->assignRole('customer');  

        // });

        // Route::group(['middleware' => ['role:user|customer']], function() {
            // Route::get('test2', function() {
            //     return 'working';
            // })->permission('view products');
        // });

        Route::get('author/statusActive', 'AuthorController@statusActive')->name('author.statusActive');
        Route::get('author/statusDeactive', 'AuthorController@statusDeactive')->name('author.statusDeactive');
        Route::get('author/deleteAll', 'AuthorController@deleteAll')->name('author.deleteAll');
        Route::put('author/{id}/status', 'AuthorController@status');
        Route::resource('author', 'AuthorController');  



        Route::get('user/statusActive', 'UserController@statusActive')->name('user.statusActive');
        Route::get('user/statusDeactive', 'UserController@statusDeactive')->name('user.statusDeactive');
        Route::get('user/deleteAll', 'UserController@deleteAll')->name('user.deleteAll');
        Route::put('user/{id}/status', 'UserController@status');


        // Route::resource('user', 'UserController');
        Route::get('user/index', 'UserController@index')->name('user.index')->middleware('permission:user-list');
        Route::get('user/create', 'UserController@create')->name('user.create')->middleware('permission:user-create');
        Route::get('user/store', 'UserController@store')->name('user.store')->middleware('permission:user-create');
        Route::get('user/show', 'UserController@show')->name('user.show')->middleware('permission:user-list');
        Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit')->middleware('permission:user-edit');
        Route::get('user/{user}/update', 'UserController@update')->name('user.update')->middleware('permission:user-edit');
        Route::get('user/{user}/destroy', 'UserController@destroy')->name('user.destroy')->middleware('permission:user-delete');


        // Roles Routes
         Route::get('roles/index', 'RoleController@index')->name('role.index')->middleware('permission:role-list');
        Route::get('roles/create', 'RoleController@create')->name('role.create')->middleware('permission:role-create');
        Route::get('roles/store', 'RoleController@store')->name('role.store')->middleware('permission:role-create');
        Route::get('roles/show', 'RoleController@show')->name('role.show')->middleware('permission:role-list');
        Route::get('roles/{roles}/edit', 'RoleController@edit')->name('role.edit')->middleware('permission:role-edit');
        Route::get('roles/{roles}/update', 'RoleController@update')->name('role.update')->middleware('permission:role-edit');
        Route::get('roles/{roles}/destroy', 'RoleController@destroy')->name('role.destroy')->middleware('permission:role-delete');


        // BOOK ROUTES:
        Route::get('book/statusActive', 'BookController@statusActive')->name('book.statusActive');
        Route::get('book/statusDeactive', 'BookController@statusDeactive')->name('book.statusDeactive');
        Route::get('book/deleteAll', 'BookController@deleteAll')->name('book.deleteAll');
        Route::put('book/{book}/status', 'BookController@status');
        Route::resource('book', 'BookController');
            
        // CATEGORY ROUTES:
        Route::get('category/statusActive', 'CategoryController@statusActive')->name('category.statusActive');
        Route::get('category/statusDeactive', 'CategoryController@statusDeactive')->name('category.statusDeactive');
        Route::get('category/deleteAll', 'CategoryController@deleteAll')->name('category.deleteAll');
        Route::put('category/{category}/status', 'CategoryController@status');
        Route::resource('category', 'CategoryController');
        
        // MEDIA ROUTES:
        Route::get('media/statusActive', 'MediaController@statusActive')->name('media.statusActive');
        Route::get('media/statusDeactive', 'MediaController@statusDeactive')->name('media.statusDeactive');
        Route::get('media/deleteAll', 'MediaController@deleteAll')->name('media.deleteAll');
        Route::put('media/{media}/status', 'MediaController@status');
        Route::resource('media', 'MediaController');
        
        // TEAM ROUTES:
        Route::get('team/statusActive', 'TeamController@statusActive')->name('team.statusActive');
        Route::get('team/statusDeactive', 'TeamController@statusDeactive')->name('team.statusDeactive');
        Route::get('team/deleteAll', 'TeamController@deleteAll')->name('team.deleteAll');
        Route::put('team/{team}/status', 'TeamController@status');
        Route::resource('team', 'TeamController');

        Route::post('/updatepassword', 'HomeController@updatepassword')->name('update.password');
        Route::get('/profile', 'HomeController@profile');
        Route::post('/profile/update', 'HomeController@profile_update')->name('profile.update');
        
});
    


    /**** FRONTEND DEVELOPMENT ****/
Route::get('/contact', 'MainController@contact' );
Route::get('/author', 'MainController@author' );
Route::get('/blog', 'MainController@blog' );
Route::get('/gallery', 'MainController@gallery' );
Route::get('/about', 'MainController@about' );
Route::get('/', 'MainController@index' );
Route::get('/author_detail/{slug}', 'MainController@author_detail' );


Route::get('/book/{slug}', 'BookController@show')->name('book.show');
Route::get('/category/{slug}', 'CategoryController@show')->name('category.show');


Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function() {
    return redirect('/admin/author');
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('books', BookController::class);
});


