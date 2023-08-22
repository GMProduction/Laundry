@extends('admin.base')

@section('morecss')
    <link href="{{ asset('js/admin/dropify/css/dropify.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="panel min-h-screen">


        <div class="bg-white border rounded-md  p-5 my-3">

            <div class="border rounded-lg p-2 flex gap-4 mb-8">
                <div date-rangepicker class="flex items-center">
                    <div>
                        <p class="flex-grow">Tanggal Awal</p>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input id="start" name="start" type="text"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Select date start">
                        </div>
                    </div>
                    <span class="mx-4 text-gray-500">to</span>
                    <div>
                        <p class="flex-grow">Tanggal Akhir</p>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input id="end" name="end" type="text"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Select date end">
                        </div>
                    </div>
                </div>
                <div class="flex items-end gap-2 justify-between w-full">
                    <div class="flex items-end gap-2">
                        <a class="font-bold cursor-pointer p-2 bg-blue-600 rounded-md text-white transition-all duration-300  hover:bg-blue-400" onclick="searchTable()">Cari</a>
                        <a class="font-bold cursor-pointer p-2 bg-red-600 rounded-md text-white transition-all duration-300  hover:bg-red-400" onclick="clearData()">Clear</a>
                    </div>
                    <a class="font-bold cursor-pointer p-2 bg-orange-500 rounded-md text-white transition-all duration-300  hover:bg-orange-400" target="_blank" id="cetak">Cetak</a>
                </div>

            </div>
            <div class=" p-5 mt-3">
                <div class="flex gap-5">
                    <p class="flex-grow">Laporan Transaksi</p>
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
                                Tanggal Pemesanan
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
                                Metode Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Selesai
                            </th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('morejs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <script>
        let start = '', end = '';
        $(document).ready(function () {
            showDatatable();
        })

        function searchTable() {
            start = $('#start').val();
            end = $('#end').val();
            if (start) {
                start = moment(start, 'MM/DD/YYYY').format('YYYY-MM-DD')
                end = moment(end, 'MM/DD/YYYY').format('YYYY-MM-DD')
            }
            let url = '/laporan/datatable?sd=' + start + '&ed=' + end;
            $('#table').DataTable().ajax.url(url).load()
        }

        function clearData() {
            start = ''
            end = '';
            $('#start').val(start);
            $('#end').val(end);
            let url = '{{route('laporan.datatable')}}';
            $('#table').DataTable().ajax.url(url).load()
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
                    data: 'tanggal', name: 'tanggal', render(e) {
                        return moment(e).format('LL')
                    }
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
                    data: 'metode_pembayaran', name: 'metode_pembayaran'
                },
                {
                    data: 'updated_at', name: 'updated_at', render(e) {
                        return moment(e).format('LL')
                    }
                },
            ];

            datatable('table', '{{route('laporan.datatable')}}', colums, null, ['1', 'DESC'])

        }

        $(document).on('click', '#cetak', function () {
            console.log('asdasd')
            let url =  '/laporan/cetak';
            if (start){
                url =  '/laporan/cetak?start=' + start + '&end=' + end;
            }
                $(this).attr('href',url);
        })
    </script>
@endsection
