<?php

namespace dsanchezInmedia\DataTable;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/* 
    use dsanchezInmedia\DataTable\TestDatatable as DataTableDS;
    $datatableds = new DataTableDS;
    echo $datatableds->getTest('prueba');
*/
class TestDatatable
{
    public function getTest($data)
    {
        return $data;
    }
}
