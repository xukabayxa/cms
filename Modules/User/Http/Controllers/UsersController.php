<?php

namespace Modules\User\Http\Controllers;

use Modules\Core\Http\Controllers\ModuleCrudController;
use Modules\User\DataTables\UserDatatable;
use Modules\User\Http\Forms\UserForm;
use Modules\User\Http\Requests\UserStoreRequest;
use Modules\User\Http\Requests\UserUpdateRequest;
use Modules\User\Repositories\UserRepository;
use Modules\User\Services\UserService;

class UsersController extends ModuleCrudController
{
    /**
     * Permissions
     * @var array
     */
    protected $permissions = [
        'browse' => 'users.browse',
        'create' => 'users.create',
        'update' => 'users.update',
        'destroy' => 'users.destroy'
    ];
    /**
     * Path to language files
     * @var
     */
    protected $languageFile = 'users::user';

    /**
     * All routes
     * @var array
     */
    protected $routes = [
        'index' => 'users.index',
        'create' => 'users.create',
        'data' => 'users.data',
        'store' => 'users.store',
        'update' => 'users.update',
    ];

    /**
     * All breadcrumbs
     * @var array
     */
    protected $breadcrumbs = [
        'index' => 'users',
        'show' => 'users.show',
        'create' => 'users.create',
        'edit' => 'users.edit',
    ];

    protected $routeName = 'users';
    protected $storeRequest = UserStoreRequest::class;
    protected $updateRequest = UserUpdateRequest::class;
    protected $formClass = UserForm::class;
    protected $datatable = UserDatatable::class;

    protected $showFields = [

        'information' => [

        ]
    ];

    protected $userService;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @throws \Exception
     */
    public function __construct(UserRepository $repository, UserService $userService)
    {
        parent::__construct($repository);

        $this->userService = $userService;
    }
}
