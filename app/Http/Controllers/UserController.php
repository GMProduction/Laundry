<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function datatable()
    {
        $data = User::where('role','member');

        return DataTables::of($data)
                         ->addColumn(
                             'action',
                             function ($data) {
                                 $id = $data->id;

                                 return "<a type=\"button\" data-id='".$id."' data-nama='".$data->nama."'  data-username='".$data->username."'
                                       class=\"editData font-bold cursor-pointer p-2 bg-blue-600 rounded-md text-white transition-all duration-300  hover:bg-blue-400\">Detail</a>
                                    <a href=\"#\" data-id='".$id."'
                                       class=\"deleteData font-bold p-2 bg-red-600 rounded-md text-white transition-all duration-300  hover:bg-red-400\">Hapus</a>";
                             }
                         )->rawColumns(['action'])->make(true);
    }

    public function index(){
        return view('admin/user/index');
    }

}
