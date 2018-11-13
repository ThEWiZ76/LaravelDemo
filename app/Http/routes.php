<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/admin', function (){
    //
    return view('admin.index');
});

Route::resource('admin/users', 'AdminUsersController');


// add user login 2fa for more security

Route::get('/2fa', 'PasswordSecurityController@show2faForm');

Route::post('/generate2faSecret', [
    'uses' => 'PasswordSecurityController@generate2faSecretCode',
    'as' => 'generate2faSecretCode'
]);

Route::post('/enable2fa', [
    'uses' => 'PasswordSecurityController@enable2fa',
    'as' => 'enable2fa'
]);

Route::post('/disable2fa', [
    'uses' => 'PasswordSecurityController@gdisable2fa',
    'as' => 'disable2fa'
]);

Route::post('/2faVerify', function (){
    //
    return redirect(URL()->previous());
})->name('2faVerify')->middleware('2fa');