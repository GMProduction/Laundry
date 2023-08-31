<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TransaksiController extends Controller
{

    public function datatable()
    {
        $data = Transaction::with('user');

        return DataTables::of($data)
            ->addColumn(
                'action',
                function ($data) {
                    $id = $data->id;

                    return "<a type=\"button\" data-id='" . $id . "'
                                       class=\"editData font-bold cursor-pointer p-2 bg-blue-600 rounded-md text-white transition-all duration-300  hover:bg-blue-400\">Detail</a>
                                    <a href=\"#\" data-id='" . $id . "'
                                       class=\"deleteData font-bold p-2 bg-red-600 rounded-md text-white transition-all duration-300  hover:bg-red-400\">Hapus</a>";
                }
            )->rawColumns(['action'])->make(true);
    }

    public function index()
    {
        return view('admin/transaksi/index');
    }

    public function detail($id)
    {
        return Transaction::with(['detail.paket', 'user'])->find($id);
    }

    public function changeStatus($id)
    {
        $status = request('status');
        $trans  = Transaction::find($id);
        $trans->update([
            'status' => $status,
        ]);

        return 'success';
    }

    public function changeBerat($id)
    {
        DB::beginTransaction();
        try {
            $idDetail = request('id_detail');
            $berat    = request('berat');
            $trans = Transaction::find($id);

            $detail = DetailTransaction::find($idDetail);
            $total = (float)$berat * $detail->harga;
            $detail->update([
                'berat' => $berat,
                'total' => $total,
            ]);

            $detailAll = DetailTransaction::where('transaksi_id', $id)->get();
            $subTotalTrans = 0;
            foreach ($detailAll as $d) {
                $subTotalTrans = (float)$d->total + $subTotalTrans;
            }
            $totalTrans = $subTotalTrans - (float)$trans->diskon;

            $trans->update([
                'sub_total' => $subTotalTrans,
                'total' => $totalTrans,
            ]);
            DB::commit();
            return 'success';
        } catch (\Exception $er) {
            DB::rollBack();
            return $er->getMessage();
        }
    }
}
