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
Breadcrumbs::for('categories', function ($trail) {
    $trail->push('Danh mục', route('categories.index', ['type' => Request::get('type')]));
});

Breadcrumbs::for('categories.create', function ($trail) {
    $trail->parent('categories');
    $trail->push(trans('core::core.crud.create'), route('categories.create'));
});

Breadcrumbs::for('categories.edit', function ($trail, $entity) {
    $trail->parent('categories');
    $trail->push($entity->name, route('categories.edit', $entity->id));
});

Breadcrumbs::for('categories.show', function ($trail, $entity) {
    $trail->parent('categories');
    $trail->push($entity->name, route('categories.show', $entity->id));
});

// ==========================Routes=========================================
Route::group(['prefix' => 'admin'], function()
{
    Route::resource('categories', 'CategoriesController');
});
