@extends('admin.base')

@section('morecss')
    <link href="{{ asset('js/admin/dropify/css/dropify.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="panel min-h-screen">

        <div class="bg-white border rounded-md  p-5 my-3">


            <div class=" p-5 mt-3">
                <div class="flex gap-5">
                    <p class="flex-grow">Transaksi</p>
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
                                Status
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
                        No. Transaksi #<span id="noTrans"></span> <span id="txtStatus"></span>
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
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <div class="">
                            <label for="alamat"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat
                            </label>
                            <textarea type="text" id="alamat" name="alamat" readonly
                                      class="Form-edit bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                      placeholder=""></textarea>
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
                <div id="btnChange" class="flex justify-end items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">

                </div>
            </div>
        </div>
    </div>

    <div id="modalBerat" tabindex="-1" aria-hidden="true"
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-1/4 h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Ganti Berat</span>
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            onclick="modalBerat.hide()">
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

               <form id="formBerat" onsubmit="return saveBerat()">
                   @csrf
                   <input name="id_detail" id="id" hidden>
                   <div class="p-6 space-y-6">
                       <div class="">
                           <label for="judulberita"
                                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berat
                           </label>
                           <input type="number" id="berat" name="berat"
                                  class="Form-edit bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                  placeholder="">
                       </div>
                   </div>
                   <!-- Modal footer -->
                   <div class="flex justify-end items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                       <button class="font-bold cursor-pointer p-2 bg-blue-600 rounded-md text-white transition-all duration-300  hover:bg-blue-400">Simpan</button>
                   </div>
               </form>
            </div>
        </div>
    </div>
@endsection

