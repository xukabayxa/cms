<?php
namespace Modules\SystemResource\DataTables;

use Modules\Core\Datatables\PlatformDataTable;
use Modules\SystemResource\Entities\SystemResource;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class SystemResourceDatatable extends PlatformDataTable
{
    const SHOW_URL_ROUTE = 'systemresources.edit';

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
            return view('core::crud.module.actions', ['route' => 'systemresources', 'id' => $data->id]);
        });

        $dataTable->filterColumn('id', function ($query, $keyword) {
            $query->where('id', '=', $keyword);
        });



        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param SystemResource $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SystemResource $model)
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
