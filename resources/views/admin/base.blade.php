<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laundry</title>

    {{-- Genosstyle --}}
    {{-- <link href="{{ asset('css/genosstyle.css') }} " rel="stylesheet"> --}}
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="{{ asset('css/genosstailwind.css') }}" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <!-- Add the theme's stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    {{-- AOS JS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />

    {{-- FLOWBITE --}}




    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.11.1/dist/cdn.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    {{--    <link href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" rel="stylesheet">--}}
    {{--    <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" rel="stylesheet">--}}
    {{--    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('morecss')
    <style>
        #table_length select {
            padding-right: 1.5rem !important;
        }
    </style>
</head>

<body class="relative min-h-screen">

<nav class="h-[70px] bg-white  top-0 w-full shadow-sm z-20 fixed">
    <div class="px-[24px] relative h-full flex items-center z-20 justify-between">

        <div class=" h-full flex items-center">
            <a onclick="openNav()"><span
                    class="material-symbols-outlined cursor-pointer rounded-full p-2 hover:bg-black/10 transition duration-300">
                        menu
                    </span></a>

            {{-- <img src="{{ asset('/assets/local/logosurakarta.png') }}" class="logo   h-10   " alt="Surakarta Logo"> --}}

            <p class="text-xl font-bold ml-4">Laundry </p>
        </div>

        <div class=" h-full flex items-center">
            <button type="button" id="dropdownDefault" data-dropdown-toggle="dropdown"
                    class="block w-[35px] h-[35px] rounded-full bg-black/10 cursor-pointer overflow-hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>

            </button>


            <!-- Dropdown menu -->
            <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow ">
                <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault">

                    <a class="block py-2 px-4 text-xs   ">Hi, </a>
                    <div class="divide-y-2"></div>
                    <li>
                        <a class="block py-2 px-4 hover:bg-gray-100  text-red-600 cursor-pointer" href="/logout">Sign
                            out</a>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</nav>

<div class="flex h-full">
    <div id="sidebar" class="bg-white shadow-sm h-full fixed top-0 left-0 sidebar">
        <div class="min-h-[70px]"></div>
        <div class="p-3 py-5">



            <a class="menu {{ request()->path() == '/' ? 'bg-primarylight' : '' }}  nav-link flex items-center gap-1" href="/">

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <p class="title-menu block menu-text m-0 p-0">Beranda </p>
            </a>
            <a class="menu {{ request()->is('paket') ? 'bg-primarylight' : '' }}  nav-link flex items-center gap-1"
               href="{{route('paket')}}">

              <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                  </svg>
              </div>
                <p class="title-menu block menu-text">Paket</p>
            </a>
            <a class="menu {{ request()->is('user') ? 'bg-primarylight' : '' }}  nav-link flex items-center gap-1"
               href="{{route('user')}}">

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <p class="title-menu block menu-text">User</p>
            </a>

            <a class="menu {{ request()->is('admin') ? 'bg-primarylight' : '' }}  nav-link flex items-center gap-1"
               href="{{route('admin')}}">

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <p class="title-menu block menu-text">Admin</p>
            </a>

            <a class="menu {{ request()->is('transaksi') ? 'bg-primarylight' : '' }}  nav-link flex items-center gap-1"
               href="{{route('transaksi')}}">

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <p class="title-menu block menu-text">Transaksi</p>
            </a>
            <a class="menu {{ request()->is('laporan') ? 'bg-primarylight' : '' }}  nav-link flex items-center gap-1"
               href="{{route('laporan')}}">

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <p class="title-menu block menu-text">Laporan</p>
            </a>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="w-full">
        <div class="h-[70px]">

        </div>

        <div class="flex " style="min-height: calc(100vh - 70px)">
            <div class="side">

            </div>
            <div class="flex-1">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


{{-- <script type="text/javascript">
    function dropdown() {
        document.querySelector("#submenu").classList.toggle("hidden");
        document.querySelector("#arrow").classList.toggle("rotate-180");
    }

    dropdown();
</script>

<script type="text/javascript">
    function dropdownlaporan() {
        document.querySelector("#submenulaporan").classList.toggle("hidden");
        document.querySelector("#arrowlaporan").classList.toggle("rotate-180");
    }

    dropdownlaporan();
</script> --}}

{{-- <script src="{{ asset('/js/flowbite.js') }}"></script> --}}

<script src="{{ asset('/js/admin/nav.js') }}"></script>
<script src="{{ asset('js/admin/currency.js') }}"></script>
<script src="{{ asset('js/admin/admin.js') }}"></script>
{{-- <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script> --}}
{{-- <script src="{{ asset('js/datatable.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>



<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
{{--    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>--}}
{{--    <script type="text/javascript"--}}
{{--            src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>--}}
{{--    <script type="text/javascript"--}}
{{--            src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>--}}
{{--    <script type="text/javascript"--}}
{{--            src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>--}}

<script src="{{ asset('js/admin/datatable.js') }}"></script>
<script src="{{ asset('js/admin/moment.min.js') }}"></script>


@yield('morejs')



<script>

    $(document).ready(function () {
        moment.locale('id');
    })


    jQuery.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": oSettings._iDisplayLength === -1 ?
                0 : Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": oSettings._iDisplayLength === -1 ?
                0 : Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };
</script>

</body>

</html>
