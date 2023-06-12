<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function datatable()
    {
        $data = User::where('role', 'admin');

        return DataTables::of($data)
                         ->addColumn(
                             'action',
                             function ($data) {
                                 $id = $data->id;

                                 return "<a type=\"button\" data-id='".$id."' data-nama='".$data->nama."'  data-username='".$data->username."'
                                       class=\"editData font-bold cursor-pointer p-2 bg-blue-600 rounded-md text-white transition-all duration-300  hover:bg-blue-400\">Edit</a>
                                    <a href=\"#\" data-id='".$id."'
                                       class=\"deleteData font-bold p-2 bg-red-600 rounded-md text-white transition-all duration-300  hover:bg-red-400\">Hapus</a>";
                             }
                         )->rawColumns(['action'])->make(true);
    }

    public function index()
    {
        if (request()->method() == 'POST') {
            return $this->saveData();
        }

        return view('admin/admin/index');
    }

    public function saveData()
    {
        $data = User::find(request('id'));

        if ($data) {
            request()->validate(
                [
                    'nama'     => 'required',
                    'username' => 'required',
                ],
                [
                    'nama.required'     => 'Nama harus di isi',
                    'username.required' => 'Username harus di isi',
                ]
            );

            $field['nama']     = request('nama');
            $field['username'] = request('username');

            if (request('password')) {
                request()->validate(
                    [
                        'password' => 'confirmed|min:8',
                    ],
                    [
                        'password.confirmed' => 'Password tidak sesuai',
                        'password.min'       => 'Password harus lebih dari 8 karakter',
                    ]
                );
                $field['password'] = Hash::make(request('password'));
            }
            $data->update($field);
        } else {
            request()->validate(
                [
                    'nama'     => 'required',
                    'username' => 'required',
                    'password' => 'confirmed|min:8',
                ],
                [
                    'nama.required'      => 'Nama harus di isi',
                    'username.required'  => 'Username harus di isi',
                    'password.confirmed' => 'Password tidak sesuai',
                    'password.min'       => 'Password harus lebih dari 8 karakter',
                ]
            );
            $field['nama']     = request('nama');
            $field['username'] = request('username');
            $field['role']     = 'admin';
            $field['password'] = Hash::make(request('password'));

            User::create($field);
        }

        return 'success';
    }

}
