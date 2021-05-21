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
Breadcrumbs::for('tags', function ($trail) {
    $trail->push('Tags', route('tags.index'));
});

Breadcrumbs::for('tags.create', function ($trail) {
    $trail->parent('tags');
    $trail->push(trans('core::core.crud.create'), route('tags.create'));
});

Breadcrumbs::for('tags.edit', function ($trail, $entity) {
    $trail->parent('tags');
    $trail->push($entity->id, route('tags.edit', $entity->id));
});

// ==========================Routes=========================================
Route::group(['middleware' => ['web'], 'prefix' => 'admin'], function()
{
    Route::resource('tags', 'TagsController');
});
