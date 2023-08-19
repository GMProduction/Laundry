<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;

class LaporanController extends Controller
{
    public function datatable()
    {
        $start = request('sd');
        $end = request('ed');
        $data = Transaction::with('user')->where('status','>=', 2);
        if ($start){
            $start = $start.' 00:00:00';
            $end = $end.' 23:59:59';
            $data = $data->whereBetween('tanggal',[$start, $end]);
        }

        return DataTables::of($data)
                        ->make(true);
    }

    public function index(){
        return view('admin/laporan/index');
    }

    public function cetakLaporan()
    {

//        return $this->dataTransaksi();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataTransaksi())->setPaper('f4', 'landscape')->save('Laporan.pdf');

        return $pdf->stream();
    }

    public function dataTransaksi()
    {

        $trans = Transaction::with(['user']);
        $start = \request('start');
        $end = \request('end');
        if (\request('start')){
            $trans = $trans->whereBetween('tanggal', ["$start 00:00:00", "$end 23:59:59"]);
        }
        $trans = $trans->get();
        return view('admin/laporan/pdf',['data' => $trans]);
    }

}
