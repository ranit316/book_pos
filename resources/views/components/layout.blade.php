<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <title>I&CA Book Store | {{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    @php
        $fav = \App\Models\AppInfo::first();
    @endphp
    @if ($fav && $fav->fav_icon)
        {{-- If $data->dark_logo is not null, display it --}}
        <link rel="shortcut icon" href="{{ asset($fav->fav_icon) }}">
    @else
        {{-- If $data->dark_logo is null, fallback to default logo --}}
        <img src="{{ asset('images/setting/favicon1.jpg') }}" height="40">
    @endif

    <!-- plugin css -->
    <link href="{{ asset('assets/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- swiper css -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <!-- Bootstrap Css -->
    <link id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
    {{-- Added by tapas 05-12-2023 --}}
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}



    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    {{-- 
     <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet"> --}}

    <link href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>



    {{-- 
     <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet"> --}}

    <link href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<div id="spinner_content" style="display:none;"><i class="mdi mdi-spin mdi-loading mdiload"></i></div>

<body>


    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('include.header')
        @include('include.sidebar')
        {{ $body }}
        @include('include.footer')
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/metismenujs.min.js') }}"></script>
        <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/js/feather.min.js') }}"></script>
        <script src="{{ asset('assets/js/alertify.min.js') }}"></script>
        <script src="{{ asset('assets/js/feather.min.js') }}"></script>
        <script src="{{ asset('assets/js/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/js/nouislider.min.js') }}"></script>
        <script src="{{ asset('assets/js/rater.js') }}"></script>
        <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/js/wNumb.min.js') }}"></script>
        <!-- apexcharts -->
        {{-- <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script> --}}
        <!-- for basic area chart -->
        <script src="{{ asset('assets/js/stock-prices.js') }}"></script>
        <!-- for github style chart -->
        <script src="{{ asset('assets/js/github-data.js') }}"></script>
        <!-- for irregular timeseries chart -->
        <script src="{{ asset('assets/js/irregular-data-series.js') }}"></script>
        <script src="{{ asset('assets/js/moment.min.js') }}"></script>
        <!-- Vector map-->
        <script src="{{ asset('assets/js/jsvectormap.min.js') }}"></script>
        <script src="{{ asset('assets/js/world-merc.js') }}"></script>
        <!-- swiper js -->
        <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/pages/all.init.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/js/pages/apexcharts-boxplot.init.js') }}"></script> --}}
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/method.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>


        {{-- ---------------start----------- this is use for Export to PDF CSV  file action --}}

        <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/colreorder/1.7.0/js/dataTables.colReorder.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

        {{-- ---------------end----------- this is use for Export to PDF CSV  file action --}}

        {{-- <script src="assets/js/pages/apexcharts-line.init.js"></script> --}}

        <script>
            function saveText(text) {
                sessionStorage.setItem("searchText", text.innerText)
            }

            document.addEventListener('DOMContentLoaded', function() {


                function checkInputAvailability() {
                    const searchInput11 = document.querySelector("#DataTables_Table_0_filter input");
                    if (searchInput11) {
                        const searchValue = sessionStorage.getItem("searchText");
                        if (searchValue) {
                            searchInput11.value = searchValue.split(",")[0]
                            searchInput11.dispatchEvent(new KeyboardEvent('keyup', {
                                    'key': 'Enter'
                                }

                            ));
                            sessionStorage.removeItem("searchText");
                            // Do something with the input element
                        }
                        clearInterval(intervalId); // Stop checkin

                    }
                }
                const intervalId = setInterval(checkInputAvailability, 100); // Check every second

            });
        </script>
</body>

</html>
