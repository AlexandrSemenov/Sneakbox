<?php
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/**
 * Логинг
 */
Route::get('/login', ['uses' => 'LoginController@index', 'as' => 'login.index']);
Route::post('/login', ['uses' => 'LoginController@login', 'as' => 'login']);
Route::post('login/admin', ['uses' => 'LoginController@loginAdmin', 'as' => 'login.admin']);

Route::get('/logout', ['uses' => 'LoginController@logout', 'as' => 'logout']);

/**
 * Регистрация
 */
Route::get('/register', ['uses' => 'LoginController@register', 'as' => 'login.register']);
Route::post('/register', ['uses' => 'LoginController@registerUser', 'as' => 'login.register.user']);


/**
 * Админ панель
 */
Route::get('/admin', ['uses' => 'AdminController@index', 'as' => 'admin.index']);
Route::get('/admin/dashboard', ['uses' => 'AdminController@dashboard', 'as' => 'admin.dashboard', 'middleware' => 'admin']);

/**
 * Профайл пользователя
 */
Route::get('/profile', ['uses' => 'ProfileController@index', 'as' => 'myprofile.index', 'middleware' => 'auth']);
Route::post('/profile/userupdate', ['uses' => 'ProfileController@userUpdate', 'as' => 'profile.update']);
Route::post('/profile/passupdate', ['uses' => 'ProfileController@passUpdate', 'as' => 'pass.update']);



Route::get('/profile/settings', ['uses' => 'ProfileController@profileSettings', 'as' => 'profile.settings', 'middleware' => 'auth']);


/**
 * Объявления
 */
Route::get('/', ['uses' => 'ProductController@index', 'as' => 'product.index']);
Route::get('/product/create', ['uses' => 'ProductController@createProduct', 'as' => 'product.create', 'middleware' => 'auth']);
Route::post('/product/save', ['uses' => 'ProductController@saveProduct', 'as' => 'product.save', 'middleware' => 'auth']);
Route::get('/product/edit/{alias}', ['uses' => 'ProductController@editProduct', 'as' => 'product.edit', 'middleware' => 'auth']);
Route::post('/product/update/{alias}', ['uses' => 'ProductController@updateProduct', 'as' => 'product.update']);

Route::get('/product/{alias}', ['uses' => 'ProductController@productItem', 'as' => 'product.item']);

/**
 * Сообщения
 */

Route::post('/messages/save', ['uses' => 'MessageController@saveMessage', 'as' => 'messages.save', 'middleware' => 'auth']);
Route::get('/profile/messages', ['uses' => 'MessageController@messagesReceived', 'as' => 'messages.received', 'middleware' => 'auth']);
Route::get('/profile/messages/send', ['uses' => 'MessageController@messagesSend', 'as' => 'messages.send', 'middleware' => 'auth']);
Route::get('/messages/show/{id}', ['uses' => 'MessageController@showMessage', 'as' => 'message.show', 'middleware' => ['auth', 'message']]);
Route::post('/message/answer', ['uses' => 'MessageController@answerMessage', 'as' => 'message.answer']);