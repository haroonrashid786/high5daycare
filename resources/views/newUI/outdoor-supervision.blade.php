@extends('layouts.app')
@section('title', 'Outdoor Supervision | High5 Daycare')
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
                            <span>Outdoor Supervision</span>
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
                        <li class="breadcrumb-item text-white">Outdoor Supervision</li>
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
                        <!--begin::Card body-->
                        <div class="card-body align-items-end">
                            <!--begin::Wrapper-->
                            <form class="form" action="{{route('add.kid.supervision',['kid' => $kid->id])}}" method="POST" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Outdoor Supervision Plan</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">

                                    <div class="m-12">
                                        <div class="row row-cols-1 row-cols-md-2 g-10 mb-12">

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Child's Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('child_name', optional($kid->supervision)->child_name) }}" name="child_name" />
                                                    @error('child_name')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Child's Care Provider's Name:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('child_provider_name', optional($kid->supervision)->child_provider_name) }}" name="child_provider_name" />
                                                    @error('child_provider_name')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Child's Care Provider's Address:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('child_provider_address', optional($kid->supervision)->child_provider_address) }}" name="child_provider_address" />
                                                    @error('child_provider_address')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <!--end::Input-->
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row row-cols-lg-2 g-10">
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <label class="required fs-6 fw-semibold mb-2">Approved methods of transportation</label>
                                                    <select class="form-select form-select-solid vehicle_method" data-control="select2" data-hide-search="true" data-placeholder="Select a Team Member" name="transportation_method">
                                                        <option value="vehicle" @if(old('transportation_method') == 'vehicle') selected @endif {{ old('transportation_method', optional($kid->supervision)->transportation_method == 'vehicle' ? 'selected' : '') }} >Vehicle</option>
                                                        <option value="walking" @if(old('transportation_method') == 'walking') selected @endif  {{ old('transportation_method', optional($kid->supervision)->transportation_method == 'walking' ? 'selected' : '') }} >Walking</option>
                                                        <option value="other" @if(old('transportation_method') == 'other') selected @endif  {{ old('transportation_method', optional($kid->supervision)->transportation_method == 'other' ? 'selected' : '') }}>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row row-cols-2 mt-8 vehicle">
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Model
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="vehicle_model" placeholder="" value="{{ old('vehicle_model', optional($kid->supervision)->vehicle_model) }}">
                                                @error('vehicle_model')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                            </div>
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Year
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="vehicle_year" placeholder="" value="{{ old('vehicle_year', optional($kid->supervision)->vehicle_year) }}">
                                                @error('vehicle_year')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                            </div>
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Color
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="vehicle_color" placeholder="" value="{{ old('vehicle_color', optional($kid->supervision)->vehicle_color) }}">
                                                @error('vehicle_color')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="row mt-8 other {{ old('transportation_method', optional($kid->supervision)->transportation_method) !== 'other' ? 'd-none' : '' }}">
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <div class="d-flex flex-column mb-8">
                                                    <label class="fs-6 fw-semibold mb-2">Please Specify</label>
                                                    <textarea class="form-control form-control-solid" rows="3" name="other_details" placeholder="Type Please Specify">{{ old('other_details', optional($kid->supervision)->other_details) }}</textarea>
                                                    @error('other_details')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="rounded p-4 border mb-6">
                                            <div class="row row-cols-lg-2 mt-6">
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="required fs-6 fw-semibold mb-2 text-nowrap">Name of Location (1)</label>
                                                        <input type="text" class="form-control form-control-solid" name="location_name" placeholder="" value="{{ old('location_name', optional($kid->supervision)->location_name) }}">
                                                        @error('location_name')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="required fs-6 fw-semibold mb-2 text-nowrap">Address of Location (1)</label>
                                                        <input type="text" class="form-control form-control-solid" name="location_address" placeholder="" value="{{ old('location_address', optional($kid->supervision)->location_address) }}">
                                                        @error('location_address')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="required fs-6 fw-semibold mb-2 text-nowrap">Means of transport used (1)</label>
                                                        <input type="text" class="form-control form-control-solid" name="means_of_transport" placeholder="" value="{{ old('means_of_transport', optional($kid->supervision)->means_of_transport) }}">
                                                        @error('means_of_transport')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-cols-lg-2 mt-6">
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Name of Location (2)</label>
                                                        <input type="text" class="form-control form-control-solid" name="location_name_2" placeholder="" value="{{ old('location_name_2', optional($kid->supervision)->location_name_2) }}">
                                                        @error('location_name_2')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class=" fs-6 fw-semibold mb-2 text-nowrap">Address of Location (2)</label>
                                                        <input type="text" class="form-control form-control-solid" name="location_address_2" placeholder="" value="{{ old('location_address_2', optional($kid->supervision)->location_address_2) }}">
                                                        @error('location_address_2')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class=" fs-6 fw-semibold mb-2 text-nowrap">Means of transport used (2)</label>
                                                        <input type="text" class="form-control form-control-solid" name="means_of_transport_2" placeholder="" value="{{ old('means_of_transport_2', optional($kid->supervision)->means_of_transport_2) }}">
                                                        @error('means_of_transport_2')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-cols-lg-2 mt-6">
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Name of Location (3)</label>
                                                        <input type="text" class="form-control form-control-solid" name="location_name_3" placeholder="" value="{{ old('location_name_3', optional($kid->supervision)->location_name_3) }}">
                                                        @error('location_name_3')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Address of Location (3)</label>
                                                        <input type="text" class="form-control form-control-solid" name="location_address_3" placeholder="" value="{{ old('location_address_3', optional($kid->supervision)->location_address_3) }}">
                                                        @error('location_address_3')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Means of transport used (3)</label>
                                                        <input type="text" class="form-control form-control-solid" name="means_of_transport_3" placeholder="" value="{{ old('means_of_transport_3', optional($kid->supervision)->means_of_transport_3) }}">
                                                        @error('means_of_transport_3')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-cols-lg-2 mt-6">
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Name of Location (4)</label>
                                                        <input type="text" class="form-control form-control-solid" name="location_name_4" placeholder="" value="{{ old('location_name_4', optional($kid->supervision)->location_name_4) }}">
                                                        @error('location_name_4')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Address of Location (4)</label>
                                                        <input type="text" class="form-control form-control-solid" name="location_address_4" placeholder="" value="{{ old('location_address_4', optional($kid->supervision)->location_address_4) }}">
                                                        @error('location_address_4')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Means of transport used (4)</label>
                                                        <input type="text" class="form-control form-control-solid" name="means_of_transport_4" placeholder="" value="{{ old('means_of_transport_4', optional($kid->supervision)->means_of_transport_4) }}">
                                                        @error('means_of_transport_4')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-cols-lg-2 mt-6">
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Name of Location (5)</label>
                                                        <input type="text" class="form-control form-control-solid" name="location_name_5" placeholder="" value="{{ old('location_name_5', optional($kid->supervision)->location_name_5) }}">
                                                        @error('location_name_5')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Address of Location (5)</label>
                                                        <input type="text" class="form-control form-control-solid" name="location_address_5" placeholder="" value="{{ old('location_address_5', optional($kid->supervision)->location_address_5) }}">
                                                        @error('location_address_5')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Means of transport used (5)</label>
                                                        <input type="text" class="form-control form-control-solid" name="means_of_transport_5" placeholder="" value="{{ old('means_of_transport_5', optional($kid->supervision)->means_of_transport_5) }}">
                                                        @error('means_of_transport_5')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-cols-lg-2 mt-6">
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Name of Location (6)</label>
                                                        <input type="text" class="form-control form-control-solid" name="location_name_6" placeholder="" value="{{ old('location_name_6', optional($kid->supervision)->location_name_6) }}">
                                                        @error('location_name_6')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Address of Location (6)</label>
                                                        <input type="text" class="form-control form-control-solid" name="location_address_6" placeholder="" value="{{ old('location_address_6', optional($kid->supervision)->location_address_6) }}">
                                                        @error('location_address_6')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fv-row mt-3">
                                                        <label class="fs-6 fw-semibold mb-2 text-nowrap">Means of transport used (6)</label>
                                                        <input type="text" class="form-control form-control-solid" name="means_of_transport_6" placeholder="" value="{{ old('means_of_transport_6', optional($kid->supervision)->means_of_transport_6) }}">
                                                        @error('means_of_transport')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row row-cols-lg-2 mt-6">

                                            <div class="col">
                                                <div class="fv-row mt-3">
                                                    <label class="required fs-6 fw-semibold mb-2">Child Care Provider’s Sign</label>
                                                    <input type="text" class="form-control form-control-solid" name="child_care_provider_sign" placeholder="" value="{{ old('child_care_provider_sign', optional($kid->supervision)->child_care_provider_sign) }}">
                                                    @error('child_care_provider_sign')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row mt-3">
                                                    <label class="required fs-6 fw-semibold mb-2">Date</label>
                                                    <input type="date" class="form-control form-control-solid" name="child_care_provider_sign_date" placeholder="" value="{{ old('child_care_provider_sign_date', optional($kid->supervision)->child_care_provider_sign_date ? date('Y-m-d', strtotime(optional($kid->supervision)->child_care_provider_sign_date)) : '') }}">
                                                    @error('child_care_provider_sign_date')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row mt-3">
                                                    <label class="required fs-6 fw-semibold mb-2">Parent/Guardian’s Sign</label>
                                                    <input type="text" class="form-control form-control-solid" name="parent_guardian_sign" placeholder="" value="{{ old('parent_guardian_sign', optional($kid->supervision)->parent_guardian_sign) }}">
                                                    @error('parent_guardian_sign')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row mt-3">
                                                    <label class="required fs-6 fw-semibold mb-2">Date</label>
                                                    <input type="date" class="form-control form-control-solid" name="parent_guardian_sign_date" placeholder="" value="{{ old('parent_guardian_sign_date', optional($kid->supervision)->parent_guardian_sign_date ? date('Y-m-d', strtotime(optional($kid->supervision)->parent_guardian_sign_date)) : '') }}">
                                                    @error('parent_guardian_sign_date')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <!--end::Modal body-->
                                @role('Parent','Franchise')
                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-right">
                                    <!--begin::Button-->
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_add_event_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
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
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            $('.vehicle_method').on('select2:select', function(e) {
                let val = e.target.value;
                let vehicle = document.querySelector('.vehicle');
                let other = document.querySelector('.other');

                if (val == 'vehicle') {
                    vehicle.classList.remove('d-none')
                    other.classList.add('d-none')
                }

                if (val == 'other') {
                    vehicle.classList.add('d-none')
                    other.classList.remove('d-none')
                }

                if (val == 'walking') {
                    vehicle.classList.add('d-none')
                    other.classList.add('d-none')
                }

            });
        }, 0);
    })
</script>


@endsection