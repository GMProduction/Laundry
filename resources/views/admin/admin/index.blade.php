@extends('admin.base')

@section('morecss')
    <link href="{{ asset('js/admin/dropify/css/dropify.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="panel min-h-screen">

        <div class="bg-white border rounded-md  p-5 my-3">


            <div class=" p-5 mt-3">
                <div class="flex gap-5">
                    <p class="flex-grow">Admin</p>
                </div>
                <hr class="mb-5 mt-2">


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-2 bg-white">
                    <table id="table" class="w-full text-sm text-left text-gray-500 " style="width: 100%">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div id="modal" tabindex="-1" aria-hidden="true"
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-4xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Data Blog
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="modal.hide()">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="form" onsubmit="return saveForm()">
                    @csrf
                    <input id="id" name="id" class="Form-edit" hidden>
                    <div class="p-6 space-y-6">
                        <div class="mb-6">
                            <label for="judulberita"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Paket
                            </label>
                            <input type="text" id="nama" name="nama"
                                   class="Form-edit bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                   placeholder="">
                        </div>
                        <div class="mb-6 mt-6">
                            <label for="isiberita" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi
                            </label>
                            <textarea name="deskripsi" id="deskripsi" class="Form-edit bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "></textarea>
                        </div>
                        <div class="mb-6 mt-6">
                            <label for="tanggal"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Paket
                            </label>
                            <input type="number" id="harga" name="harga"
                                   class="Form-edit bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block max-w-sm p-2.5 "
                                   placeholder="">
                        </div>

                        <div class="w-44">
                            <label for="fotoberita"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukan
                                Foto</label>
                            <input type="file" id="image" name="image" class="dropImage" data-min-height="10"
                                   data-heigh="400" accept="image/*"
                                   data-allowed-file-extensions="jpg jpeg png"/>

                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit"
                                class="flex-grow text-white bg-blue-700 min-h-32 text-center hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg px-5 py-5 text-xl">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script src="{{ asset('js/admin/dropify/js/dropify.js') }}"></script>


    <script>
        const targetModal = document.getElementById('modal');
        let modal = new Modal(targetModal, {
            placement: 'center',
            backdrop: 'dynamic',
            onShow: () => {

            },
            onHide: () => {

            }
        });
        $(document).ready(function () {
            showDatatable();
        })


        $(document).on('click', '#addData, .editData', function () {
            $('.Form-edit').val('')

            let row = $(this).data()
            let value = "";

            $.each(row, function (k, v) {
                $('#'+k).val(v)
            })

            imageSiswa = $('#image').dropify({
                messages: {
                    'default': 'Masukkan File Foto',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });

            imageSiswa = imageSiswa.data('dropify');
            imageSiswa.resetPreview();
            imageSiswa.clearElement();
            imageSiswa.settings.defaultFile = $(this).data('gambar');
            imageSiswa.destroy();
            imageSiswa.init();
            modal.show();
        })

        function showDatatable() {
            let colums = [
                {
                    className: "text-center",
                    orderable: false,
                    defaultContent: "",
                    searchable: false
                },
                {
                    data: 'nama', name: 'nama'
                },
                {
                    data: 'username', name: 'username'
                },
                {
                    className: "text-center",
                    data: 'action', name: 'action', orderable: false, searchable: false
                },
            ];

            datatable('table', '{{route('admin.datatable')}}', colums)

        }


        function saveForm() {
            confirmSave('Simpan Data Berita', 'Apa anda yakin ?', 'form', '{{route('admin')}}', afterSave);
            return false
        }

        function afterSave() {
            modal.hide();
            $('#table').DataTable().ajax.url('{{route('admin.datatable')}}').load()
        }
    </script>
@endsection
