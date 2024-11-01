@extends('layouts.app')
@section('title', 'Meals | High5 Daycare')
@section('content')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar d-flex pb-3 pb-lg-5">
            <!--begin::Toolbar container-->
            <div class="d-flex flex-stack flex-row-fluid">
                <!--begin::Toolbar container-->
                <div class="d-flex flex-column flex-row-fluid">
                    <!--begin::Toolbar wrapper-->
                    <!--begin::Page title-->
                    <div class="page-title d-flex align-items-center me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-white fw-bold fs-lg-3x gap-2">
                            <span>Meals</span>
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-[#fff] fw-bold lh-1">
                            <a @role('Admin') href="{{ route('admin.home') }}" @elserole('Franchise') href="{{ route('provider.home') }}" @else href="{{ route('parent.home') }}" @endrole class="text-white text-hover-primary">
                                 <img src="{{asset('assets/media/Home.svg')}}" class="" alt="" />
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <i class="ki-outline ki-right fs-7 text-[#fff] mx-n1"></i>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-white">Meals</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
                <!--begin::Actions-->

                <div class="d-flex align-items-center justify-content-lg-center gap-2">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-primary" id="exportButton">Save as CSV</button>
                    </div>
                </div>
                <!--end::Actions-->

                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">

            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
                <!--begin::Col-->
                <div class="col-md-12 mb-xl-10">
                    <!--begin::Card widget 28-->
                    <div class="card card-flush">
                        <!--begin::Header-->

                        <!--end::Card title-->
                        <!--begin::Card body-->
                        <div class="card-body align-items-end">
                            <!--begin::Wrapper-->
                            <form class="form" action="{{route('meal.update',['id' => $meal->id])}}" method="POST" enctype="multipart/form-data" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Meal</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">
                                    <!--begin::Input group-->

                                    <!--end::Input group-->

                                    <div class="row row-cols-lg-2 g-10">

                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-4 fw-semibold mb-2 required">Start Date</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="date" placeholder="Pick a start date" id="meal_date" type="date" value="{{ old('date', $meal->date->format('Y-m-d')) }}" @role('Admin','Parent') readonly @endrole/>
                                                @error('date')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-4 fw-semibold mb-2 required">End Date</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="end_date" placeholder="Pick a end date" id="meal_date" type="date" value="{{ old('end_date', isset($meal->end_date) && !empty($meal->end_date) ? $meal->end_date->format('Y-m-d') : '') }}" @role('Admin','Parent') readonly @endrole/>
                                                @error('end_date')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <!--end::Modal body-->

                                <!-- <div class="py-1 px-lg-10">

                                    <div class="row row-cols-lg-1 g-10">
                                    <div class="col">
                                            <div class="fv-row mb-12">
                                                <label class="fs-4 fw-semibold mb-2 required">Meal Details</label>
                                                <textarea class="form-control form-control-solid"
                                                    required="" name="meal" placeholder="Enter your kid meal details" @role('Admin','Parent') readonly @endrole>{{old('meal', $meal->meal)}}</textarea>
                                                    @error('meal')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>
                                    </div> -->

                                <div class="table-responsive">
                                    @php
                                    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                                    @endphp
                                    <table class="table" id="activitiesTable">
                                        <thead>
                                            @role('Admin')
                                            <tr>
                                                <th colspan="5" class="text-center fw-bold">Provider Name: {{ optional($meal->provider)->name ?? 'Not Available' }}</th>
                                            </tr>
                                            @endrole
                                            <tr>
                                                <th class="fw-bold">Day</th>
                                                <th class="fw-bold">Morning Snack</th>
                                                <th class="fw-bold">Lunch</th>
                                                <th class="fw-bold">Afternoon Snack</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($daysOfWeek as $day)
                                            <tr>
                                                <td class="fw-bold">
                                                    {{$day}}
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-solid" type="text" name="morning_snack[{{ $day }}]" required placeholder="Enter morning snacks" value="{{ old('morning_snack.' . $day,$meal->items->where('day', $day)->first()->morning_snack) }}" @role('Admin','Parent') readonly @endrole>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-solid" type="text" name="lunch[{{ $day }}]" required placeholder="Enter lunch details" value="{{ old('lunch.' . $day, $meal->items->where('day', $day)->first()->lunch) }}" @role('Admin','Parent') readonly @endrole>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-solid" type="text" name="afternoon_snack[{{ $day }}]" required placeholder="Enter afternoon snacks" value="{{ old('afternoon_snack.' . $day, $meal->items->where('day', $day)->first()->afternoon_snack) }}" @role('Admin','Parent') readonly @endrole>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                <!--begin::Modal footer-->
                                @role('Franchise')
                                <div class="modal-footer flex-right">
                                    <!--begin::Button-->
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_add_event_submit" class="btn btn-primary">
                                        <span class="indicator-label">Save</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                @endrole
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 28-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->

                <!--end::Col-->
                <!--begin::Col-->

                <!--end::Col-->
            </div>
            <!--end::Row-->

        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const exportCsvButton = document.getElementById('exportButton');
    exportCsvButton.addEventListener('click', function () {
        exportToCsv();
    });

    function exportToCsv() {
        const mealData = []; // An array to hold meal data
        const daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        const providerName = "Provider Name: " + "{{ $meal->kid->provider->name ?? 'Not Available' }}";
        const mealDate = "Meal Date: " + document.getElementById('meal_date').value;

        // Include the "Provider Name" row
        mealData.push([providerName]);
        mealData.push([mealDate]);

        // Header row with column names
        mealData.push(['Day', 'Morning Snack', 'Lunch', 'Afternoon Snack']);

        // Loop through the table rows and extract the data
        const tableRows = document.querySelectorAll('#activitiesTable tbody tr');
        tableRows.forEach(function (row, index) {
            const rowData = [daysOfWeek[index]]; // Include the day name
            const cells = row.querySelectorAll('td input[type="text"]');
            cells.forEach(function (cell) {
                rowData.push(cell.value);
            });
            mealData.push(rowData);
        });

        // Create a CSV string
        const csvContent = mealData.map(row => row.join(',')).join('\n');

        // Create a blob containing the CSV data
        const blob = new Blob([csvContent], { type: 'text/csv' });

        // Create a URL for the blob
        const url = window.URL.createObjectURL(blob);

        // Create a download link and trigger a click event
        const a = document.createElement('a');
        a.href = url;
        a.download = 'meal_data.csv';
        a.click();

        // Clean up by revoking the URL object
        window.URL.revokeObjectURL(url);
    }
});
</script>


@endsection