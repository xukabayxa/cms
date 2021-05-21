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

// ==========================Breadcrumbs=========================================
Breadcrumbs::for('users', function ($trail) {
    $trail->push('Users', route('users.index'));
});

Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users');
    $trail->push(trans('core::core.crud.create'), route('users.create'));
});

Breadcrumbs::for('users.edit', function ($trail, $entity) {
    $trail->parent('users');
    $trail->push($entity->id, route('users.edit', $entity->id));
});

// ==========================Routes=========================================
Route::group(['middleware' => ['web', 'check.permission'], 'prefix' => 'admin'], function()
{
    Route::resource('users', 'UsersController');
});
