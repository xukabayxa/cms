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
Breadcrumbs::for('posts', function ($trail) {
    $trail->push('Posts', route('posts.index'));
});

Breadcrumbs::for('posts.create', function ($trail) {
    $trail->parent('posts');
    $trail->push(trans('core::core.crud.create'), route('posts.create'));
});

Breadcrumbs::for('posts.edit', function ($trail, $entity) {
    $trail->parent('posts');
    $trail->push($entity->id, route('posts.edit', $entity->id));
});

// ==========================Routes=========================================
Route::group(['middleware' => ['web'], 'prefix' => 'admin'], function()
{
    Route::resource('posts', 'PostsController');
});
