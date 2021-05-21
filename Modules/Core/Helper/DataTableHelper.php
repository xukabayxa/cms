<?php

namespace Modules\Core\Helper;

use Yajra\DataTables\EloquentDataTable;

/**
 * DataTable helper
 *
 * Class DataTableHelper
 * @package Modules\Platform\Core\Helper
 */
class DataTableHelper
{

    /**
     * Render column link
     *
     * @param $column
     * @param $record
     * @param $route
     * @return string
     */
    public static function renderLink($column, $record, $route)
    {
        $displayColumn = $record->$column;

        if ($route != '') {
            $href = route($route, $record->id);
        } else {
            $href = '#';
        }

        $link = '<a data-column="' . strip_tags($column) . '" title="' . strip_tags($displayColumn) . '" href="' . $href . '"> ' . strip_tags($displayColumn) . '</a>';

        return $link;
    }

}
