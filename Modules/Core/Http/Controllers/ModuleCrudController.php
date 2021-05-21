<?php

namespace Modules\Core\Http\Controllers;
use App;
use Auth;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilderTrait;

/**
 * Class ModuleCrudController
 *
 * @package Modules\Platform\Core\Http\Controllers
 */
abstract class ModuleCrudController extends CmsBaseController
{

    use FormBuilderTrait;

    protected $routeName = null;

    protected $repository = null;

    /**
     * Permissions
     * @var array
     */
    protected $permissions = [
        'browse' => '',
        'create' => '',
        'update' => '',
        'destroy' => ''
    ];
    /**
     * Path to language files
     * @var
     */
    protected $languageFile;

    /**
     * All routes
     * @var array
     */
    protected $routes = [

    ];

    /**
     * All breadcrumbs
     * @var array
     */
    protected $breadcrumbs = [
        'index' => '',
        'show' => '',
        'create' => '',
        'edit' => ''
    ];

    /**
     * Module Entity Class
     * @var
     */
    protected $entityClass;

    /**
     * Module Store Request
     * @var
     */
    protected $storeRequest;
    /**
     * Module Update Request
     * @var
     */
    protected $updateRequest;

    /**
     * Entity Form Class
     * @var
     */
    protected $formClass;

    /**
     * @var bool
     */
    protected $validateModule = true;

    /**
     * Default Crud view
     * @var array
     */
    protected $views = [
        'index' => 'core::crud.module.index',
        'show' => 'core::crud.module.show',
        'create' => 'core::crud.module.create',
        'edit' => 'core::crud.module.edit'
    ];

    /**
     * Show fields in show view and create/edit view
     *
     * Example @UserController
     *
     * @var array
     */
    protected $showFields = [

    ];

    /***
     * Form section buttons
     * Example @InvoiceController
     * @var array
     */
    protected $sectionButtons = [];

    protected $jsFiles = [];

    protected $moduleName = '';

    /**
     * SettingsCrudController constructor.
     * @param $repository
     * @throws Exception
     */
    public function __construct($repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->validateModule();
        \View::share('language_file', $this->languageFile);
        \View::share('breadcrumbs', $this->breadcrumbs);
        \View::share('permissions', $this->permissions);
        \View::share('routes', $this->routes);
        \View::share('moduleName', $this->moduleName);
        \View::share('jsFiles', $this->jsFiles);

    }

    /**
     * Validate module controller setup
     * @throws Exception
     */
    public function validateModule()
    {
        if($this->validateModule) {
            if ($this->repository == null && $this->entityClass == null) {
                throw new Exception('Please set repository or entityClass in Controller');
            }

            if ($this->formClass == null) {
                throw new Exception('Please set FormClass');
            }

            if ($this->storeRequest == null || $this->updateRequest == null) {
                throw new Exception('Please set storeRequest and updateRequest');
            }
        }
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $datatable = \App::make($this->datatable);
        $indexView = $this->views['index'];

        return $datatable->render($indexView);
    }

    /**
     * @return Factory|RedirectResponse|View
     */
    public function create()
    {

//        if ($this->permissions['create'] != '' && !Auth::user()->hasPermissionTo($this->permissions['create'])) {
//            flash(trans('core::core.you_dont_have_access'))->error();
//            return redirect()->route($this->routes['index']);
//        }

        $createForm = $this->form($this->formClass, [
            'method' => 'POST',
            'url' => route($this->routes['store']),
            'id' => 'module_form'
        ]);

        $createView = $this->views['create'];

        $view = view($createView);

        $view->with('show_fields', $this->showFields);

        return $view->with('form', $createForm);
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function store()
    {
        App::make($this->storeRequest ?? Request::class);

        if ($this->permissions['create'] != '' && !Auth::user()->hasPermissionTo($this->permissions['create'])) {
            flash(trans('core::core.you_dont_have_access'))->error();
            return redirect()->route($this->routes['index']);
        }

        $storeValues = $this->form($this->formClass)->getRequest()->all();

        $this->repository->create($storeValues);
        flash(trans('core::core.entity.created'))->success();

        return redirect(route($this->routes['index']));
    }

    /**
     * @param $identifier
     * @return RedirectResponse|Redirector
     */
    public function edit($identifier)
    {

//        if ($this->permissions['update'] != '' && !Auth::user()->hasPermissionTo($this->permissions['update'])) {
//            flash(trans('core::core.you_dont_have_access'))->error();
//            return redirect()->route($this->routes['index']);
//        }
        $entity = $this->repository->find($identifier);

        $updateForm = $this->form($this->formClass, [
            'method' => 'PATCH',
            'url' => route($this->routes['update'], $entity),
            'id' => 'module_form',
            'model' => $entity
        ]);

        $updateView = $this->views['edit'];

        $view = view($updateView);
        $view->with('form_request', $this->storeRequest);
        $view->with('entity', $entity);
        $view->with('show_fields', $this->showFields);
        $view->with('sectionButtons', $this->sectionButtons);

        $view->with('form', $updateForm);

        return $view;
    }

    /**
     * Update entity
     *
     * @param $identifier
     * @return RedirectResponse|Redirector
     */
    public function update($identifier)
    {
        if ($this->permissions['update'] != '' && !Auth::user()->hasPermissionTo($this->permissions['update'])) {
            flash(trans('core::core.you_dont_have_access'))->error();
            return redirect()->route($this->routes['index']);
        }

        App::make($this->updateRequest ?? Request::class);

        $entity = $this->repository->find($identifier);

        $input = $this->form($this->formClass)->getRequest()->all();

        $entity = $this->repository->update($input, $identifier);

        flash(trans('core::core.entity.updated'))->success();

        return redirect(route($this->routes['index'], $entity));
    }

    /**
     * @param $identifier
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy($identifier)
    {
//        if ($this->permissions['destroy'] != '' && !Auth::user()->hasPermissionTo($this->permissions['destroy'])) {
//            flash(trans('core::core.you_dont_have_access'))->error();
//            return redirect()->route($this->routes['index']);
//        }

        $entity = $this->repository->find($identifier);

        $this->repository->delete($entity->id);

        flash(trans('core::core.entity.deleted'))->success();

        return redirect(route($this->routes['index']));
    }
}
