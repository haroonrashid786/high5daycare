@extends('layouts.app')
@section('title', 'Activity Sheet | High5 Daycare')
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
                            <span>Activity Sheet</span>
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-[#fff] fw-bold lh-1">
                            <a @role('Admin') href="{{ route('admin.home') }}" @elserole('Franchise') href="{{ route('provider.home') }}" @else href="{{ route('parent.home') }}" @endrole class="text-white text-hover-primary">
                                <i class="ki-outline ki-home text-[#fff] fs-6"></i>
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
                <!--begin::Actions-->

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
                            <form class="form" action="{{route('provider.update.activity', ['id' => $activitySheet->id])}}" method="POST" enctype="multipart/form-data" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Activity Sheet</h2>
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
                                                <label class="fs-4 fw-semibold mb-2 required">Date</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="date" placeholder="Pick a start date" id="kt_calendar_datepicker_start_date" type="date" value="{{ old('date', $activitySheet->date->format('Y-m-d')) }}" @role('Admin','Parent') readonly @endrole/>
                                                @error('date')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Input-->
                                            </div>
                                        </div>

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
                                            @foreach ($activitySheet->activities as $activity)
                                            <tr>
                                                <td>
                                                    <input class="form-control form-control-solid" type="text" name="activity_type[]" value="{{ $activity->activity_type }}" @role('Admin','Parent','Franchise') readonly @endrole>
                                                </td>
                                                @foreach($daysOfWeek as $day)
                                                <td>
                                                    <input class="form-control form-control-solid" type="text" name="{{ strtolower($day) }}_activities[]" placeholder="Enter details" value="{{ $activity->{strtolower($day) . '_activities'} }}" required @role('Admin','Parent') readonly @endrole>
                                                </td>
                                                @endforeach
                                                <td>
                                                    <input class="form-control form-control-solid" type="text" name="activities_adjustment[]" value="{{ $activity->activities_adjustment }}" placeholder="Enter activities adjustment" @role('Admin','Parent') readonly @endrole>
                                                </td>

                                            @role('Franchise')
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-row" style="display: none;">X</button>
                                                </td>
                                            @endrole
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @role('Franchise')
                                    <button type="button" class="btn btn-primary add-row" style="display: none;">Add More</button>
                                    @endrole

                                </div>

                                <!--end::Modal body-->
                                @role('Franchise')
                                <!--begin::Modal footer-->
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
                                <!--end::Modal footer-->
                                @endrole
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
@endsection