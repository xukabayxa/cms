<?php

namespace Modules\SystemResource\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Core\Http\Controllers\ModuleCrudController;
use Modules\SystemResource\DataTables\SystemResourceDatatable;
use Modules\SystemResource\Entities\SystemResource;
use Modules\SystemResource\Helpers\SRHelper;
use Modules\SystemResource\Http\Forms\SystemResourceForm;
use Modules\SystemResource\Http\Requests\SystemResourceStoreRequest;
use Modules\SystemResource\Http\Requests\SystemResourceUpdateRequest;
use Modules\SystemResource\Repositories\SystemResourceRepository;
use Modules\SystemResource\Services\SystemResourceService;

class SystemResourcesController extends ModuleCrudController
{
    /**
     * Permissions
     * @var array
     */
    protected $permissions = [
        'browse' => 'systemresources.browse',
        'create' => 'systemresources.create',
        'update' => 'systemresources.update',
        'destroy' => 'systemresources.destroy'
    ];
    /**
     * Path to language files
     * @var
     */
    protected $languageFile = 'systemresources::systemresource';

    /**
     * All routes
     * @var array
     */
    protected $routes = [
        'index' => 'systemresources.index',
        'create' => 'systemresources.create',
        'data' => 'systemresources.data',
        'store' => 'systemresources.store',
        'update' => 'systemresources.update',
    ];

    /**
     * All breadcrumbs
     * @var array
     */
    protected $breadcrumbs = [
        'index' => 'systemresources',
        'show' => 'systemresources.show',
        'create' => 'systemresources.create',
        'edit' => 'systemresources.edit',
    ];

    protected $routeName = 'systemresources';
    protected $storeRequest = SystemResourceStoreRequest::class;
    protected $updateRequest = SystemResourceUpdateRequest::class;
    protected $formClass = SystemResourceForm::class;
    protected $datatable = SystemResourceDatatable::class;

    protected $showFields = [

        'information' => [

        ]
    ];

    /**
     * Default Crud view
     * @var array
     */
    protected $views = [
        'index' => 'systemresource::index',
        'show' => 'systemresource::show',
        'create' => 'systemresource::create',
        'edit' => 'systemresource::edit'
    ];

    protected $systemresourceService;

    /**
     * SystemResourcesController constructor.
     *
     * @param SystemResourceRepository $repository
     * @throws \Exception
     */
    public function __construct(SystemResourceRepository $repository, SystemResourceService $systemresourceService)
    {
        parent::__construct($repository);

        $this->systemresourceService = $systemresourceService;
    }

    public function create()
    {
        $images = SystemResource::query()->get();

        $createForm = $this->form($this->formClass, [
            'method' => 'POST',
            'url' => route($this->routes['store']),
            'id' => 'module_form'
        ]);

        $createView = $this->views['create'];

        $view = view($createView);

        $view->with('images', $images);
        $view->with('show_fields', $this->showFields);

        return $view->with('form', $createForm);
    }

    public function store()
    {
        $request = App::make($this->storeRequest ?? Request::class);

        $image_data = SRHelper::uploadFile($request->file, 'resource');

        SRHelper::saveImage($image_data);
    }
}
