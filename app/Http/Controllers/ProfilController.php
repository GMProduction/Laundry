<?php


namespace App\Http\Controllers\Api;


use App\Helper\CustomController;
use App\Models\User;

class ProfilController extends CustomController
{
    public function index()
    {
        try {
            $id = auth()->id();
            $data = User::with([])
                ->where('id', '=', $id)
                ->first();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }
}
