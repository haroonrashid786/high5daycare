<html>

<head>
    <base href="" />
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link rel="icon" href="{{ asset('assets/media/logos/favicon.png') }}">
    <link href="{{ asset('/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}?v={{ rand(0, 99) }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/plugins/custom/datatables/datatables.bundle.css') }}?v={{ rand(0, 99) }}"
        rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('/assets/plugins/global/plugins.bundle.css') }}?v={{ rand(0, 99) }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/css/style.bundle.css') }}?v={{ rand(0, 99) }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <style type="text/css">
        .btn.btn-primary {

            background-color: #557b43 !important;
        }

        .ki-duotone,
        .ki-outline,
        .ki-solid {

            color: #fff !important;
        }

        .hover-delete {
            position: relative;
        }

        .hover-delete:hover::after {
            display: flex;
        }

        .hover-delete::after {
            content: "x";
            font-weight: 900;
            position: absolute;
            top: 50%;
            right: 50%;
            font-size: 20px;
            cursor: pointer;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            justify-content: center;
            align-items: center;
            background-color: white;
            color: red;
            display: none;
            transform: translate(50%, -50%);
        }
        body{
            background: white;
        }

        .export-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }


        .header_main_container {
            height:350px;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 1;
            background: linear-gradient(rgba(0, 0, 0,.8), rgba(255, 255, 255,0.1),rgba(255, 255, 255,0.1)), url("{{asset('assets/media/main-bg.png')}}");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }



        @media screen and (max-width: 992px) {
            .header_main_container {
                height: 250px;
            }

        }
        @media screen and (max-width: 400px) {
            .header_main_container {
                height: 270px;
            }
        }


    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/node-snackbar@latest/src/js/snackbar.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/node-snackbar@latest/dist/snackbar.min.css" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    class="app-default">



    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Wrapper container-->
            <div class="header_main_container">

            </div>
            @include('layouts.partials.header')
            <!--begin::Wrapper container-->
            @unless(in_array(Request::route()->getName(), ['login', 'auth.login',  'base', 'password.request', 'password.reset']))
            @include('layouts.partials.sidebar')
            @endunless
            <!-- start::MAIN -->
            @yield('content')
            <!-- end::MAIN -->

            @role('Admin')
            @include('layouts.partials.notes')
            @endrole


        </div>
    </div>
    </div>
    </div>





    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i>
    </div>

    @include('layouts.partials.overlay')
</body>



<!--begin::Javascript-->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    var hostUrl = "assets/";

</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<!-- <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script> -->
<script src="{{ asset ('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/new-target.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!--end::Custom Javascript-->
<!--end::Javascript-->



<script>
    $(document).ready(function () {
        // Check if a success or error message is present in the session
        var successMessage = '{{ Session::get("success") }}';
        var errorMessage = '{{ Session::get("error") }}';

        if (successMessage !== '') {
            Snackbar.show({
                pos: 'bottom-center',
                text: successMessage,
                backgroundColor: '#556d33',
                actionTextColor: '#fff',
                duration: 100000,
            });
        }

        if (errorMessage !== '') {
            Snackbar.show({
                pos: 'bottom-center',
                text: errorMessage,
                backgroundColor: '#ea6f44',
                actionTextColor: '#fff',
                duration: 100000,
            });
        }

    });


</script>

<script>
    document.getElementById('exportBtn').addEventListener('click', function () {
        // Get table data as an array
        var data = [];
        var table = document.querySelector('table');
        var rows = table.querySelectorAll('tr');
        rows.forEach(function (row) {
            var rowData = [];
            row.querySelectorAll('td, th').forEach(function (cell) {
                rowData.push(cell.innerText);
            });
            data.push(rowData);
        });

        // Create a new workbook
        var workbook = XLSX.utils.book_new();
        var worksheet = XLSX.utils.aoa_to_sheet(data);

        // Add the worksheet to the workbook
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');

        // Save the workbook as an Excel file
        XLSX.writeFile(workbook, 'ledgers_data.xlsx');
    });
</script>
@yield('script')
</html>
