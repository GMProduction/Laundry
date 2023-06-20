<?php


namespace App\Http\Controllers\Api;


use App\Helper\CustomController;
use App\Models\Package;

class PaketController extends CustomController
{
    public function index()
    {
        try {
            $q = request()->query->get('q');
            $data = Package::with([])
                ->where('nama', 'LIKE', '%' . $q . '%')
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    public function detail($id)
    {
        try {
            $data = Package::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$data) {
                return $this->jsonResponse('paket tidak ditemukan...', 404);
            }
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }
}
