@extends('layouts.app')
@role('Admin')
@section('title', 'Settings | Admin | High5 Daycare')
@elserole('Franchise')
@section('title', 'Settings | Provider | High5 Daycare')
@else
@section('title', 'Settings | Parent | High5 Daycare')
@endrole
@section('content')

<style>
    .pl-2{
        padding-left: 10px;
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
                    <div class="page-title d-flex align-items-center me-3 text-white">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-white fw-bold fs-lg-3x gap-2">
                            <span>
                               Welcome back,&nbsp;@auth {{Auth::user()->name}} @endauth</span>
                            <!--begin::Description-->
                            <span class="page-desc text-white fs-lg-3 fw-semibold pl-2">
                                @role('Admin')
                                You are logged in as a Super Admin
                                @elserole('Franchise')
                                You are logged in as a daycare provider: {{Auth::user()->provider->name}}
                                @else
                                You are logged in as a parent: {{Auth::user()->name}}
                                @endrole
                            </span>
                            <!--end::Description-->
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
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






                        <div class="card mb-5 mb-xl-10">
                            <!--begin::Card header-->
                            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">Profile Details</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--begin::Card header-->
                            <!--begin::Content-->
                            <div id="kt_account_settings_profile_details" class="collapse show">
                                <!--begin::Form-->
                                <form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" method="POST" action="{{route('update.profile')}}" enctype="multipart/form-data">
                                    @csrf
                                    <!--begin::Card body-->
                                    <div class="card-body border-top p-9">
                                        <!--begin::Input group-->
                                        <!-- @role('Franchise','Parent')
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Profile
                                                Image</label>
                                            <div class="col-lg-8">
                                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                                    <div class="image-input-wrapper w-125px h-125px" @role('Parent') style="background-image: url('{{Auth::user()->parent->display_picture}}')" readonly @elserole('Franchise') style="background-image: url('{{Auth::user()->provider->logo}}')" @endrole>
                                                    </div>
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                                        <i class="ki-outline ki-pencil fs-7"></i>
                                                        <input type="file" @role('Parent') name="display_picture" @elserole('Franchise') name="logo" @endrole accept=".png, .jpg, .jpeg">
                                                        <input type="hidden" name="avatar_remove">
                                                    </label>
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                                        <i class="ki-outline ki-cross fs-2"></i>
                                                    </span>
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                                        <i class="ki-outline ki-cross fs-2"></i>
                                                    </span>
                                                </div>
                                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                            </div>
                                        </div>
                                        @endrole -->
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full
                                                Name</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                            <input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 w-100" placeholder="First name" value="{{Auth::user()->name}}">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                            
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        @role('Franchise','Parent')

                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Address</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="Enter address" @role('Parent') value="{{Auth::user()->parent->address}}" readonly @elserole('Franchise') value="{{Auth::user()->provider->address}}" @endrole>
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>

                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Branch
                                                Name</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                <input type="text" name="provider_name" class="form-control form-control-lg form-control-solid" placeholder="Company name" @role('Parent') value="{{Auth::user()->parent->provider->name}}" readonly @elserole('Franchise') value="{{Auth::user()->provider->name}}" @endrole>
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>

                                        <!-- <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Branch Code
                                            </label>
                                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                <input type="text" readonly name="code" class="form-control form-control-lg form-control-solid" placeholder="Company name" @role('Parent') value="{{Auth::user()->parent->provider->code}}" readonly @elserole('Franchise') value="{{Auth::user()->provider->code}}" @endrole>
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    You cannot change this!</div>
                                            </div>
                                        </div> -->

                                        @endrole
                                        <!--end::Input group-->

                                        @role('Franchise','Parent')
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                <span class="required">Contact Phone</span>
                                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Phone number must be active" data-bs-original-title="Phone number must be active" data-kt-initialized="1">
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                <input type="tel" name="phone_number" class="form-control form-control-lg form-control-solid" placeholder="Phone number" @role('Parent') value="{{Auth::user()->parent->phone_number}}" @elserole('Franchise') value="{{Auth::user()->provider->phone_number}}" @endrole>
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        @endrole


                                        @role('Parent')
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                <span class="required">Photo ID (Front)</span>
                                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Add front side image of your photo id" data-bs-original-title="Add front side image of your photo id" data-kt-initialized="1">
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                <input type="file" name="photo_id_front" class="form-control form-control-lg form-control-solid">
                                                @if(isset(Auth::user()->parent) && (!empty(Auth::user()->parent->photo_id_front)))
                                                <a href="{{url(Auth::user()->parent->photo_id_front)}}" target="_blank">View File</a>
                                                @endif
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>

                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                <span class="required">Photo ID (Back)</span>
                                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Add front side image of your photo id" data-bs-original-title="Add front side image of your photo id" data-kt-initialized="1">
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                <input type="file" name="photo_id_back" class="form-control form-control-lg form-control-solid">
                                                @if(isset(Auth::user()->parent) && (!empty(Auth::user()->parent->photo_id_back)))
                                                <a href="{{url(Auth::user()->parent->photo_id_back)}}" target="_blank">View File</a>
                                                @endif
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>

                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                <span class="required">Contract</span>
                                                <span class="ms-1">
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                <input type="file" class="form-control form-control-lg form-control-solid" name="contract_signature">
                                                @if(isset(Auth::user()->parent->contract_signature) && !empty(Auth::user()->parent->contract_signature))
                                                <a href="{{ url(Auth::user()->parent->contract_signature) }}" target="_blank">View Contract</a>
                                                @endif
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>

                                        @if(isset($guide) && !empty($guide))
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                <span class="required">Parent Handbook</span>
                                                <span class="ms-1">
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                <a href="{{ url($guide) }}" target="_blank">View Parent Handbook</a>
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        @endif
                                        @endrole

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Email ID</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Company website" value="{{Auth::user()->email}}" readonly>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Current Password</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <div class="d-flex justify-content-between align-items-center form__parent__div gap-5">
                                                    <input type="password" name="current_password" id="currentPasswordInput" class="form-control  form-control-solid">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="currentPasswordEye" onclick="togglePasswordVisibility('currentPasswordInput', 'currentPasswordEye')" height="16" width="18" viewBox="0 0 576 512">
                                                        <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                                    </svg>
                                                </div>
                                                @error('current_password')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <!--end::Col-->
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">New Password</label>
                                            <div class="col-lg-8 fv-row">
                                                <div class="d-flex justify-content-between align-items-center form__parent__div gap-5">
                                                    <input type="password" name="password" id="newPasswordInput" class="form-control  form-control-solid">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="newPasswordEye" onclick="togglePasswordVisibility('newPasswordInput', 'newPasswordEye')" height="16" width="18" viewBox="0 0 576 512">
                                                        <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                                    </svg>
                                                </div>
                                                @error('password')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Confirm New Password</label>
                                            <div class="col-lg-8 fv-row">
                                                <div class="d-flex justify-content-between align-items-center form__parent__div gap-5">
                                                    <input type="password" name="password_confirmation" id="confirmNewPasswordInput" class="form-control  form-control-solid">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="confirmNewPasswordEye" onclick="togglePasswordVisibility('confirmNewPasswordInput', 'confirmNewPasswordEye')" height="16" width="18" viewBox="0 0 576 512">
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
                                        @role('Franchise')

                                        @if(!empty(Auth::user()->provider->joining_date))
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Joining Date</label>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                                        <input type="text" name="joining_date" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Enter your postal code" value="{{ isset(Auth::user()->provider->joining_date) ? date('Y-m-d', strtotime(Auth::user()->provider->joining_date)) : old('joining_date') }}">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Postal Code</label>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                                        <input type="text" name="postal_code" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Enter your postal code" value="{{Auth::user()->provider->postal_code}}">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">THRC Membership Number</label>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                                        <input type="text" name="thrc_membership_num" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Enter your THRC memebership number" value="{{Auth::user()->provider->thrc_membership_num}}">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <!--                                         
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Location Link</label>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                                        <input type="text" name="location_link" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Enter location link" value="{{Auth::user()->provider->location_link}}">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->


                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Program statement signature</label>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                                        <input type="file" name="program_statement_signature" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Enter program statement signature" value="{{Auth::user()->provider->program_statement_signature}}">
                                                        @if(isset(Auth::user()->provider->program_statement_signature) && (!empty(Auth::user()->provider->program_statement_signature)))
                                                        <a href="{{url(Auth::user()->provider->program_statement_signature)}}" target="_blank">View File</a>
                                                        @endif
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Behavioral managements signature</label>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                                        <input type="file" name="behavioral_managements_signature" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                                        @if(isset(Auth::user()->provider->behavioral_managements_signature) && (!empty(Auth::user()->provider->behavioral_managements_signature)))
                                                        <a href="{{url(Auth::user()->provider->behavioral_managements_signature)}}" target="_blank">View File</a>
                                                        @endif
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Provider responsibility signature</label>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                                        <input type="file" name="provider_responsibility_signature" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                                        @if(isset(Auth::user()->provider->provider_responsibility_signature) && (!empty(Auth::user()->provider->provider_responsibility_signature)))
                                                        <a href="{{url(Auth::user()->provider->provider_responsibility_signature)}}" target="_blank">View File</a>
                                                        @endif
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Acknowledgment Of Appointment</label>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                                        <input type="file" name="contract_signature" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            @if(!empty(Auth::user()->provider->contract_signature))
                                                            <a href="{{ url(Auth::user()->provider->contract_signature) }}">View Acknowledgment Of Appointment</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Rates section added by the admin -->

                                        <!-- <div class="row g-9 mb-8">
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Infant - Rate % - (Full Time)</label>
                                                <input type="number" step="0.01" class="form-control form-control-solid" name="infant_percentage" placeholder="Infant rate %" value="{{ Auth::user()->provider->infant_percentage }}" readonly>
                                                @error('infant_percentage')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Toddler - Rate % - (Full Time)</label>
                                                <input type="number" step="0.01" class="form-control form-control-solid" name="toddler_percentage" placeholder="toddler rate earning %" value="{{ Auth::user()->provider->toddler_percentage }}" readonly>
                                                @error('toddler_percentage')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Pre School - Rate % - (Full Time)</label>
                                                <input type="number" step="0.01" class="form-control form-control-solid" name="pre_school_percentage" placeholder="preschool rate earning %" value="{{ Auth::user()->provider->pre_school_percentage }}" readonly>
                                                @error('pre_school_percentage')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div> -->

                                        <!-- Rates section added by the admin -->


                                        <!--begin::Input group-->
                                        <div class="row mb-0">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Bank Details</label>
                                            <!--begin::Label-->
                                            <!--begin::Label-->
                                            <div class="col-lg-8  align-items-center">
                                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                    <textarea class="form-control form-control-lg form-control-solid" cols="" rows="5" value="{{Auth::user()->provider->bank_details}}" name="bank_details">{{Auth::user()->provider->bank_details}}</textarea>
                                                    <label class="form-check-label" for="allowmarketing"></label>
                                                </div>
                                            </div>
                                            <!--begin::Label-->
                                        </div>
                                        <!--end::Input group-->
                                        @endrole



                                    </div>
                                    <!--end::Card body-->


                                    @role('Franchise')
                                    <div class="card-body border-top p-9">
                                        <div class="content">
                                            <h1 class="mb-10">Documents</h1>
                                        </div>
                                        <div class="row row-cols-lg-2 g-10">

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Fire Inspection Certificate</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="fire_inspection_certificate">
                                                    @if(isset(Auth::user()->provider->fire_inspection_certificate) && (!empty(Auth::user()->provider->fire_inspection_certificate)))
                                                    <a href="{{url(Auth::user()->provider->fire_inspection_certificate)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Health Assessment Certificate</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="health_assessment_certificate">
                                                    @if(isset(Auth::user()->provider->health_assessment_certificate) && (!empty(Auth::user()->provider->health_assessment_certificate)))
                                                    <a href="{{url(Auth::user()->provider->health_assessment_certificate)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">CPR</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="cpr">
                                                    @if(isset(Auth::user()->provider->cpr) && (!empty(Auth::user()->provider->cpr)))
                                                    <a href="{{url(Auth::user()->provider->cpr)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Police Check</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="police_clearance">
                                                    @if(isset(Auth::user()->provider->police_clearance) && (!empty(Auth::user()->provider->police_clearance)))
                                                    <a href="{{url(Auth::user()->provider->police_clearance)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Fire evacuation Program</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="fire_evacuation_program">
                                                    @if(isset(Auth::user()->provider->fire_evacuation_program) && (!empty(Auth::user()->provider->fire_evacuation_program)))
                                                    <a href="{{url(Auth::user()->provider->fire_evacuation_program)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Driving license</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="license">
                                                    @if(isset(Auth::user()->provider->license) && (!empty(Auth::user()->provider->license)))
                                                    <a href="{{url(Auth::user()->provider->license)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Insurance</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="insurance">
                                                    @if(isset(Auth::user()->provider->insurance) && (!empty(Auth::user()->provider->insurance)))
                                                    <a href="{{url(Auth::user()->provider->insurance)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Contract</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="contract">
                                                    @if(isset(Auth::user()->provider->contract) && (!empty(Auth::user()->provider->contract)))
                                                    <a href="{{url(Auth::user()->provider->contract)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Food handler</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="food_handler">
                                                    @if(isset(Auth::user()->provider->food_handler) && (!empty(Auth::user()->provider->food_handler)))
                                                    <a href="{{url(Auth::user()->provider->food_handler)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Offence Declaration</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="offence_declaration">
                                                    @if(isset(Auth::user()->provider->offence_declaration) && (!empty(Auth::user()->provider->offence_declaration)))
                                                    <a href="{{url(Auth::user()->provider->offence_declaration)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Notice of personal information collection</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="notice_of_personal_information_collection">
                                                    @if(isset(Auth::user()->provider->notice_of_personal_information_collection) && (!empty(Auth::user()->provider->notice_of_personal_information_collection)))
                                                    <a href="{{url(Auth::user()->provider->notice_of_personal_information_collection)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Covid Vaccine</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="covid_vaccine">
                                                    @if(isset(Auth::user()->provider->covid_vaccine) && (!empty(Auth::user()->provider->covid_vaccine)))
                                                    <a href="{{url(Auth::user()->provider->covid_vaccine)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Sign of policies</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="sign_of_policies">
                                                    @if(isset(Auth::user()->provider->sign_of_policies) && (!empty(Auth::user()->provider->sign_of_policies)))
                                                    <a href="{{url(Auth::user()->provider->sign_of_policies)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Landlord approval letter</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="landlord_approval_letter">
                                                    @if(isset(Auth::user()->provider->landlord_approval_letter) && (!empty(Auth::user()->provider->landlord_approval_letter)))
                                                    <a href="{{url(Auth::user()->provider->landlord_approval_letter)}}" target="_blank">View File</a>
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Pet Vaccination</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="file" value="" name="pet_vaccination">
                                                    @if(isset(Auth::user()->provider->pet_vaccination) && (!empty(Auth::user()->provider->pet_vaccination)))
                                                    <a href="{{url(Auth::user()->provider->pet_vaccination)}}" target="_blank">View File</a>
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
                                                    @if(isset(Auth::user()->provider->additional_certification) && (!empty(Auth::user()->provider->additional_certification)))
                                                    <a href="{{url(Auth::user()->provider->additional_certification)}}" target="_blank">View File</a>
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
                                                @if(isset(Auth::user()->provider->images) && (!empty(Auth::user()->provider->images)) && count(Auth::user()->provider->images) > 0)
                                                <div>
                                                    <h1 class="text-[1.25rem] mb-1 font-semibold">Profile</h1>
                                                    <div class="flex items-center gap-2.5 flex-wrap">

                                                        <div class="card-body pt-5">
                                                            <div class="d-flex align-items-center gap-4 flex-wrap viewer">
                                                                @foreach(Auth::user()->provider->images as $image)
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

                                    @endrole



                                    @role('Admin')
                                    <div class="card-body border-top p-9">
                                        <div class="content">
                                            <h1 class="mb-10">Settings</h1>
                                        </div>

                                        <div class="row g-10 mb-4">

                                            <div class="d-flex justify-content-between gap-15">

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Infant - (Full Time)</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" placeholder="over 6 hours and above (under 2 years)" type="number" step="0.01" name="infant" value="{{old('infant', isset($settings) ? $settings->infant : '')}}">
                                                    <!--end::Input-->
                                                </div>

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Toddler - (Full Time)</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" placeholder="over 6 hours and above (2-3 years)" type="number" step="0.01" name="toddler" value="{{old('toddler', isset($settings) ? $settings->toddler : '')}}">
                                                    <!--end::Input-->
                                                </div>

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Preschool - (Full Time)</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" placeholder="over 6 hours (4-6 years)" type="number" step="0.01" name="pre_school" value="{{old('pre_school', isset($settings) ? $settings->pre_school : '')}}">
                                                    <!--end::Input-->
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row g-10 mb-4">
                                            <div class="d-flex justify-content-between gap-15">

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Spots Allowed Per Provider</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" placeholder="Enter the spots allowed per provider" type="number" step="0.01" name="spots_allowed_to_provider" value="{{old('spots_allowed_to_provider', isset($settings) ? $settings->spots_allowed_to_provider : '')}}">
                                                    <!--end::Input-->
                                                </div>

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">THRC Number</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" placeholder="Enter THRC number" type="text" name="thrc_num" value="{{old('thrc_num', isset($settings) ? $settings->thrc_num : '')}}">
                                                    <!--end::Input-->
                                                </div>

                                            </div>
                                        </div>


                                        <div class="row g-10 mb-4">
                                            <div class="d-flex justify-content-between gap-15">

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Infants Allowed Per Provider</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" placeholder="Enter the infants allowed per provider" type="number" step="0.01" name="infants_allowed_to_provider" value="{{old('infants_allowed_to_provider', isset($settings) ? $settings->infants_allowed_to_provider : '')}}">
                                                    <!--end::Input-->
                                                </div>

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Toddlers Allowed Per Provider</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" placeholder="Enter the toddler allowed per provider" type="number" step="0.01" name="toddlers_allowed_to_provider" value="{{old('toddlers_allowed_to_provider', isset($settings) ? $settings->toddlers_allowed_to_provider : '')}}">
                                                    <!--end::Input-->
                                                </div>

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Preschool Allowed Per Provider</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" placeholder="Enter the pre schoolers allowed per provider" type="number" step="0.01" name="pre_schoolers_allowed_to_provider" value="{{old('pre_schoolers_allowed_to_provider', isset($settings) ? $settings->pre_schoolers_allowed_to_provider : '')}}">
                                                    <!--end::Input-->
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row g-10 mb-4">
                                            <div class="d-flex justify-content-between gap-15">

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <label class="fs-6 fw-semibold mb-2 required">Ministry Rate Infant</label>
                                                    <input class="form-control form-control-solid" id="" placeholder="Enter share with ministry for infant" type="number" step="0.01" name="ministry_rate_infant" value="{{old('ministry_rate_infant', isset($settings) ? $settings->ministry_rate_infant : '')}}">
                                                </div>

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <label class="fs-6 fw-semibold mb-2 required">Ministry Rate Toddler</label>
                                                    <input class="form-control form-control-solid" id="" placeholder="Enter share with ministry for toddler" type="number" step="0.01" name="ministry_rate_toddler" value="{{old('ministry_rate_toddler', isset($settings) ? $settings->ministry_rate_toddler : '')}}">
                                                </div>

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <label class="fs-6 fw-semibold mb-2 required">Ministry Rate Preschool</label>
                                                    <input class="form-control form-control-solid" id="" placeholder="Enter share with ministry preschool" type="number" step="0.01" name="ministry_rate_pre_school" value="{{old('ministry_rate_pre_school', isset($settings) ? $settings->ministry_rate_pre_school : '')}}">
                                                </div>

                                            </div>
                                        </div>


                                        <div class="row g-10 mb-4">
                                            <div class="d-flex justify-content-between gap-15">

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <label class="fs-6 fw-semibold mb-2 required">Upload Acknowledgment of Appointment</label>
                                                    <input class="form-control form-control-solid" id="" type="file" name="provider_contract">
                                                    @if(isset($settings) && (!empty($settings->provider_contract)))
                                                    <a href="{{url($settings->provider_contract)}}" target="_blank">View File</a>
                                                    @endif
                                                </div>

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <label class="fs-6 fw-semibold mb-2 required">Upload Contract For Parent's</label>
                                                    <input class="form-control form-control-solid" id="" type="file" name="parent_contract">
                                                    @if(isset($settings) && (!empty($settings->parent_contract)))
                                                    <a href="{{url($settings->parent_contract)}}" target="_blank">View File</a>
                                                    @endif
                                                </div>

                                                <div class="w-50 d-flex flex-column justify-content-end">
                                                    <label class="fs-6 fw-semibold mb-2 required">Parent Handbook</label>
                                                    <input class="form-control form-control-solid" id="" type="file" name="parent_guide">
                                                    @if(isset($settings) && (!empty($settings->parent_guide)))
                                                    <a href="{{url($settings->parent_guide)}}" target="_blank">View File</a>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row g-10 mb-4">
                                            <div class="d-flex  gap-20">
                                                <div class="">
                                                    <label class="fs-6 fw-semibold mb-2 required">Parent's Survey</label>
                                                    <a href="javascript:void();" onclick="event.preventDefault(); document.getElementById('toogle-parent-survey').submit();" type="button" class="btn btn-primary d-block" id="kt_account_profile_details_submit">@if(isset($settings) && $settings->show_parents_survey == 1) Hide @else Show @endif</a>
                                                </div>
                                                <div class="">
                                                    <label class="fs-6 fw-semibold mb-2 required">Provider's Survey</label>
                                                    <a href="javascript:void();" onclick="event.preventDefault(); document.getElementById('toogle-provider-survey').submit();" type="button" class="btn btn-primary d-block" id="kt_account_profile_details_submit">@if(isset($settings) && $settings->show_providers_survey == 1) Hide @else Show @endif</a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    @endrole


                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
                                    </div>
                                    <!--end::Actions-->
                                    <input type="hidden">
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Content-->
                        </div>


                        <!-- Extra Forms -->
                        <form id="toogle-parent-survey" action="{{ route('survey.update.toogle',['parent_survey_toogle' => 1]) }}" method="post" style="display: none;">
                            @csrf
                        </form>

                        <form id="toogle-provider-survey" action="{{ route('survey.update.toogle',['provider_survey_toogle' => 1]) }}" method="post" style="display: none;">
                            @csrf
                        </form>
                        <!-- Extra Forms -->


                        <!--end::Card title-->
                        <!--begin::Card body-->

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
            <!--begin::Row-->



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


    function togglePasswordVisibility(inputId, eyeIconId) {
        var passwordInput = document.getElementById(inputId);
        var eyeIcon = document.getElementById(eyeIconId);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            // Change eye icon to open eye
            // eyeIcon.innerHTML = '<path d="M576 256c0 141.4-114.6 256-256 256S64 397.4 64 256 178.6 0 320 0s256 114.6 256 256zM288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>';
        } else {
            passwordInput.type = "password";
            // Change eye icon to closed eye
            // eyeIcon.innerHTML = '<path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>';
        }
    }
</script>
@endsection