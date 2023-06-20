<?php


namespace App\Http\Controllers\Api;


use App\Helper\CustomController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends CustomController
{
    public function login()
    {
        $credentials = request(['username', 'password']);

        $user = User::with([])
            ->where('username', '=', request()->request->get('username'))
            ->where('role', '=', 'member')
            ->first();

        if (!$user) {
            return $this->jsonResponse('user tidak ditemukan', 401);
        }
        $is_password_valid = Hash::check(request()->request->get('password'), $user->password);
        if (!$is_password_valid) {
            return $this->jsonResponse('password tidak cocok', 401);
        }
        if (!$token = auth('api')->setTTL(null)->attempt($credentials)) {
            return $this->jsonResponse('Username dan Password Tidak Cocok', 401);
        }
        $token = auth('api')->setTTL(null)->tokenById($user->id);
        return $this->respondWithToken($token, 'member');
    }

    public function register()
    {
        try {
            DB::beginTransaction();
            $username = request()->request->get('username');
            $password = request()->request->get('password');
            $name = request()->request->get('name');

            $data = [
                'nama' => $name,
                'username' => $username,
                'role' => 'member',
                'password' => Hash::make($password)
            ];

            $user = User::create($data);
            $token = $this->generateTokenById($user->id, 'member');
            DB::commit();
            return $this->respondWithToken($token, 'member');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    protected function respondWithToken($token, $role)
    {
        return $this->jsonResponse('success', 200, [
            'access_token' => $token,
            'role' => $role,
            'type' => 'Bearer'
        ]);
    }
}
