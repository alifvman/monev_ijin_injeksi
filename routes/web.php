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

Route::get('/test', [
    'as' => 'test',
    'uses' => function () { return view('public.reset')->with(['email'=>"fulan@my.pc",'token'=>"T0K3N"]); }]);

Route::get('/', [
    'as' => 'index',
    'uses' => 'Page@index']);

Route::get('/home', [
    'as' => 'home',
    'uses' => 'Member@home']);

Route::get('/prosses/{object}', [
    'as' => 'prosses',
    'uses' => 'Member@prosses']);

Route::get('/dashboard', [
    'as' => 'dashboard',
    'uses' => 'Member@dashboard']);

Route::get('/manage/user', [
    'as' => 'userman',
    'uses' => 'Member@userman']);

Route::post('/manage/user/create', [
    'as' => 'newuser',
    'uses' => 'Member@newuser']);

Route::post('/search', [
    'as' => 'search',
    'uses' => 'Member@search']);

Route::post('/update/role', [
    'as' => 'updaterole',
    'uses' => 'Member@updaterole']);

Route::get('/account/settings', [
    'as' => 'settings',
    'uses' => 'Member@settings']);

Route::get('/autocomplete/{object}', [
    'as' => 'autocomplete',
    'uses' => 'Member@autocomplete']);

Route::post('/data/{object}', [
    'as' => 'data',
    'uses' => 'Member@data']);

Route::get('/download/appdoc/{appid}:{docid}', [
    'as' => 'download',
    'uses' => 'Member@downloadapdoc']);

Route::post('/application/submission', [
    'as' => 'submission',
    'uses' => 'Member@submission']);

Route::post('/application/detail', [
    'as' => 'appdetail',
    'uses' => 'Member@appdetail']);

Route::post('/application/update', [
    'as' => 'appupdate',
    'uses' => 'Member@appupdate']);

Route::post('/application/cancel', [
    'as' => 'appcancel',
    'uses' => 'Member@appcancel']);

Route::post('/account/profile', [
    'as' => 'profile',
    'uses' => 'Member@profile']);

Route::post('/account/password', [
    'as' => 'password',
    'uses' => 'Member@password']);


Route::post('/account/login', [
    'as' => 'login',
    'uses' => 'Account@login']);

Route::post('/account/forgot', [
    'as' => 'forgot',
    'uses' => 'Account@forgot']);

Route::post('/account/setpass', [
    'as' => 'setpass',
    'uses' => 'Account@setpass']);

Route::post('/account/register', [
    'as' => 'register',
    'uses' => 'Account@register']);

Route::get('/account/verify/{token}', [
    'as' => 'verify',
    'uses' => 'Account@verify']);

Route::get('/account/reset/{token}', [
    'as' => 'reset',
    'uses' => 'Account@reset']);

Route::get('/account/logout', [
    'as' => 'logout',
    'uses' => 'Account@logout']);
