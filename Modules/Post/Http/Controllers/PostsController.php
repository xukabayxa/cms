<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Modules\Categories\Entities\Category;
use Modules\Core\Entities\Image;
use Modules\Core\Helper\ImagesHelper;
use Modules\Core\Http\Controllers\ModuleCrudController;
use Modules\Post\DataTables\PostDatatable;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\PostType;
use Modules\Post\Http\Forms\PostForm;
use Modules\Post\Http\Requests\PostStoreRequest;
use Modules\Post\Http\Requests\PostUpdateRequest;
use Modules\Post\Repositories\PostRepository;
use Modules\Post\Services\PostService;
use Modules\SystemResource\DataTables\SystemResourceDatatable;
use Modules\SystemResource\Entities\SystemResource;

class PostsController extends ModuleCrudController
{
    /**
     * Permissions
     * @var array
     */
    protected $permissions = [
        'browse' => 'posts.browse',
        'create' => 'posts.create',
        'update' => 'posts.update',
        'destroy' => 'posts.destroy'
    ];
    /**
     * Path to language files
     * @var
     */
    protected $languageFile = 'posts::post';

    /**
     * All routes
     * @var array
     */
    protected $routes = [
        'index' => 'posts.index',
        'create' => 'posts.create',
        'data' => 'posts.data',
        'store' => 'posts.store',
        'update' => 'posts.update',
    ];

    /**
     * All breadcrumbs
     * @var array
     */
    protected $breadcrumbs = [
        'index' => 'posts',
        'show' => 'posts.show',
        'create' => 'posts.create',
        'edit' => 'posts.edit',
    ];

    protected $routeName = 'posts';
    protected $storeRequest = PostStoreRequest::class;
    protected $updateRequest = PostUpdateRequest::class;
    protected $formClass = PostForm::class;
    protected $datatable = PostDatatable::class;

    protected $showFields = [

        'information' => [

        ]
    ];

    /**
     * Default Crud view
     * @var array
     */
    protected $views = [
        'index' => 'post::index',
        'show' => 'post::show',
        'create' => 'post::create',
        'edit' => 'post::edit'
    ];

    protected $postService;

    /**
     * PostsController constructor.
     *
     * @param PostRepository $repository
     * @throws \Exception
     */
    public function __construct(PostRepository $repository, PostService $postService)
    {
        parent::__construct($repository);

        $this->postService = $postService;
    }

    public function create()
    {
//        if ($this->permissions['create'] != '' && !Auth::user()->hasPermissionTo($this->permissions['create'])) {
//            flash(trans('core::core.you_dont_have_access'))->error();
//            return redirect()->route($this->routes['index']);
//        }

        $createForm = $this->form($this->formClass, [
            'method' => 'POST',
            'url' => route($this->routes['store']),
            'id' => 'module_form',
        ]);

        $createView = $this->views['create'];

        $view = view($createView);

        $view->with('show_fields', $this->showFields);


        return $view->with('form', $createForm);
    }

    public function store()
    {
        $request = App::make($this->storeRequest ?? Request::class);

        $data = $request->only(['title','short_content','content','type']);

        $data['slug'] = Str::slug($data['title']);
        $data['created_by_id'] = 1;

        $tags = explode(',', ($request->get('tags')[0]));


        /** @var Post $post */
        $post = $this->repository->create($data);

        $post->categories()->syncWithoutDetaching($request->category);

        foreach ($tags as $tag) {
            $data['tagable_id'] = $post->id;
            $data['tagable_type'] = Post::class;
            $data['name'] = trim($tag);
            $post->tags()->create($data);
        }

    }
}
