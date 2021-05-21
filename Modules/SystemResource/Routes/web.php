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
Breadcrumbs::for('systemresources', function ($trail) {
    $trail->push('SystemResources', route('systemresources.index'));
});

Breadcrumbs::for('systemresources.create', function ($trail) {
    $trail->parent('systemresources');
    $trail->push(trans('core::core.crud.create'), route('systemresources.create'));
});

Breadcrumbs::for('systemresources.edit', function ($trail, $entity) {
    $trail->parent('systemresources');
    $trail->push($entity->id, route('systemresources.edit', $entity->id));
});

// ==========================Routes=========================================
Route::group(['middleware' => ['web'], 'prefix' => 'admin'], function()
{
    Route::resource('systemresources', 'SystemResourcesController');
});
