<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personal;
use Yajra\Datatables\Datatables;

class DataTablesController extends Controller
{
    public function datatables(){


        return view('datatables.dataTables');

    }
    public function getData(){
       // $personal=personal::select('');

        return Datatables::of(personal::query())->make(true);
    }
}
