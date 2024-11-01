@extends('layouts.app')
@section('title', 'Vacations | High5 Daycare')
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
                        <h1
                            class="page-heading d-flex flex-column justify-content-center text-white fw-bold fs-lg-3x gap-2">
                            <span>Vacations</span>
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
                        <li class="breadcrumb-item text-white">Vacations</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->

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
                        @role('Franchise')
                        <!--begin::Card body-->
                        <div class="card-body align-items-end">
                            <!--begin::Wrapper-->
                            <form class="form" action="{{route('apply.vacation')}}" id="kt_modal_add_event_form" method="POST">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Apply for Vacation</h2>
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
                                                <label class="fs-6 fw-semibold mb-2 required">Start</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="start_date" placeholder=""
                                                id="vacationDate" type="date" value="{{old('start_date',Request('start_date'))}}" required/>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">End</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="end_date" placeholder=""
                                                    id="vacationDateEnd" type="date" value="{{old('end_date',Request('end_date'))}}" required/>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>

                                    <!--end::Input group-->

                                    <!--end::Input group-->
                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-right">
                                    <!--begin::Button-->
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_add_event_submit" class="btn btn-primary">
                                        <span class="indicator-label">Apply</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Card body-->
                        @endrole

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
            <!--begin::Row-->

            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::List widget 23-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Vacations</span>
                            </h3>
                            <!--end::Title-->
                           
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Items-->
                            <div class="">

                            @if(isset($vacations) && !empty($vacations) && count($vacations) > 0)
                                @foreach($vacations as $vacation)
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-5">
                                        <!--begin::Flag-->
                                        <!--end::Flag-->
                                        <!--begin::Content-->
                                        <div class="me-5">
                                            <!--begin::Title-->
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6" target="_blank">Dacare: 
                                                {{ optional($vacation->provider)->name}}</a>
                                            <!--end::Title-->
                                            <!--begin::Desc-->
                                            <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Code:
                                            {{ optional($vacation->provider)->code}}
                                                </span>
                                            <!--end::Desc-->
                                        </div>
                                        <!--end::Content-->
                                    </div>

                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-5">
                                        <!--begin::Flag-->
                                        <!--end::Flag-->
                                        <!--begin::Content-->
                                        <div class="me-5">
                                            <!--begin::Title-->
                                            <div class="col-sm-12">
                                                <!--end::Label-->
                                                <div class="fw-semibold fs-7 text-gray-600 mb-1">Period:</div>
                                                <!--end::Label-->
                                                <!--end::Text-->
                                                <div class="fw-bold fs-6 text-gray-800">{{ $vacation->start_date->format('d M Y') }} | {{ $vacation->end_date->format('d M Y') }}</div>
                                                <!--end::Text-->
                                                <!--end::Description-->
                                                <!-- <div class="fw-semibold fs-7 text-gray-600">
                                                    <br>Code: #</div> -->
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Desc-->
                                            <!--end::Desc-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Number-->
                                        <!--end::Number-->
                                        <!--begin::Info-->
                                        <div class="m-0">
                                            <!--begin::Label-->
                                            <span @if($vacation->status == 0) class="badge badge-light-danger fs-base" @else class="badge badge-light-success @endif>
                                               @if($vacation->status == 0) Pending @else Approved @endif</span>
                                            <!--end::Label-->
                                        </div>

                                        <!--end::Info-->
                                    </div>

                                    @role('Admin')
                                    <div class="d-flex align-items-center">

                                        <div>
                                            <select class="form-control form-control-solid custom_search"
                                                required="" name="alternate_provider_id" data-control="select2" data-hide-search="false">
                                                @if(isset($providers) && !empty($providers) && count($providers) > 0)
                                                <option>Select Alternate Provider</option>
                                                @foreach($providers as $provider)
                                                <option value="{{$provider->id}}" @if(old('provider_id') == $provider->id) selected @endif>{{$provider->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                                @error('provider_id')
                                                <div style="color: red;">
                                                {{ $message }}
                                                </div>
                                                @enderror
                                        </div>

                                        <a href="#" class="btn btn-sm btn-success m-1">Approve</a>
                                        <a href="#" class="btn btn-sm btn-danger m-1">Decline</a>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Item-->
                                @endrole


                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->
                                @endforeach
                                @else
                                @include('layouts.partials.no-result')
                                @endif

                            </div>
                            <!--end::Items-->
                            @include('layouts.partials.custom_pagination', ['paginator' => $vacations])


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

    var disabledDates = <?php echo json_encode($vacations->pluck('start_date')->concat($vacations->pluck('end_date'))->toArray()); ?>;

    // Convert the dates to YYYY-MM-DD format
    disabledDates = disabledDates.map(function(date) {
        return new Date(date).toISOString().split('T')[0];
    });

    // Add the current week's dates to the disabledDates array
    var currentDate = new Date();
    var currentWeekStart = new Date('<?php echo $currentWeekStart; ?>');
    var currentWeekEnd = new Date('<?php echo $currentWeekEnd; ?>');

    while (currentWeekStart <= currentWeekEnd) {
        disabledDates.push(currentWeekStart.toISOString().split('T')[0]);
        currentWeekStart.setDate(currentWeekStart.getDate() + 1);
    }

    document.getElementById('vacationDate').addEventListener('input', function() {
        if (disabledDates.includes(this.value)) {
            this.value = ''; // Clear the input if the selected date is disabled
            Snackbar.show({
            pos: 'bottom-center',
            text: 'These dates are occupied, select another',
            backgroundColor: '#ea6f44',
            actionTextColor: '#fff'
        });
        }
    });

    
    document.getElementById('vacationDateEnd').addEventListener('input', function() {
        if (disabledDates.includes(this.value)) {
            this.value = ''; // Clear the input if the selected date is disabled
            Snackbar.show({
            pos: 'bottom-center',
            text: 'These dates are occupied, select another',
            backgroundColor: '#ea6f44',
            actionTextColor: '#fff'
        });
        }
    });
</script>
@endsection
