<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PaketController extends CustomController
{

    public function datatable()
    {
        $data = DB::table('paket');

        return DataTables::of($data)
            ->addColumn(
                'action',
                function ($data) {
                    $id = $data->id;

                    return "<a type=\"button\" data-id='" . $id . "' data-nama='" . $data->nama . "'  data-harga='" . $data->harga . "' data-deskripsi='" . $data->deskripsi . "' data-gambar='" . $data->gambar . "'
                                       class=\"editData font-bold cursor-pointer p-2 bg-blue-600 rounded-md text-white transition-all duration-300  hover:bg-blue-400\">Edit</a>
                                    <a href=\"#\" data-id='" . $id . "'
                                       class=\"deleteData font-bold p-2 bg-red-600 rounded-md text-white transition-all duration-300  hover:bg-red-400\">Hapus</a>";
                }
            )->rawColumns(['action'])->make(true);
    }

    public function index()
    {
        if (request()->method() == 'POST') {
            return $this->SaveData();
        }

        return view('admin/paket/index');
    }

    public function SaveData()
    {
        request()->validate(
            [
                'nama'      => 'required',
                'harga'     => 'required',
                'deskripsi' => 'required',
            ],
            [
                'nama.required'      => 'Nama paket harus di isi',
                'harga.required'     => 'Harga harus di isi',
                'deskripsi.required' => 'Deskripsi harus di isi',
            ]
        );

        $data            = Package::find(request('id'));
        $oldImg          = null;
        $imageName       = $this->generateImageName('image');
        $destinationPath = public_path() . '/assets/images/paket';
        $field           = request()->all();

        if (request()->has('image')) {
            $field['gambar'] = '/assets/images/paket/' . $imageName;
        }

        if ($data) {
            $oldImg = $data->image;
            $data->update($field);
            $text = 'Berhasil edit data';
        } else {
            Package::create($field);
            $text = 'Berhasil simpan data';
        }

        if (request()->has('image')) {
            $file = request()->file('image');
            $this->saveImage($imageName, $file, $destinationPath, $oldImg);
        }

        return [
            'status_text' => $text
        ];
    }
}
