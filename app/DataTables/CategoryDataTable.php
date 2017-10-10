<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'categories.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        return $model->orderBy('name', 'asc'); //whereIn('id',[2,3])->
        //return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    'create',
                    'export',
                    'print',
                    'reset',
                    'reload',
                ],
                'pageLength' => 2,
                'initComplete' => 'function (rows) {
                    this.api().columns([1]).every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        
                        $(input).appendTo($(column.footer())).on(\'keyup change\', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                    });
                    $("tfoot tr").appendTo("thead");
                    }'
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
            'image' => ['width' => '100px', 'name' => '', 'data' => '', 'orderable' => false, 'render' => '"<img width=\"100px\" height=\"30px\" src=\"http://www.masquenegocio.com/wp-content/uploads/2014/03/inMediaStudio-logo.jpg\" height=\"50\"/>"'],
            'Nombre' => ['name' => 'name', 'data' => 'name'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'categoriesdatatable_' . time();
    }
}