@section('morejs')

    <script>
        const targetModal = document.getElementById('modal');
        const targetModalBerat = document.getElementById('modalBerat');
        let idTrans;
        let modal = new Modal(targetModal, {
            placement: 'center',
            backdrop: 'dynamic',
            onShow: () => {

            },
            onHide: () => {

            }
        });


        let modalBerat = new Modal(targetModalBerat, {
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

        function getStatus(stat) {
            let text, next = '';
            switch (stat) {
                case 1:
                    text = 'Menunggu Pembayaran';
                    break;
                case 2:
                    text = 'Pembayaran Diterima';
                    break;
                case 3:
                    text = 'Diproses';
                    break;
                case 4:
                    text = 'Dikirim';
                    break;
                case 5:
                    text = 'Selesai';
                    break;
                case 6:
                    text = 'Ditolak';
                    break;
                default:
                    text = "Menunggu Konfirmasi";
                    break;
            }
            return text;
        }

        function getBtn(stat) {
            let btn;
            switch (stat) {
                case 0:
                    btn = '<a class="changeStatus font-bold cursor-pointer p-2 bg-blue-600 rounded-md text-white transition-all duration-300  hover:bg-blue-400" data-text="Terima" data-status="1">Terima</a>' +
                        '<a class="changeStatus font-bold cursor-pointer p-2 bg-red-600 rounded-md text-white transition-all duration-300  hover:bg-red-400" data-text="Tolak" data-status="6">Tolak</a>';
                    break;
                case 1:
                    btn = '<label class="font-bold p-2 text-blue-600 rounded-md  transition-all duration-300" >Menunggu Pembayaran</label>';
                    break;
                case 2:
                    btn = '<a class="changeStatus font-bold cursor-pointer p-2 bg-blue-600 rounded-md text-white transition-all duration-300  hover:bg-blue-400" data-text="Proses" data-status="3">Proses</a>';
                    break;
                case 3:
                    btn = '<a class="changeStatus font-bold cursor-pointer p-2 bg-blue-600 rounded-md text-white transition-all duration-300  hover:bg-blue-400" data-text="Kirim" data-status="4">Dikirim</a>';
                    break;
                case 4:
                    btn = '<label class="font-bold p-2 text-blue-600 rounded-md  transition-all duration-300" >Menunggu Penerima</label>';
                    break;
                default:
                    btn = '';
                    break;
            }
            return btn;
        }

        $(document).on('click','.changeStatus', function () {
            let text = $(this).data('text');
            let status = $(this).data('status');
            console.log(text);
            console.log(status);
            let form = {
                '_token':'{{csrf_token()}}',
                status: status
            }

            confirmSaveSerialize(capitalizeFirstLetter(text)+' Pesanan', 'Apa anda yakin ?', form, '/transaksi/detail/' + idTrans+'/change-status', afterSave);
            return false

        })

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function afterSave(){
            showDetailData();
            $('#table').DataTable().ajax.url('{{route('transaksi.datatable')}}').load()
        }

        $(document).on('click', '#addData, .editData', function () {
            idTrans = $(this).data('id');

            showDetailData();
            modal.show();
        })

        function showDetailData(){
            let tb = $('#tbDetail');
            tb.empty();
            $.get('/transaksi/detail/' + idTrans, function (res) {
                let status = getStatus(res.status);

                $('#noTrans').html(res.no_transaksi);
                $('#modal #nama').val(res.user.nama);
                $('#modal #btnChange').html(getBtn(res.status));
                $('#modal #alamat').val(res.alamat);
                $('#modal #txtStatus').html('( ' + status + ' )');
                $('#modal #tanggal').val(moment(res.tanggal).format('DD MMMM YYYY'));
                let editBtn = '';

                $.each(res.detail, function (k, v) {
                    if (res.status == 0){
                        editBtn = '<a class="cursor-pointer gantiBerat" data-berat="' + v.berat + '" data-id="'+v.id+'"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">'+
                            '             <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />'+
                            '            </svg>'+
                            '         </a>'
                    }
                    tb.append('<tr>' +
                        '         <td class="px-6 py-4">' + parseInt(k + 1) + '</td>' +
                        '         <td class="px-6 py-4">' + v.paket.nama + '</td>' +
                        '         <td class="text-center px-6 py-4">' + v.qty + '</td>' +
                        '         <td class="text-right px-6 py-4">Rp. ' + v.harga.toLocaleString() + '</td>' +
                        '         <td class="text-center px-6 py-4"><div class="flex gap-1 items-center">' + v.berat + ''+editBtn+'</div></td>' +
                        '         <td class="text-right px-6 py-4">Rp. ' + v.total.toLocaleString() + '</td>' +
                        '      </tr>');
                })
                tb.append('<tr>' +
                    '           <td colspan="5" class="px-6 py-2">Sub Total</td>' +
                    '           <td class="text-right px-6 py-2">Rp. ' + res.sub_total.toLocaleString() + '</td>' +
                    '      <tr>');
                // tb.append('<tr>' +
                //     '           <td colspan="5" class="px-6 py-2">Diskon</td>' +
                //     '           <td class="text-right  px-6 py-2">' + res.diskon.toLocaleString() + ' %</td>' +
                //     '      <tr>');
                tb.append('<tr>' +
                    '           <td colspan="5" class="px-6 py-2">Grand Total</td>' +
                    '           <td class="text-right  px-6 py-2">Rp. ' + res.total.toLocaleString() + '</td>' +
                    '      <tr>');
            });
        }


        $(document).on('click','.gantiBerat', function () {
            $('#formBerat #id').val($(this).data('id'))
            $('#formBerat #berat').val($(this).data('berat'))
            modalBerat.show()
        })

        function saveBerat(){
            confirmSave('Ganti berat', 'Apa anda yakin ?', 'formBerat', '/transaksi/detail/' + idTrans+'/change-weight', afterSaveBerat);
            return false
        }

        function afterSaveBerat(){
            modalBerat.hide();
            afterSave();
        }

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
                    data: 'sub_total', name: 'sub_total', render(e) {
                        return e.toLocaleString()
                    }
                },
                {
                    data: 'diskon', name: 'diskon', render(e) {
                        return e.toLocaleString()
                    }
                },
                {
                    data: 'total', name: 'total', render(e) {
                        return e.toLocaleString()
                    }
                },
                {
                    data: 'status', name: 'status', render(e) {
                        return getStatus(e)
                    }
                },
                {
                    className: "text-center",
                    data: 'action', name: 'action', orderable: false, searchable: false
                },
            ];

            datatable('table', '{{route('transaksi.datatable')}}', colums, null,['1','DESC'])

        }


    </script>
@endsection
