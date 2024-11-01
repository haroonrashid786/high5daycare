@extends('layouts.app')
@isset($provider)
@section('title', 'Edit Provider | Admin | High5 Daycare')
@else
@section('title', 'Add Provider | Admin | High5 Daycare')
@endisset
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
                            <span>Providers</span>
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
                        <li class="breadcrumb-item text-white">@isset($provider) Edit Provider @else Add provider @endisset</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Actions-->


            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <form method="POST" @isset($provider) action="{{ route('admin.update.provider',['id' => $provider->id]) }}" @else action="{{ route('admin.insert.provider') }}" @endisset enctype="multipart/form-data" id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Row-->
            @csrf


            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::List widget 23-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Items-->
                            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                                <!--begin::Heading-->
                                <div class="mb-13 text-center">
                                    <!--begin::Title-->
                                    <h1 class="mb-3"> @isset($provider) Edit @else Add @endisset Provider Details</h1>
                                    <!--end::Title-->
                                    <!--begin::Description-->

                                    <!--end::Description-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Name</label>
                                        <input type="text" class="form-control form-control-solid" name="name" value="{{ isset($provider) ? $provider->name : old('name') }}" placeholder="Enter provider name">
                                        @error('name')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Phone Number</label>
                                        <div class="bg-gray-100 rounded d-flex align-items-center">
                                            <div class="px-5 fw-bold">+1</div>
                                            <input type="number" class="form-control form-control-solid" name="phone_number" value="{{ isset($provider) ? $provider->phone_number : old('phone_number') }}" placeholder="Enter phone number">
                                        </div>
                                        @error('phone_number')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Email</label>
                                        <input type="email" class="form-control form-control-solid" name="email" value="{{ isset($provider) ? $provider->email : old('email') }}" placeholder="Enter email">
                                        @error('email')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Address</label>
                                        <input type="text" class="form-control form-control-solid" name="address" value="{{ isset($provider) ? $provider->address : old('address') }}" placeholder="Enter address">
                                        @error('address')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <div class="row g-9 mb-8">

                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Country</label>
                                        <input type="text" class="form-control form-control-solid" name="country" value="{{ isset($provider) ? $provider->country : (old('country', 'Canada')) }}" placeholder="Enter country">
                                        @error('country')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">State</label>
                                        <input type="text" class="form-control form-control-solid" name="state" value="{{ isset($provider) ? $provider->state : old('state') }}" placeholder="Enter state">
                                        @error('state')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->

                                </div>

                                <div class="row g-9 mb-8">
                                    <!-- <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Logo</label>
                                        <input type="file" class="form-control form-control-solid" name="logo">
                                        @if(isset($provider) && (!empty($provider->logo)))
                                        <a href="{{url($provider->logo)}}" target="_blank">View File</a>
                                        @endif

                                        @error('logo')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div> -->
                                    <!--end::Col-->

                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Joining Date</label>
                                        <input type="date" class="form-control form-control-solid" name="joining_date" placeholder="Enter postal code" @isset($provider) value="{{ isset($provider->joining_date) ? date('Y-m-d', strtotime($provider->joining_date)) : old('joining_date') }}" @endisset>
                                        @error('joining_date')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Postal Code</label>
                                        <input type="text" class="form-control form-control-solid" name="postal_code" placeholder="Enter postal code" value="{{ isset($provider) ? $provider->postal_code : old('postal_code') }}">
                                        @error('postal_code')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Password</label>
                                        <div class="d-flex justify-content-between align-items-center form__parent__div gap-5">
                                            <input type="password" id="password" class="form-control form-control-solid" name="password">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="passwordEye" onclick="togglePasswordVisibility('password', 'passwordEye')" height="16" width="18" viewBox="0 0 576 512">
                                                <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                            </svg>
                                        </div>
                                        @error('password')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Confirm Password</label>
                                        <div class="d-flex justify-content-between align-items-center form__parent__div gap-5">
                                            <input type="password" id="confirm_password" class="form-control form-control-solid" name="password_confirmation">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="crfPasswordEye" onclick="togglePasswordVisibility('confirm_password', 'crfPasswordEye')" height="16" width="18" viewBox="0 0 576 512">
                                                <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                            </svg>
                                        </div>
                                        @error('password_confirmation')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">


                                    <!-- <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Location Link</label>
                                        <input type="text" class="form-control form-control-solid" name="location_link" placeholder="Enter location link" value="{{ isset($provider) ? $provider->location_link : old('location_link') }}">
                                        @error('location_link')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div> -->
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">THRC Membership Num</label>
                                        <input type="text" class="form-control form-control-solid" name="thrc_membership_num" placeholder="Enter THRC Membership Num" value="{{ isset($provider) ? $provider->thrc_membership_num : old('thrc_membership_num') }}">
                                        @error('thrc_membership_num')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                <!--end::Input group-->

                                <div class="row g-9 mb-8">

                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2 required">Infant Rate</label>
                                        <input type="number" step="0.01" class="form-control form-control-solid" name="infant_percentage" placeholder="Enter infant rate" value="{{ isset($provider) ? $provider->infant_percentage : old('infant_percentage') }}">
                                        @error('infant_percentage')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2 required">Toddler Rate</label>
                                        <input type="number" step="0.01" class="form-control form-control-solid" name="toddler_percentage" placeholder="Enter toddler rate" value="{{ isset($provider) ? $provider->toddler_percentage : old('toddler_percentage') }}">
                                        @error('toddler_percentage')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2 required">Pre School Rate</label>
                                        <input type="number" step="0.01" class="form-control form-control-solid" name="pre_school_percentage" placeholder="Enter pre schoolers rate" value="{{ isset($provider) ? $provider->pre_school_percentage : old('pre_school_percentage') }}">
                                        @error('pre_school_percentage')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                                <div class="row g-9 mb-8">

                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2 required">GOG Funding</label>
                                        <input type="number" step="0.01" class="form-control form-control-solid" name="ministry_funding" placeholder="Enter GOG funding" value="{{ isset($provider) ? $provider->ministry_funding : old('ministry_funding') }}">
                                        @error('ministry_funding')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2 required">HCEG Funding</label>
                                        <input type="number" step="0.01" class="form-control form-control-solid" name="hceg_funding" placeholder="Enter HCEG funding" value="{{ isset($provider) ? $provider->hceg_funding : old('hceg_funding') }}">
                                        @error('hceg_funding')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Program Statement Signature</label>
                                        <input type="file" class="form-control form-control-solid" name="program_statement_signature">
                                        @if(isset($provider->program_statement_signature) && (!empty($provider->program_statement_signature)))
                                        <a href="{{url($provider->program_statement_signature)}}" target="_blank">View File</a>
                                        @endif
                                        @error('program_statement_signature')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Behavioral managements signature</label>
                                        <input type="file" class="form-control form-control-solid" name="behavioral_managements_signature">
                                        @if(isset($provider->behavioral_managements_signature) && (!empty($provider->behavioral_managements_signature)))
                                        <a href="{{url($provider->behavioral_managements_signature)}}" target="_blank">View File</a>
                                        @endif
                                        @error('behavioral_managements_signature')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Provider responsibility signature</label>
                                        <input type="file" class="form-control form-control-solid" name="provider_responsibility_signature">
                                        @if(isset($provider->provider_responsibility_signature) && (!empty($provider->provider_responsibility_signature)))
                                        <a href="{{url($provider->provider_responsibility_signature)}}" target="_blank">View File</a>
                                        @endif
                                        @error('provider_responsibility_signature')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                <!--end::Input group-->


                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-8">
                                    <label class="fs-6 fw-semibold mb-2">Bank Details</label>
                                    <textarea class="form-control form-control-solid" rows="3" name="bank_details" placeholder="Add bank details" value="{{ isset($provider) ? $provider->bank_details : old('bank_details') }}">{{ isset($provider) ? $provider->bank_details : old('bank_details') }}</textarea>
                                    @error('bank_details')
                                    <div style="color: red;">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->

                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="d-flex flex-stack mb-8">
                                    <!--begin::Label-->
                                    <div class="me-5">
                                        <label class="fs-6 fw-semibold">Status</label>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" name="status" @if(isset($provider) && $provider->status == 1) checked="checked" @elseif(isset($provider) && $provider->status == 0) @else checked="checked" @endif>
                                        <span class="form-check-label fw-semibold text-muted">Active</span>
                                    </label>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->


                                <!-- Provider Document Section -->
                                <div class="card-body border-top p-9">
                                    <div class="content">
                                        <h1 class="mb-10">Documents</h1>
                                    </div>
                                    <div class="row row-cols-lg-2 g-10">

                                        <div class="col">
                                            <div class="fv-row ">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Fire Inspection Certificate</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="fire_inspection_certificate">
                                                @if(isset($provider->fire_inspection_certificate) && (!empty($provider->fire_inspection_certificate)))
                                                <a href="{{url($provider->fire_inspection_certificate)}}" target="_blank">View File</a>
                                                @endif

                                                @error('fire_inspection_certificate')
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
                                                <label class="fs-6 fw-semibold mb-2">Health Assessment Certificate</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="health_assessment_certificate">
                                                @if(isset($provider->health_assessment_certificate) && (!empty($provider->health_assessment_certificate)))
                                                <a href="{{url($provider->health_assessment_certificate)}}" target="_blank">View File</a>
                                                @endif

                                                @error('health_assessment_certificate')
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
                                                <label class="fs-6 fw-semibold mb-2">CPR</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="cpr">
                                                @if(isset($provider->cpr) && (!empty($provider->cpr)))
                                                <a href="{{url($provider->cpr)}}" target="_blank">View File</a>
                                                @endif

                                                @error('cpr')
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
                                                <label class="fs-6 fw-semibold mb-2">Police Check</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="police_clearance">
                                                @if(isset($provider->police_clearance) && (!empty($provider->police_clearance)))
                                                <a href="{{url($provider->police_clearance)}}" target="_blank">View File</a>
                                                @endif

                                                @error('police_clearance')
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
                                                <label class="fs-6 fw-semibold mb-2">Fire evacuation Program</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="fire_evacuation_program">
                                                @if(isset($provider->fire_evacuation_program) && (!empty($provider->fire_evacuation_program)))
                                                <a href="{{url($provider->fire_evacuation_program)}}" target="_blank">View File</a>
                                                @endif

                                                @error('fire_evacuation_program')
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
                                                <label class="fs-6 fw-semibold mb-2">Driving license</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="license">
                                                @if(isset($provider->license) && (!empty($provider->license)))
                                                <a href="{{url($provider->license)}}" target="_blank">View File</a>
                                                @endif

                                                @error('license')
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
                                                <label class="fs-6 fw-semibold mb-2">Insurance</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="insurance">
                                                @if(isset($provider->insurance) && (!empty($provider->insurance)))
                                                <a href="{{url($provider->insurance)}}" target="_blank">View File</a>
                                                @endif

                                                @error('insurance')
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
                                                <label class="fs-6 fw-semibold mb-2">Acknowledgment Of Appointment</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="contract">
                                                @if(isset($provider->contract) && (!empty($provider->contract)))
                                                <a href="{{url($provider->contract)}}" target="_blank">View File</a>
                                                @endif

                                                @error('contract')
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
                                                <label class="fs-6 fw-semibold mb-2">Food handler</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="food_handler">
                                                @if(isset($provider->food_handler) && (!empty($provider->food_handler)))
                                                <a href="{{url($provider->food_handler)}}" target="_blank">View File</a>
                                                @endif

                                                @error('food_handler')
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
                                                <label class="fs-6 fw-semibold mb-2">Offence Declaration</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="offence_declaration">
                                                @if(isset($provider->offence_declaration) && (!empty($provider->offence_declaration)))
                                                <a href="{{url($provider->offence_declaration)}}" target="_blank">View File</a>
                                                @endif

                                                @error('offence_declaration')
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
                                                <label class="fs-6 fw-semibold mb-2">Notice of personal information collection</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="notice_of_personal_information_collection">
                                                @if(isset($provider->notice_of_personal_information_collection) && (!empty($provider->notice_of_personal_information_collection)))
                                                <a href="{{url($provider->notice_of_personal_information_collection)}}" target="_blank">View File</a>
                                                @endif

                                                @error('notice_of_personal_information_collection')
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
                                                <label class="fs-6 fw-semibold mb-2">Covid Vaccine</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="covid_vaccine">
                                                @if(isset($provider->covid_vaccine) && (!empty($provider->covid_vaccine)))
                                                <a href="{{url($provider->covid_vaccine)}}" target="_blank">View File</a>
                                                @endif

                                                @error('covid_vaccine')
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
                                                <label class="fs-6 fw-semibold mb-2">Sign of policies</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="sign_of_policies">
                                                @if(isset($provider->sign_of_policies) && (!empty($provider->sign_of_policies)))
                                                <a href="{{url($provider->sign_of_policies)}}" target="_blank">View File</a>
                                                @endif

                                                @error('sign_of_policies')
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
                                                <label class="fs-6 fw-semibold mb-2">Landlord approval letter</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="landlord_approval_letter">
                                                @if(isset($provider->landlord_approval_letter) && (!empty($provider->landlord_approval_letter)))
                                                <a href="{{url($provider->landlord_approval_letter)}}" target="_blank">View File</a>
                                                @endif

                                                @error('landlord_approval_letter')
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
                                                <label class="fs-6 fw-semibold mb-2">Pet Vaccination</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="pet_vaccination">
                                                @if(isset($provider->pet_vaccination) && (!empty($provider->pet_vaccination)))
                                                <a href="{{url($provider->pet_vaccination)}}" target="_blank">View File</a>
                                                @endif

                                                @error('pet_vaccination')
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
                                                <label class="fs-6 fw-semibold mb-2">Additional Certification (if any)</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" type="file" value="" name="additional_certification">
                                                @if(isset($provider->additional_certification) && (!empty($provider->additional_certification)))
                                                <a href="{{url($provider->additional_certification)}}" target="_blank">View File</a>
                                                @endif

                                                @error('additional_certification')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Provider Document Section -->

                                <!-- Provider Profile Images -->
                                <div class="card-body border-top p-9">
                                    <div class="content">
                                        <h1 class="mb-10">Provider Profile</h1>
                                    </div>
                                    <div class="row g-10">
                                        <div class="col">
                                            <div class="fv-row ">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Upload Images</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" id="" multiple type="file" value="" name="provider_images[]">
                                                <!--end::Input-->
                                            </div>
                                            @if(isset($provider->images) && (!empty($provider->images)) && count($provider->images) > 0)
                                            <div>
                                                <h1 class="text-[1.25rem] mb-1 font-semibold">Profile</h1>
                                                <div class="flex items-center gap-2.5 flex-wrap">

                                                    <div class="card-body pt-5">
                                                        <div class="d-flex align-items-center gap-4 flex-wrap viewer">
                                                            @foreach($provider->images as $image)
                                                            <div class="image hover-delete" data-image-id="{{$image->id}}">
                                                                <img src="{{$image->image ? url($image->image) : ''}}" alt="" style="width:14rem;height:14rem;object-fit: cover;" class="rounded cursor-pointer">
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="delete_images" id="delete_images" value="">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Provider Profile Images -->



                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-right " style="text-align: right">
                                    <!-- <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button> -->
                                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
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
        </form>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>

<script>
    const images = document.querySelectorAll('.image');
    const deleteImagesInput = document.getElementById('delete_images');

    images.forEach(image => {
        image.addEventListener('click', () => {
            const imageId = image.getAttribute('data-image-id');
            const deleteImagesValue = (deleteImagesInput.value) != '' ? JSON.parse(deleteImagesInput.value) : '';
            let imageIdsArray = deleteImagesValue ? deleteImagesValue : [];
            console.log(imageIdsArray);
            if (!imageIdsArray.includes(imageId)) {
                imageIdsArray.push(+imageId);
                // deleteImagesInput.value = imageIdsArray.join(',');
                deleteImagesInput.value = JSON.stringify(imageIdsArray);
            }
            // Remove the clicked image from the view
            image.remove();
        });
    });
</script>

<script>
    function togglePasswordVisibility(inputId, eyeIconId) {
        var passwordInput = document.getElementById(inputId);
        var eyeIcon = document.getElementById(eyeIconId);
        console.log(passwordInput, 'passwordInput');
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>
@endsection