@extends('admin.base')

@section('morecss')
    <link href="{{ asset('js/admin/dropify/css/dropify.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="panel min-h-screen">

        <div class="bg-white border rounded-md  p-5 my-3">


            <div class=" p-5 mt-3">
                <div class="flex gap-5">
                    <p class="flex-grow">User</p>
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
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                No Transaksi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sub Total
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Diskon
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total
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
                        No. Transaksi #<span id="noTrans"></span>
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            onclick="modal.hide()">
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

                <div class="p-6 space-y-6">
                    <div class="mb-6 grid grid-cols-2 gap-2">
                       <div class="">
                           <label for="judulberita"
                                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama User
                           </label>
                           <input type="text" id="nama" name="nama" readonly
                                  class="Form-edit bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                  placeholder="">
                       </div>
                        <div class="">
                            <label for="judulberita"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Transaksi
                            </label>
                            <input type="text" id="tanggal" name="tanggal" readonly
                                   class="Form-edit bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                   placeholder="">
                        </div>
                    </div>


                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">Paket</th>
                            <th scope="col" class="px-6 py-3">Jumlah Item</th>
                            <th scope="col" class="px-6 py-3">Harga</th>
                            <th scope="col" class="px-6 py-3">Berat (kg)</th>
                            <th scope="col" class="px-6 py-3">Total Harga</th>
                        </tr>
                        </thead>
                        <tbody id="tbDetail"></tbody>
                    </table>

                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')


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
            let id = $(this).data('id');
            let tb = $('#tbDetail');
            tb.empty();
            $.get('/transaksi/detail/' + id, function (res) {
                $('#noTrans').html(res.no_transaksi);
                $('#modal #nama').val(res.user.nama);
                $('#modal #tanggal').val(moment(res.tanggal).format('DD MMMM YYYY'));
                $.each(res.detail, function (k, v) {
                    tb.append('<tr>' +
                        '         <td class="px-6 py-4">'+parseInt(k + 1)+'</td>' +
                        '         <td class="px-6 py-4">'+v.paket.nama+'</td>' +
                        '         <td class="text-center px-6 py-4">'+v.qty+'</td>' +
                        '         <td class="text-right px-6 py-4">Rp. '+v.harga.toLocaleString()+'</td>' +
                        '         <td class="text-center px-6 py-4">'+v.berat+'</td>' +
                        '         <td class="text-right px-6 py-4">Rp. '+v.total.toLocaleString()+'</td>' +
                        '      </tr>');
                })
                tb.append('<tr>' +
                    '           <td colspan="5" class="px-6 py-2">Sub Total</td>' +
                    '           <td class="text-right px-6 py-2">Rp. '+res.sub_total.toLocaleString()+'</td>' +
                    '      <tr>');
                tb.append('<tr>' +
                    '           <td colspan="5" class="px-6 py-2">Diskon</td>' +
                    '           <td class="text-right  px-6 py-2">'+res.diskon.toLocaleString()+' %</td>' +
                    '      <tr>');
                tb.append('<tr>' +
                    '           <td colspan="5" class="px-6 py-2">Diskon</td>' +
                    '           <td class="text-right  px-6 py-2">Rp. '+res.total.toLocaleString()+'</td>' +
                    '      <tr>');
            });

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
                    data: 'tanggal', name: 'tanggal'
                },
                {
                    data: 'no_transaksi', name: 'no_transaksi'
                },
                {
                    data: 'user.nama', name: 'user.nama'
                },
                {
                    data: 'sub_total', name: 'sub_total', render(e){
                        return e.toLocaleString()
                    }
                },
                {
                    data: 'diskon', name: 'diskon'
                },
                {
                    data: 'total', name: 'total', render(e){
                        return e.toLocaleString()
                    }
                },
                {
                    className: "text-center",
                    data: 'action', name: 'action', orderable: false, searchable: false
                },
            ];

            datatable('table', '{{route('transaksi.datatable')}}', colums)

        }


    </script>
@endsection
