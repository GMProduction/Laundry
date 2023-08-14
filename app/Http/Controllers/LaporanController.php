<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Yajra\DataTables\DataTables;

class LaporanController extends Controller
{

    public function datatable()
    {
        $start = request('sd');
        $end = request('ed');
        $data = Transaction::with('user')->where('status', '>=', 2);
        if ($start) {
            $start = $start . ' 00:00:00';
            $end = $end . ' 23:59:59';
            $data = $data->whereBetween('updated_at', [$start, $end]);
        }

        return DataTables::of($data)
            ->make(true);
    }

    public function index()
    {
        return view('admin/laporan/index');
    }
}
