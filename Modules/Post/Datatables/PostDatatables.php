<?php
namespace Modules\Post\DataTables;

use Modules\Core\Datatables\PlatformDataTable;
use Modules\Post\Entities\Post;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class PostDatatable extends PlatformDataTable
{
    const SHOW_URL_ROUTE = 'posts.edit';

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
            return view('core::crud.module.actions', ['route' => 'posts', 'id' => $data->id]);
        });

        $dataTable->filterColumn('id', function ($query, $keyword) {
            $query->where('id', '=', $keyword);
        });

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
     * @param Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Post $model)
    {
        return $model->newQuery();
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
        return [
            'id' => [
                'data' => 'id',
                'title' => 'ID ',
                'orderable' => false,
                'filter_type' => 'text'
            ],
            'updated_at' => [
                'data' => 'updated_at',
                'title' => 'Ng??y c???p nh???t',
                'orderable' => true,
                'filter_type' => 'date_range_picker'
            ],
            'created_at' => [
                'data' => 'created_at',
                'title' => 'Ng??y t???o',
                'orderable' => true,
                'filter_type' => 'date_range_picker'
            ],
            Column::computed('actions', 'H??nh ?????ng'),
        ];
    }
}
