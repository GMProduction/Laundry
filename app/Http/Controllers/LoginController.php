<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        if (request()->method() == 'POST') {
            $message = [
                "username.required" => "Username Harus di isi",
                "username.exists"   => "Username tidak terdaftar",
                "password.required" => "Password harus di isi",
                "password.min"      => "Password tidak boleh kurang dari 8 karakter",
            ];

            $validator = Validator::make(
                request()->all(),
                [
                    'username' => 'required|exists:users,username',
                    'password' => 'required|min:8',
                ],
                $message
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
                    if (\auth()->user()->role == 'member') {
                        Auth::logout();

                        return redirect()->back()->withInput()->withErrors(
                            [
                                'username' => 'Username tidak terdaftar',
                            ]
                        );
                    }
//                    if (Auth::user()->role == 'dinkes') {
//                        return redirect('/admin');
//                    }
                    return redirect()->route('dashboard');
                }

                return redirect()->back()->withInput()->withErrors(
                    [
                        'password' => 'Password salah.',
                    ]
                );

            }
        }

        return view('login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
