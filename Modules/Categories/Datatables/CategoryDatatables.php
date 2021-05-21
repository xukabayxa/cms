<?php
namespace Modules\Categories\Datatables;

use Modules\Core\Datatables\PlatformDataTable;
use Modules\Categories\Entities\Category;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class CategoryDatatables extends PlatformDataTable
{
    const SHOW_URL_ROUTE = 'categories.show';

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = datatables()
            ->eloquent($query);

        $this->applyLinks($dataTable, self::SHOW_URL_ROUTE);

        $dataTable->addColumn('actions', function ($data) {
            return view('categories::partial.actions', ['route' => 'categories', 'id' => $data->id, 'type' => $this->request()->get('type')]);
        });

        $dataTable->filterColumn('id', function ($query, $keyword) {
            $query->where('id', '=', $keyword);
        });

        $dataTable->editColumn('name', function ($record) {
            if ($record->image) {
                $thumbnail = '<a href="#"><img src="'.$record->image->path.'" class="rounded-circle" width="32" height="32" alt=""></a>';
            } else {
                $thumbnail = '<a href="#" class="btn bg-teal-400 rounded-round btn-icon btn-sm legitRipple">
                                <span class="letter-icon">'.mb_substr($record->name, 0 , 1).'</span>
                            </a>';
            }
            return '<div class="d-flex align-items-center">
                        <div class="mr-1">'.$thumbnail.'</div>
                        <div>
                            <a href="'.route('categories.show', ['category' => $record->id]).'" class="text-default font-weight-semibold letter-icon-title">'.$record->name.'</a>
                        </div>
                    </div>';
        });

        $dataTable->filterColumn('name', function ($query, $keyword) {
            $query->where('name', 'Like', "%{$keyword}%");
        });

        $dataTable->editColumn('type', function ($record) {
            $str = '';
            switch ($record->type) {
                case Category::TYPE_COMMON:
                    $str = 'Chung';
                    break;
                case Category::TYPE_PRODUCT:
                    $str = 'Sản phẩm';
                    break;
                case Category::TYPE_POST:
                    $str = 'Bài viết';
                    break;
                default:
                    $str = 'Đặc biệt';
            }
            return "Danh mục $str";
        });

        $dataTable->filterColumn('type', function ($query, $keyword) {
            $query->where('type', '=', $keyword);
        });

        $dataTable->editColumn('children', function ($record) {
            if (count($record->children)) {
                $items = [];
                foreach ($record->children as $child) {
                    if (count($items) >= 3) {
                        break;
                    }
                    $items[] = $child->name;
                }
                return implode(', ', $items) . '...';
            } else {
                return '';
            }
        });

//        $dataTable->editColumn('product_type_id', function ($record) {
//            return $record->productType ? $record->productType->name : '';
//        });
//        $dataTable->filterColumn('product_type_id', function ($query, $keyword) {
//            $query->where('product_type_id', '=', intval($keyword));
//        });

        $dataTable->filterColumn('updated_at', function ($query, $keyword) {
            $date_rage = explode('-', $keyword);
            $start_date = Carbon::createFromFormat('d/m/Y', $date_rage[0])->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', $date_rage[1])->format('Y-m-d');
            $query->where('updated_at', '>=', $start_date)->where('updated_at', '<=', $end_date);
        });

        $dataTable->filterColumn('created_at', function ($query, $keyword) {
            $date_rage = explode('-', $keyword);
            $start_date = Carbon::createFromFormat('d/m/Y', $date_rage[0])->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', $date_rage[1])->format('Y-m-d');
            $query->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date);
        });

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        if (\Request::route()->getName() === 'categories.show') {
            $parameters = \Request::route()->parameters();

            $category = $parameters['category'];
            $query = $model->newQuery()
                ->where(['parent_id' => $category]);
        } else {
            $query = $model->newQuery()
                ->whereNull('parent_id');
//                ->where(['type' => $this->request()->get('type')]);
        }
        return $query->with(['children', 'image']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->responsive()
            ->stateSave()
            ->parameters([
                'dom' => '<"d-flex justify-content-between"lB>rtip',
                'headerFilters' => true,
                'buttons' => [],
                'regexp' => true,
                'order' => [
                    [array_flip(array_keys($this->getColumns()))['created_at'] ?? 0, 'desc']
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $options = [
            ['value' => Category::TYPE_COMMON, 'label' => 'Chung'],
            ['value' => Category::TYPE_PRODUCT, 'label' => 'Sản phẩm'],
            ['value' => Category::TYPE_POST, 'label' => 'Bài viết'],
            ['value' => Category::TYPE_SPECIAL, 'label' => 'Đặc biệt']
        ];

        return [
            'id' => [
                'data' => 'id',
                'title' => 'ID ',
                'orderable' => false,
                'filter_type' => 'text'
            ],
            'name' => [
                'data' => 'name',
                'title' => 'Tên danh mục',
                'orderable' => false,
                'filter_type' => 'text'
            ],
            'type' => [
                'data' => 'type',
                'title' => 'Kiểu',
                'orderable' => false,
                'filter_type' => 'select',
                'filter_data' => $options
            ],
            'children' => [
                'title' => 'Danh mục con',
                'orderable' => false
            ],
            'updated_at' => [
                'data' => 'updated_at',
                'title' => 'Ngày cập nhật',
                'orderable' => true,
                'filter_type' => 'date_range_picker'
            ],
            'created_at' => [
                'data' => 'created_at',
                'title' => 'Ngày tạo',
                'orderable' => true,
                'filter_type' => 'date_range_picker'
            ],
            Column::computed('actions', 'Hành động'),
        ];
    }
}
