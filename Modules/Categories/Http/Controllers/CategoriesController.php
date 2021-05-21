<?php

namespace Modules\Categories\Http\Controllers;

use Auth;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Modules\Categories\Entities\Category;
use Modules\Categories\Service\CategoryService;
use Modules\Core\Helper\ImagesHelper;
use Modules\Core\Http\Controllers\ModuleCrudController;
use Modules\Categories\Datatables\CategoryDatatables;
use Modules\Categories\Http\Forms\CategoryForm;
use Modules\Categories\Http\Requests\CategoryStoreRequest;
use Modules\Categories\Http\Requests\CategoryUpdateRequest;
use Modules\Categories\Repositories\CategoryRepository;
use Modules\User\Entities\Helper\UserHelper;

class CategoriesController extends ModuleCrudController
{
    /**
     * Permissions
     * @var array
     */
    protected $permissions = [
        'browse' => 'categories.browse',
        'create' => 'categories.create',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy'
    ];
    /**
     * Path to language files
     * @var
     */
    protected $languageFile = 'categories::category';

    /**
     * All routes
     * @var array
     */
    protected $routes = [
        'index' => 'categories.index',
        'create' => 'categories.create',
        'data' => 'categories.data',
        'store' => 'categories.store',
        'update' => 'categories.update',
        'show' => 'categories.show'
    ];

    /**
     * All breadcrumbs
     * @var array
     */
    protected $breadcrumbs = [
        'index' => 'categories',
        'show' => 'categories.show',
        'create' => 'categories.create',
        'edit' => 'categories.edit',
    ];

    protected $routeName = 'categories';
    protected $storeRequest = CategoryStoreRequest::class;
    protected $updateRequest = CategoryUpdateRequest::class;
    protected $formClass = CategoryForm::class;
    protected $datatable = CategoryDatatables::class;

    protected $showFields = [

        'information' => [

        ]
    ];

    /**
     * Default Crud view
     * @var array
     */
    protected $views = [
        'index' => 'categories::index',
        'show' => 'categories::show',
        'create' => 'categories::create',
        'edit' => 'categories::edit'
    ];

    protected $categoryService;

    /**
     * CategoriesController constructor.
     *
     * @param CategoryRepository $repository
     * @throws Exception
     */
    public function __construct(CategoryRepository $repository, CategoryService $categoryService)
    {
        parent::__construct($repository);

        $this->categoryService = $categoryService;
    }

    /**
     * @return Application|\Illuminate\Http\JsonResponse|RedirectResponse|Redirector
     */
    public function store()
    {
        try {
            $request = App::make($this->storeRequest ?? Request::class);

            if ($this->permissions['create'] != '' && !Auth::user()->hasPermissionTo($this->permissions['create'])) {
                flash(trans('core::core.you_dont_have_access'))->error();
                return redirect()->route($this->routes['index']);
            }

            $data = $this->form($this->formClass)
                ->getRequest()
                ->only(['name', 'description', 'status', 'parent_id', 'type', 'product_type_id', 'display_at']);

            $this->categoryService->create($data, $request->thumbnail);

            flash(trans('core::core.entity.created'))->success();

            if (isset($data['parent_id'])) {
                return redirect(route($this->routes['show'], ['category' => $data['parent_id']]));
            } else {
                return redirect(route($this->routes['index'], ['type' => $data['type']]));
            }

        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }

    /**
     * Update entity
     *
     * @param $identifier
     * @return RedirectResponse|Redirector
     */
    public function update($identifier)
    {
        try {
            $request = App::make($this->updateRequest ?? Request::class);

            /** @var Category $entity */
            $category = $this->repository->find($identifier);

            $data = $this->form($this->formClass)
                ->getRequest()
                ->only(['name', 'description', 'status', 'parent_id', 'type', 'product_type_id', 'display_at']);

            $category = $this->categoryService->update($category, $data, $request->thumbnail);

            flash(trans('core::core.entity.updated'))->success();

            if ($category->parent_id) {
                return redirect(route($this->routes['show'], ['category' => $category->parent_id]));
            } else {
                return redirect(route($this->routes['index'], ['type' => $category->type]));
            }
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }

    /**
     * Display a listing of the resource.
     * @param $identifier
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($identifier)
    {
        $entity = $this->repository->find($identifier);
        $request = App::make(Request::class);
        if ($request->get('type') == null) {
//            return redirect(route($this->routes['show'], ['categories' => $entity->id, 'type' => $entity->type]));
            return redirect(route($this->routes['show'], ['category' => $entity->id, 'type' => $entity->type]));
        }

        $datatable = \App::make($this->datatable);
        return $datatable->render($this->views['show'], ['entity' => $entity]);

    }
}
