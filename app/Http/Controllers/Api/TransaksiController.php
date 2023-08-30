<?php


namespace App\Http\Controllers\Api;


use App\Helper\CustomController;
use App\Models\DetailTransaction;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiController extends CustomController
{
    public function cart()
    {
        if (request()->method() === 'POST') {
            return $this->addCart();
        }
        try {
            $data = DetailTransaction::with(['paket'])
                ->where('user_id', '=', auth()->id())
                ->whereNull('transaksi_id')
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    private function addCart()
    {
        try {
            $paket_id = request()->request->get('paket');
            $qty = request()->request->get('qty');
            $berat = request()->request->get('berat');
            $paket = Package::with([])
                ->where('id', '=', $paket_id)
                ->first();
            if (!$paket) {
                return $this->jsonResponse('paket tidak ditemukan...', 404);
            }
            $harga = $paket->harga;
            $total = (float)$berat * $harga;
            $data = [
                'user_id' => auth()->id(),
                'paket_id' => $paket_id,
                'qty' => $qty,
                'harga' => $harga,
                'berat' => $berat,
                'total' => $total
            ];
            DetailTransaction::create($data);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    public function checkout()
    {
        try {
            DB::beginTransaction();
            $carts = DetailTransaction::with([])
                ->whereNull('transaksi_id')
                ->where('user_id', '=', auth()->id())
                ->get();
            if (count($carts) <= 0) {
                return $this->jsonResponse('tidak ada keranjang. silahkan menambahkan keranjang belanja...', 400);
            }

            $subTotal = $carts->sum('total');
            $discount = 0;
            $total = $subTotal - $discount;
            $data = [
                'no_transaksi' => 'TS-' . Carbon::now()->format('YmdHis'),
                'user_id' => auth()->id(),
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'sub_total' => $subTotal,
                'diskon' => $discount,
                'total' => $total,
                'alamat' => request()->request->get('alamat'),
            ];
            $transaction = Transaction::create($data);
            foreach ($carts as $cart) {
                $cart->update([
                    'transaksi_id' => $transaction->id
                ]);
            }
            DB::commit();
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    public function transactions()
    {
        try {
            $data = Transaction::with(['user', 'detail.paket'])
                ->where('user_id', '=', auth()->id())
                ->orderBy('tanggal', 'DESC')
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    public function transactionsDetail($id)
    {
        try {
            $data = Transaction::with(['user', 'detail.paket'])
                ->where('id', '=', $id)
                ->where('user_id', '=', auth()->id())
                ->orderBy('tanggal', 'DESC')
                ->first();
            if (!$data) {
                return $this->jsonResponse('transaksi tidak ditemukan...', 404);
            }
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    public function pembayaran($id)
    {
        try {
            $data = Transaction::find($id);
            $data->status = 2;
            $data->metode_pembayaran = request()->request->get('metode');;
            $data->update();

            if (!$data) {
                return $this->jsonResponse('transaksi tidak ditemukan...', 404);
            }
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    public function selesai($id)
    {
        try {
            $data = Transaction::find($id);
            $data->status = 5;
            $data->update();

            if (!$data) {
                return $this->jsonResponse('transaksi tidak ditemukan...', 404);
            }
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    public function delete($id)
    {
        try {
            $data = DetailTransaction::find($id);
            $data->delete();

            if (!$data) {
                return $this->jsonResponse('transaksi tidak ditemukan...', 404);
            }
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }
}
