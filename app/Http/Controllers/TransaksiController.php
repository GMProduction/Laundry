<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Yajra\DataTables\DataTables;

class TransaksiController extends Controller
{

    public function datatable(){
        $data = Transaction::with('user');

        return DataTables::of($data)
                         ->addColumn(
                             'action',
                             function ($data) {
                                 $id = $data->id;

                                 return "<a type=\"button\" data-id='".$id."'
                                       class=\"editData font-bold cursor-pointer p-2 bg-blue-600 rounded-md text-white transition-all duration-300  hover:bg-blue-400\">Edit</a>
                                    <a href=\"#\" data-id='".$id."'
                                       class=\"deleteData font-bold p-2 bg-red-600 rounded-md text-white transition-all duration-300  hover:bg-red-400\">Hapus</a>";
                             }
                         )->rawColumns(['action'])->make(true);
    }

    public function index(){
        return view('admin/transaksi/index');
    }

    public function detail($id){
        return Transaction::with(['detail.paket','user'])->find($id);
    }

    public function changeStatus($id){
        $status = request('status');
        $trans = Transaction::find($id);
        $trans->update([
            'status' => $status
        ]);

        return 'success';
    }

}
