<?php

namespace App\DataTables;

use DB;
use DataTables;
use App\Http\Requests;
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

        return $dataTable
            ->filterColumn('s_name', function($query, $keyword) {
                //$sql = "statuses.name = ?";
                //$query->whereRaw($sql, ["{$keyword}"]);
                //$query->where('statuses.name','=', "{$keyword}");
            })
            ->filterColumn('c_name', function($query, $keyword) {
                //$query->where('categories.name','like', "%{$keyword}%");
            })
            ->addColumn('action', 'categories.datatables_actions');
            
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        $column = $this->request->all()['columns'];

        $query = $model
            ->join('statuses', 'statuses.id','=','categories.status_id')
            ->select([
                'categories.id as id',
                'categories.name as c_name',
                'categories.created_at as c_created_at',
                'statuses.id as s_id',
                'statuses.name as s_name',
                ]);
            
        if(isset($column[1]['search']['value']))
            $query->where('categories.name','like', "%".$column[1]['search']['value']."%");
    
        if(isset($column[2]['search']['value']) && $column[2]['search']['value'] <> 'Todos')
            $query->where('statuses.name','=', $column[2]['search']['value']);

        return $query;
        
        //return $model->newQuery();
    }
    
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    
    /*
    public function ajax()
    {
        $builder = Category::join('statuses', 'statuses.id','=','categories.status_id')
        ->where('statuses.name', '=', 'activo')
        ->where('categories.name', 'like', '%pr%')
        ->select([
                'categories.id as id',
                'categories.name as c_name',
                'statuses.id as s_id',
                'statuses.name as s_name',
                ]);

        return DataTables::of($builder)
        ->filterColumn('s_name', function($query, $keyword) {
            //$sql = "statuses.name = ?";
            //$query->whereRaw($sql, ["{$keyword}"]);
            $query->where('statuses.name','=', "{$keyword}");
        })
        ->filterColumn('c_name', function($query, $keyword) {
            $query->where('categories.name','like', "%{$keyword}%");
        })
        ->addColumn('action', 'categories.datatables_actions')
        ->make(true);        
    }
    */
    

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px'])
            ->parameters([
                'dom'     => 'Bfrtip',
                //'order'   => [[0, 'desc']],
                'buttons' => [
                    'create',
                    'export',
                    'print',
                    'reset',
                    'reload',
                ],
                'pageLength' => 5,
                'initComplete' => 'function (rows) {

                    $(".dataTables_filter").remove();

                    this.api().columns([1,2]).every(function (key) {
                        var column = this;
                        var name = rows.aoColumns[key].name;
                        
                        switch(key) {
                            case 1:
                                var input = $(\'<input type="text" name="\'+name+\'">\');

                            break;
                            case 2:

                                var input = document.createElement("select");
                                input.name = name;

                                var array = [\'Todos\',\'Activo\',\'Inactivo\',\'Sincronizando\'];

                                for (var i = 0; i < array.length; i++) {
                                    var option = document.createElement("option");
                                    option.value = array[i];
                                    option.text = array[i];
                                    input.appendChild(option);
                                }
                            
                            break;
                        }                        
                                                 
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
            'Nombre' => ['name' => 'c_name', 'data' => 'c_name'],
            'Estado' => ['name' => 's_name', 'data' => 's_name'],
            'Fecha' => ['name' => 'c_created_at', 'data' => 'c_created_at'],
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