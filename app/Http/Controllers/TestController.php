<?php

namespace App\Http\Controllers;

use App\DataTables\TestDataTable;
use App\Http\Requests;
use Request;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;


use App\Models\Category;
use DataTables;

class TestController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    public function getIndex()
    {
        $datatable['columns'] = [
            ['className' => 'details-control', 'orderable' => false, 'searchable' => false, 'data' => NULL, 'defaultContent' => 'ver mas'],  
            ['data' => 'id', 'name' => 'id'],
            ['data' => 'name', 'name' => 'name'],
            ['data' => 's_name', 'name' => 's_name'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false]
        ];
        return view('testdatatable.index', compact('datatable'));
    }

    public function anyData(Request $request)
    {
        $category = Category::select(['categories.*', 'statuses.id as s_id', 'statuses.name as s_name'])->join('statuses','statuses.id', '=', 'categories.status_id');

        return DataTables::of($category)
            ->filterColumn('s_name', function($query, $keyword) {
                $sql = "statuses.name = ?";
                $query->whereRaw($sql, ["{$keyword}"]);
            })
            ->addColumn('action', function ($category) {
                return '<a href="#edit-'.$category->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

}
