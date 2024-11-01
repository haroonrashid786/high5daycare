@extends('layouts.app')
@section('title', 'Activity Sheets | High5 Daycare')
@section('content')

<style>
    .ki-tablet-book:before{
        color: #557B43 !important;
    }
    .me-5{
        width: 200px;
    }
    
    @media screen and (max-width: 770px) {
        .me-5{
            width: auto;
        } 
    }
    
    .w-auto{
        width: auto !important;
    }
</style>

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
                            <span>Activity Sheets</span>
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
                        <li class="breadcrumb-item text-white">Activity Sheets</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
                
                @role('Admin','Franchise')
                <!--begin::Actions-->
                <div class="d-flex align-self-center flex-center flex-shrink-0">
                    <a href="{{route('activity.suggesstions')}}" class="btn btn-sm btn-dark ms-3 px-4 py-3">Activity
                        <span class="d-none d-sm-inline">Suggestions</span></a>
                </div>
                <!--end::Actions-->
                @endrole

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">

            @role('Franchise')
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
                            <form class="form" action="{{route('provider.add.activity')}}" method="POST" enctype="multipart/form-data" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Add Activity Sheets</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">
                                    <!--begin::Input group-->

                                    <!--end::Input group-->

                                    <div class="row row-cols-lg-1 g-10">

                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-4 fw-semibold mb-2 required">Select Date</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="date" placeholder="Pick a start date" id="kt_calendar_datepicker_start_date" type="date" value="{{ old('date', date('Y-m-d')) }}" />
                                                @error('date')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <!-- 
                                        <div class="col" data-kt-calendar="datepicker">
                                            <div class="fv-row mb-9">
                                                <label class="fs-4 fw-semibold mb-2 required">Attach a file</label>
                                                <input class="form-control form-control-solid" type="file"
                                                    required="" name="file"/>
                                                    @error('file')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div> -->

                                    </div>
                                    <!--end::Input group-->

                                    <!--end::Input group-->
                                </div>


                                <div class="table-responsive">
                                    @php
                                    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                                    $defaultTypes = ['Cognitive', 'Sensory', 'Story', 'Dramatic Play'];
                                    @endphp
                                    <table class="table" id="activitiesTable">
                                        <thead>
                                            <tr>
                                                <th class="fw-bold">Activity Type</th>
                                                @foreach($daysOfWeek as $day)
                                                <th class="fw-bold">{{ $day }}</th>
                                                @endforeach
                                                <th class="fw-bold">Activities Adjustment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($defaultTypes as $dT) <tr>
                                                <td>
                                                    <input class="form-control form-control-solid" type="text" name="activity_type[]" value="{{ $dT }}" readonly>
                                                </td>
                                                @foreach($daysOfWeek as $day)
                                                <td>
                                                    <input class="form-control form-control-solid" type="text" name="{{ strtolower($day) }}_activities[]" required placeholder="Enter details">
                                                </td>
                                                @endforeach
                                                <td>
                                                    <input class="form-control form-control-solid" type="text" name="activities_adjustment[]" placeholder="Enter activities adjustment">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-row" style="display: none;">X</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-primary add-row" style="display: none;">Add More</button>
                                </div>

                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-right">
                                    <!--begin::Button-->
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_add_event_submit" class="btn btn-primary">
                                        <span class="indicator-label">Create New</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
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
            @endrole

            <!--begin::Row-->


            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::List widget 23-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class=" p-7 pb-0  d-block">

                            <form action="{{ route('activity-sheets') }}" class="w-100" method="GET">
                                <div class="d-flex flex-column flex-sm-row align-items-center gap-4 gap-sm-0  w-100 ">
                                    <div class="d-flex flex-column flex-sm-row align-items-center gap-4 gap-sm-0">

                                        <!-- Search Filter --> 
                                        @role('Admin')
                                        <div class="me-3 w-100">
                                            <label for="search" class="form-label">Search:</label>
                                            <input type="text" for="search" name="search_text" class="form-control" placeholder="Search..." value="{{ Request('search_text') }}">
                                        </div>
                                        @endrole
                                        <!-- Start Date Filter -->
                                        <div class="me-3 w-100">
                                        <label for="start_date" class="form-label">Start Date:</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ Request('start_date') }}">
                                        </div>
                                    <!-- End Date Filter -->
                                    <div class="me-3 w-100">
                                        <label for="end_date" class="form-label">End Date:</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ Request('end_date') }}">
                                    </div>
                                    </div>
                                    <!-- Apply Filter Button -->
                                    <div class="align-self-md-end me-3">
                                        <button type="submit" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </form>

                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Activity Sheets Data</span>
                            </h3>
                            <!--end::Title-->

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-4">
                            <!--begin::Items-->
                            <div class="">
                                @if(isset($sheets) && !empty($sheets) && count($sheets) > 0)
                                @foreach($sheets as $sheet)
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-5">
                                        <!--begin::Flag-->

                                        <!--end::Flag-->
                                        <!--begin::Content-->
                                        <div class="me-5">
                                            <!--begin::Title-->
                                            <a href="{{route('activity-sheet.show', ['id' => $sheet->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Date: <br> {{$sheet->date->format('d-m-Y')}}</a>
                                        </div>
                                        <!--end::Content-->
                                    </div>

                                    <!--begin::Section-->
                                    @role('Admin')
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="me-5">
                                                <p class="text-gray-800 fw-bold text-hover-primary text-left fs-6">Provider:
                                                    {{optional($sheet->provider)->name}}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                    @endrole

                                    <div class="d-flex align-items-center">
                                        <!--begin::Number-->
                                        <!--end::Number-->
                                        <!--begin::Info-->
                                        <a href="{{route('activity-sheet.show', ['id' => $sheet->id])}}" class="btn btn-sm btn-light">
                                            <i class="ki-outline ki-tablet-book fs-1"></i>View</a>
                                        <!--end::Info-->
                                    </div>

                                    @role('Franchise')
                                    <div class="d-flex align-items-center">
                                        <!--begin::Number-->
                                        <!--end::Number-->
                                        <!--begin::Info-->

                                        <!-- <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_create_project"> <i
                                                class="ki-outline ki-pencil fs-1"></i> Edit</a> -->

                                        <a style="background-color:#eb5c2d" class="btn btn-sm btn-danger" onclick="confirmDelete()"> <i class="ki-outline ki-trash fs-1" style="color:white !important ;"></i>Delete</a>
                                        <form id="delete-activity" action="{{route('provider.delete.activity',['id' => $sheet->id])}}" method="post" style="display: none;">
                                            @csrf
                                        </form>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Wrapper-->
                                    @endrole
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->
                                @endforeach

                                @else
                                @include('layouts.partials.no-result')
                                @endif

                            </div>
                            @include('layouts.partials.custom_pagination', ['paginator' => $sheets])
                            <!--end::Items-->
                        </div>

                        <!--end: Card Body-->
                    </div>
                    <!--end::List widget 23-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->

            <!--end::Row-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.getElementById('activitiesTable');
        const addRowButton = document.querySelector('.add-row');

        addRowButton.addEventListener('click', function() {
            const row = table.querySelector('tbody tr:last-child').cloneNode(true);
            table.querySelector('tbody').appendChild(row);
            const removeRowButton = row.querySelector('.remove-row');
            console.log(removeRowButton);
            removeRowButton.style.display = 'inline';
            removeRowButton.addEventListener('click', function() {
                table.querySelector('tbody').removeChild(row);
            });
        });
    });
</script>

<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user clicks "Yes", submit the form
                document.getElementById('delete-activity').submit();
            }
        });
    }
</script>
@endsection