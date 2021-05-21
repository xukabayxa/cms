<?php

namespace Modules\Tag\Http\Controllers;

use Modules\Core\Http\Controllers\ModuleCrudController;
use Modules\Tag\DataTables\TagDatatable;
use Modules\Tag\Http\Forms\TagForm;
use Modules\Tag\Http\Requests\TagStoreRequest;
use Modules\Tag\Http\Requests\TagUpdateRequest;
use Modules\Tag\Repositories\TagRepository;
use Modules\Tag\Services\TagService;

class TagsController extends ModuleCrudController
{
    /**
     * Permissions
     * @var array
     */
    protected $permissions = [
        'browse' => 'tags.browse',
        'create' => 'tags.create',
        'update' => 'tags.update',
        'destroy' => 'tags.destroy'
    ];
    /**
     * Path to language files
     * @var
     */
    protected $languageFile = 'tags::tag';

    /**
     * All routes
     * @var array
     */
    protected $routes = [
        'index' => 'tags.index',
        'create' => 'tags.create',
        'data' => 'tags.data',
        'store' => 'tags.store',
        'update' => 'tags.update',
    ];

    /**
     * All breadcrumbs
     * @var array
     */
    protected $breadcrumbs = [
        'index' => 'tags',
        'show' => 'tags.show',
        'create' => 'tags.create',
        'edit' => 'tags.edit',
    ];

    protected $routeName = 'tags';
    protected $storeRequest = TagStoreRequest::class;
    protected $updateRequest = TagUpdateRequest::class;
    protected $formClass = TagForm::class;
    protected $datatable = TagDatatable::class;

    protected $showFields = [

        'information' => [

        ]
    ];

    protected $tagService;

    /**
     * TagsController constructor.
     *
     * @param TagRepository $repository
     * @throws \Exception
     */
    public function __construct(TagRepository $repository, TagService $tagService)
    {
        parent::__construct($repository);

        $this->tagService = $tagService;
    }
}
