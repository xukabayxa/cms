<?php

namespace Modules\Core\Datatables;

use Modules\Core\Helper\DataTableHelper;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

/**
 * Class PlatformDataTable
 * @package Modules\Platform\Core\Datatable
 */
abstract class PlatformDataTable extends DataTable
{
    protected $sourceRoute;

    protected $tableId;

    /**
     * @param $route
     */
    public function setAjaxSource($route)
    {
        $this->sourceRoute = $route;
    }

    public function setTableId($tableId)
    {
        $this->tableId = $tableId;
    }

    /**
     * @return Builder
     */
    public function builder()
    {
        $builder = parent::builder();

        if ($this->tableId != '') {
            $builder = $builder->setTableId($this->tableId);
        }
        if ($this->sourceRoute != '') {
            $builder = $builder->ajax($this->sourceRoute);
        }

        return $builder
            ->responsive()
            ->stateSave()
            ->parameters([
                'dom' => 'Blrtip',
                'headerFilters' => true,
                'buttons' => ['print', 'reset', 'reload'],
                'initComplete' => "function () {
                    this.api().columns().every(function () {
                        $('.dataTables_wrapper').addClass('table-responsive')
                        var column = this;
                        var setting = column.settings()[0].aoColumns[column.index()]
                        if (setting.searchable) {
                            var filter_type = setting.filter_type,
                                searchValue = column.search();

                            if (filter_type === 'text') {
                                var input = document.createElement(\"input\");
                                input.className = \"form-control\";
                                if (setting.placeholder) {
                                    input.placeholder = setting.placeholder;
                                }
                                input.value = searchValue
                                $(input).appendTo($(column.header()))
                                .on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                }).on('click mousedown', function (e) {
                                    e.stopPropagation()
                                }).on('keydown',  function (e) {
                                    if (e.which === 13) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                        column.search($(this).val(), false, false, true).draw();
                                    }
                                });
                            } else if (filter_type === 'select') {
                                var filter_data = setting.filter_data;
                                var options = ['<option value=\"\">Chọn 1 giá trị</option>'];
                                filter_data.forEach(function(o) {
                                    options.push('<option value=\"'+o.value+'\">'+o.label+'</option>')
                                })
                                var select = '<select data-placeholder=\"Chọn 1 giá trị...\" class=\"form-control select-search\">'+options.join()+'</select>'
                                $(select).appendTo($(column.header()))
                                .on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                                $('.select-search').select2({placeholder: 'Chọn 1 giá trị', allowClear: true});
                            } else if (filter_type === 'date_range_picker') {
                                var picker = '<input type=\"text\" class=\"form-control daterange-basic\" value=\"\">'
                                $(picker).appendTo($(column.header())).on('click mousedown', function (e) {
                                    e.stopPropagation()
                                });
                                $('.daterange-basic').daterangepicker(
                                    {
                                        applyClass: 'bg-slate-600',
                                        cancelClass: 'btn-light',
                                        autoUpdateInput: false,
                                    },
                                    function(start, end) {
                                        column.search(start.format('DD/MM/YYYY') + '-' + end.format('DD/MM/YYYY'), false, false, true).draw();
                                    }
                                );

                                $('.daterange-basic').on('apply.daterangepicker', function(ev, picker) {
                                    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                                });

                                $('.daterange-basic').on('cancel.daterangepicker', function(ev, picker) {
                                    $(this).val('');
                                    column.search('', false, false, true).draw();
                                });
                            }
                        }
                    });
                }",
            ]);
    }

    /**
     * @param EloquentDataTable $table
     * @param $route
     * @param null $prefix
     */
    public function applyLinks(EloquentDataTable $table, $route, $prefix = null)
    {
        $rawColumns = [];

        foreach ($this->getColumns() as $column => $properties) {
            $rawColumns[] = $column;

            $table->editColumn($column, function ($record) use ($column, $properties, $route, $prefix) {
                return DataTableHelper::renderLink($column, $record, $route);
            });
        }

        $table->rawColumns($rawColumns);
    }

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [];
    }

    public static function buttons($title = '2baby')
    {
        return
            [
                [
                    'extend' => 'reset',
                    'text' => trans('core::core.reset'),
                ],
                [
                    'extend' => 'copy',
                    'title' => $title,
                    'exportOptions' => [
                        'format' => [
                            'header' => "function(mDataProp,columnIdx) {
                                var htmlText = '<span>' + mDataProp + '</span>';
                                var jHtmlObject = jQuery(htmlText);
                                jHtmlObject.find('div').remove();
                                var newHtml = jHtmlObject.text();
                                return newHtml;
                                }"
                        ]
                    ]
                ],
                [
                    'extend' => 'print',
                    'title' => $title,
                    'exportOptions' => [
                        'format' => [
                            'header' => "function(mDataProp,columnIdx) {
                                var htmlText = '<span>' + mDataProp + '</span>';
                                var jHtmlObject = jQuery(htmlText);
                                jHtmlObject.find('div').remove();
                                var newHtml = jHtmlObject.text();
                                return newHtml;
                                }"
                        ]
                    ]
                ],
                [
                    'extend' => 'excelHtml5',
                    'title' => $title,
                    'exportOptions' => [
                        'format' => [
                            'header' => "function(mDataProp,columnIdx) {
                                var htmlText = '<span>' + mDataProp + '</span>';
                                var jHtmlObject = jQuery(htmlText);
                                jHtmlObject.find('div').remove();
                                var newHtml = jHtmlObject.text();
                                return newHtml;
                                }"
                        ]
                    ]
                ],
                [
                    'extend' => 'pdfHtml5',
                    'title' => $title,
                    'orientation' => 'landscape',
                    'exportOptions' => [
                        'format' => [
                            'header' => "function(mDataProp,columnIdx) {
                                var htmlText = '<span>' + mDataProp + '</span>';
                                var jHtmlObject = jQuery(htmlText);
                                jHtmlObject.find('div').remove();
                                var newHtml = jHtmlObject.text();
                                return newHtml;
                                }"
                        ]
                    ]
                ]
            ];
    }
}
