@extends('layouts.app')
@isset($kid)
@section('title', 'Edit Kid | High5 Daycare')
@else
@section('title', 'Add Kid | High5 Daycare')
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
                            <span>Kids</span>
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
                        <li class="breadcrumb-item text-white">Kid</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Actions-->

                <!-- <div class="d-flex align-self-center flex-center flex-shrink-0">
                    <a href="#" class="btn btn-sm btn-dark ms-3 px-4 py-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Create
                        <span class="d-none d-sm-inline">New Parent</span></a>
                </div> -->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Row-->




            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::List widget 23-->
                    <div class="card card-flush h-xl-100">

                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Items-->
                            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" method="POST" @isset($kid) action="{{ route('admin.update.kid',['id' => $kid->id]) }}" @else action="{{ route('admin.insert.kid') }}" @endif enctype="multipart/form-data">
                                @csrf
                                <!--begin::Heading-->
                                <div class="mb-13 text-center">
                                    <!--begin::Title-->
                                    <h1 class="mb-3 text-black">@isset($kid) @else Add @endisset Kid Details</h1>
                                    <!--end::Title-->
                                    <!--begin::Description-->

                                    <!--end::Description-->
                                </div>
                                <!--end::Heading-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    @role('Admin','Franchise')
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Select Parent</label>
                                        <select class="form-control form-control-solid" name="parent_id" required data-control="select2" data-hide-search="false">
                                            @if(isset($parents) && !empty($parents))
                                            <option value="">Select Parent</option>
                                            @foreach($parents as $parent)
                                            <option value="{{$parent->id}}" @if(isset($kid) && (!empty($kid->parent_id)) && $kid->parent_id == $parent->id) selected @endif @if(old('parent_id') == $parent->id) selected @endif>{{$parent->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @else
                                    <input type="hidden" name="parent_id" value="{{Auth::user()->parent->id}}">
                                    @endrole

                                    <div @role('Admin','Franchise') class="col-md-6 fv-row" @else class="col-md-12 fv-row" @endrole>
                                        <label class="required fs-6 fw-semibold mb-2">Kid Full Name</label>
                                        <input type="text" class="form-control form-control-solid" name="full_name" value="{{ isset($kid) ? $kid->full_name : old('full_name') }}">
                                        @error('full_name')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <div class="row g-9 mb-8">

                                <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Father Name</label>
                                        <input type="text" class="form-control form-control-solid" name="father_name" value="{{ isset($kid) ? $kid->father_name : old('father_name') }}" placeholder="Enter father name">
                                        @error('father_name')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Mother Name</label>
                                        <input type="text" class="form-control form-control-solid" name="mother_name" value="{{ isset($kid) ? $kid->mother_name : old('mother_name') }}" placeholder="Enter mother name">
                                        @error('mother_name')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <!-- <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Kid Age</label>
                                        <input type="number" step="0.01" class="form-control form-control-solid" name="age" value="{{ isset($kid) ? $kid->age : old('age') }}">
                                        @error('age')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div> -->
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Allergies</label>
                                        <input type="text" class="form-control form-control-solid" name="allergies" value="{{ isset($kid) ? $kid->allergies : old('allergies') }}">
                                        @error('allergies')
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
                                        <label class="required fs-6 fw-semibold mb-2">Profile Picture</label>
                                        <input type="file" class="form-control form-control-solid" name="profile_picture">
                                        @if(isset($kid) && (!empty($kid->profile_picture)))
                                        <a href="{{url($kid->profile_picture)}}" target="_blank">View File</a>
                                        @endif
                                        @error('profile_picture')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Contact Number</label>
                                        <div class="bg-gray-100 rounded d-flex align-items-center">
                                            <div class="px-5 fw-bold">+1</div>
                                            <input type="number" class="form-control form-control-solid" name="contact_number" value="{{ isset($kid) ? $kid->contact_number : old('contact_number') }}">
                                        </div>
                                        @error('contact_number')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->

                                </div>



                                @role('Admin')
                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">

                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Registeration Fee</label>
                                        <input type="number" step="0.01" class="form-control form-control-solid" name="registeration_fee" value="{{ isset($kid) ? $kid->registeration_fee : old('registeration_fee') }}" placeholder="Enter Registeration Fee (if apply)">
                                        @error('registeration_fee')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Security Deposit</label>
                                        <input type="number" step="0.01" class="form-control form-control-solid" name="advance_payment" value="{{ isset($kid) ? $kid->advance_payment : old('advance_payment') }}" placeholder="Enter Advance Payment (if apply)">
                                        @error('advance_payment')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!--end::Input group-->
                                </div>
                                @endrole


                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="@role('Admin') col-md-6 @else col-md-12 @endrole fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Contract Start</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            <!--begin::Icon-->
                                            <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                            <!--end::Icon-->
                                            <!--begin::Datepicker-->
                                            <input type="date" class="form-control form-control-solid ps-12" placeholder="Select a date" name="contract_start" value="{{ old('contract_start', isset($kid) ? (optional($kid)->contract_start ? date('Y-m-d', strtotime(optional($kid)->contract_start)) : '') : '') }}">
                                            <!--end::Datepicker-->
                                        </div>
                                        <!--end::Input-->
                                        @error('contract_start')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->

                                    @role('Admin')
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Contract End</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            <!--begin::Icon-->
                                            <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                            <!--end::Icon-->
                                            <!--begin::Datepicker-->
                                            <input type="date" class="form-control form-control-solid ps-12 flatpickr-input" placeholder="Select a date" name="contract_end" value="{{ old('contract_end', isset($kid) ? (optional($kid)->contract_end ? date('Y-m-d', strtotime(optional($kid)->contract_end)) : '') : '') }}">
                                            <!--end::Datepicker-->
                                        </div>
                                        <!--end::Input-->
                                        @error('contract_end')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    @endrole

                                    <!--end::Input group-->
                                </div>


                                <div class="row g-9 mb-8">

                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Date of Birth</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            <!--begin::Icon-->
                                            <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                            <!--end::Icon-->
                                            <!--begin::Datepicker-->
                                            <input type="date" class="form-control form-control-solid ps-12" placeholder="Select a date" name="dob" value="{{ old('dob', isset($kid) ? (optional($kid)->dob ? date('Y-m-d', strtotime(optional($kid)->dob)) : '') : '') }}">
                                            <!--end::Datepicker-->

                                        </div>
                                        <!--end::Input-->
                                        @error('dob')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Start Date at School</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            <!--begin::Icon-->
                                            <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                            <!--end::Icon-->
                                            <!--begin::Datepicker-->
                                            <input type="date" class="form-control form-control-solid ps-12 flatpickr-input" placeholder="Select a date" name="school_start" value="{{ old('school_start', isset($kid) ? (optional($kid)->school_start ? date('Y-m-d', strtotime(optional($kid)->school_start)) : '') : '') }}">
                                            <!--end::Datepicker-->
                                        </div>
                                        @error('school_start')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->

                                    <!-- </div> -->

                                    @role('Admin')

                                    <div class="row g-9 mb-8">

                                        <!--begin::Col-->
                                        <!-- <div class="col-md-4 fv-row">
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <span class="form-check-label fw-semibold text-muted me-4">Subsidized</span>
                                            <input class="form-check-input" type="checkbox" value="1" name="is_subsidized" @if(isset($kid) && $kid->is_subsidized == 1) checked="checked" @elseif(isset($kid) && $kid->is_subsidized == 0) @else checked="checked" @endif @role('Franchise') disabled @endrole>
                                        </label>
                                    </div> -->

                                        <div class="col-md-2 fv-row">
                                            <label class="fs-6 fw-semibold mb-2">Subsidized</label>
                                            <input class="form-control form-check-input" type="checkbox" value="1" name="is_subsidized" @if(isset($kid) && $kid->is_subsidized == 1) checked="checked" @elseif(isset($kid) && $kid->is_subsidized == 0) @endif @role('Franchise') disabled @endrole>
                                        </div>

                                        <div class="col-md-5 fv-row" id="subsidyFields" @if(!isset($kid) || $kid->is_subsidized != 1) style="display: none;" @endif>
                                            <label class="required fs-6 fw-semibold mb-2">Subsidized Certificate</label>
                                            <input type="file" class="form-control form-control-solid" placeholder="Enter percentage" name="subsidized_certificates[]" multiple>
                                            @if(isset($kid) && $kid->subsidizedCertificates && !empty($kid->subsidizedCertificates) && count($kid->subsidizedCertificates) > 0)
                                            <a href="#" id="viewCertificatesBtn">View Certificates</a>
                                            @endif
                                            @error('subsidized_certificate')
                                            <div style="color: red;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <!--end::Col-->

                                        <div class="col-md-5 fv-row" id="subsidyAmountFields" @if(!isset($kid) || $kid->is_subsidized != 1) style="display: none;" @endif>
                                            <label class="required fs-6 fw-semibold mb-2">Subsidized Amount</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Enter percentage" name="subsidized_percentage" value="{{ isset($kid) ? $kid->subsidized_percentage : old('subsidized_percentage') }}">
                                            @error('subsidized_percentage')
                                            <div style="color: red;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <!--end::Col-->

                                    </div>


                                    <div class="row g-9 mb-8">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row" id="subsidyDate1Fields" @if(!isset($kid) || $kid->is_subsidized != 1) style="display: none;" @endif>
                                            <label class="fs-5 fw-semibold mb-2">Subsidized From</label>
                                            <!--begin::Input-->
                                            <div class="position-relative d-flex align-items-center">
                                                <!--begin::Icon-->
                                                <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                                <!--end::Icon-->
                                                <!--begin::Datepicker-->
                                                <input type="date" class="form-control form-control-solid ps-12" placeholder="Select a date" name="subsidized_from" value="{{ old('subsidized_from', isset($kid) ? (optional($kid)->subsidized_from ? date('Y-m-d', strtotime(optional($kid)->subsidized_from)) : '') : '') }}">
                                                <!--end::Datepicker-->

                                            </div>
                                            <!--end::Input-->
                                            @error('subsidized_from')
                                            <div style="color: red;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row" id="subsidyDate2Fields" @if(!isset($kid) || $kid->is_subsidized != 1) style="display: none;" @endif>
                                            <label class="fs-5 fw-semibold mb-2">Subsidized Till</label>
                                            <!--begin::Input-->
                                            <div class="position-relative d-flex align-items-center">
                                                <!--begin::Icon-->
                                                <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                                <!--end::Icon-->
                                                <!--begin::Datepicker-->
                                                <input type="date" class="form-control form-control-solid ps-12 flatpickr-input" placeholder="Select a date" name="subsidized_to" value="{{ old('subsidized_to', isset($kid) ? (optional($kid)->subsidized_to ? date('Y-m-d', strtotime(optional($kid)->subsidized_to)) : '') : '') }}">
                                                <!--end::Datepicker-->
                                            </div>
                                            @error('subsidized_to')
                                            <div style="color: red;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        @endrole

                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Comments</label>
                                        <textarea class="form-control form-control-solid" rows="3" name="comments" placeholder="Add a note" @role('Franchise') disabled @endrole>{{ isset($kid) ? $kid->comments : old('comments') }}</textarea>
                                        @error('comments')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->

                                    <!--end::Input group-->


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-stack mb-8">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <label class="fs-6 fw-semibold">Part-Time</label>
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <span class="form-check-label fw-semibold text-muted me-4">Yes</span>
                                                    <input class="form-check-input" type="checkbox" value="1" name="is_part_time" id="is_part_time" @if(isset($kid) && $kid->is_part_time == 1) checked="checked" @elseif(isset($kid) && $kid->is_part_time == 0) @endif>
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                        </div>

                                        <!-- Days Checkbox Group -->
                                        <div class="col-md-6" id="daysContainer" style="display:none;">
                                            <label class="required fs-6 fw-semibold mb-2">Select Days</label>
                                            <div>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="days[]" value="monday"> Monday
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="days[]" value="tuesday"> Tuesday
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="days[]" value="wednesday"> Wednesday
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="days[]" value="thursday"> Thursday
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="days[]" value="friday"> Friday
                                                </label>
                                                <!-- Repeat for other days -->
                                            </div>
                                        </div>

                                    </div>

                                    <!-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex flex-stack mb-8">
                                            <div class="me-5">
                                                <label class="fs-6 fw-semibold">Incident</label>
                                            </div>
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <span class="form-check-label fw-semibold text-muted me-4">Yes</span>
                                                <input class="form-check-input" type="checkbox" value="1" name="incident" @if(isset($kid) && $kid->incident == 1) checked="checked" @elseif(isset($kid) && $kid->incident == 0) @endif @role('Franchise') disabled @endrole>
                                            </label>
                                        </div>
                                    </div>
                                </div> -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-stack mb-8">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <label class="fs-6 fw-semibold">Subsidy Eligibility</label>
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <span class="form-check-label fw-semibold text-muted  me-4">Yes</span>
                                                    <input class="form-check-input" type="checkbox" value="1" name="subsidy_eligibility" @if(isset($kid) && $kid->subsidy_eligibility == 1) checked="checked" @elseif(isset($kid) && $kid->subsidy_eligibility == 0) @else checked="checked" @endif>
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                        </div>
                                    </div>

                                    @role('Parent')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-stack mb-8">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <label class="fs-6 fw-semibold">Photo Permission</label>
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <span class="form-check-label fw-semibold text-muted me-4">Yes</span>
                                                    <input class="form-check-input" type="checkbox" value="1" name="photo_permission" @if(isset($kid) && $kid->photo_permission == 1) checked="checked" @elseif(isset($kid) && $kid->photo_permission == 0) @else checked="checked" @endif>
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                        </div>
                                    </div>
                                    @endrole
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-stack mb-8">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <label class="fs-6 fw-semibold">Status</label>
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <span class="form-check-label fw-semibold text-muted me-4">Active</span>
                                                    <input class="form-check-input" type="checkbox" value="1" name="status" @if(isset($kid) && $kid->status == 1) checked="checked" @elseif(isset($kid) && $kid->status == 0) @else checked="checked" @endif @role('Franchise') disabled @endrole>
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->

                                    <!--end::Input group-->
                                    @role('Admin','Franchise','Parent')
                                    <!--begin::Actions-->
                                    <div class="text-right " style="text-align: right">
                                        @role('Parent')
                                        <a @isset($kid) href="{{route('kid.documents',['id' => $kid->id])}}" @else href="#" @endisset class="btn btn-light me-3">
                                            Documents
                                        </a>
                                        @endrole
                                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                    @endrole
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
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>

@if(isset($kid) && $kid->is_part_time && $kid->is_part_time == 1 && !empty($kid->selected_days))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var partTimeCheckbox = document.getElementById('is_part_time');

        var daysContainer = document.getElementById('daysContainer');

        partTimeCheckbox.checked = true;

        var displayStyle = 'block';

        var selectedDays = JSON.parse('{!! $kid->selected_days !!}');

        selectedDays.forEach(function(day) {
            var checkbox = document.querySelector('input[name="days[]"][value="' + day + '"]');
            if (checkbox) {
                checkbox.checked = true;
            }
        });

        daysContainer.style.display = displayStyle;
    });
</script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('is_part_time').addEventListener('change', function() {
            var daysContainer = document.getElementById('daysContainer');
            daysContainer.style.display = this.checked ? 'block' : 'none';
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var subsidizedCheckbox = document.querySelector('input[name="is_subsidized"]');
        var subsidyFields = document.getElementById('subsidyFields');
        var subsidyAmountFields = document.getElementById('subsidyAmountFields');
        var subsidyDate1Fields = document.getElementById('subsidyDate1Fields');
        var subsidyDate2Fields = document.getElementById('subsidyDate2Fields');

        // Check the Subsidized checkbox on page load
        if (subsidizedCheckbox.checked) {
            subsidyFields.style.display = 'block';
            subsidyAmountFields.style.display = 'block';
            subsidyDate1Fields.style.display = 'block';
            subsidyDate2Fields.style.display = 'block';
        }

        // Add an event listener to toggle the visibility of subsidy fields
        subsidizedCheckbox.addEventListener('change', function() {
            subsidyFields.style.display = this.checked ? 'block' : 'none';
            subsidyAmountFields.style.display = this.checked ? 'block' : 'none';
            subsidyDate1Fields.style.display = this.checked ? 'block' : 'none';
            subsidyDate2Fields.style.display = this.checked ? 'block' : 'none';
        });
    });
</script>

@if(isset($kid) && $kid->subsidizedCertificates && !empty($kid->subsidizedCertificates) && count($kid->subsidizedCertificates) > 0)

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const baseUrl = '{{ url('/') }}';
        let certificates = <?php echo json_encode($kid->subsidizedCertificates) ?>;
        
        function laravelUrl(path) {
         return `${baseUrl}/${path}`;
        }

        document.getElementById('viewCertificatesBtn').addEventListener('click', function() {
                // Create a SweetAlert with links and delete button
                let buttonsAndLinksHtml = certificates.map(function(cert) {
            return `
                <div class="d-flex align-items-center w-100 justify-content-center gap-1">
                    <a href="#" class="viewFileBtn" data-id="${cert.id}" data-url="${laravelUrl(cert.certificate_file_path)}"> 
                        View File
                    </a>
                    <a href="${laravelUrl(cert.certificate_file_path)}" target="_blank"></a>
                    <button class="deleteBtn btn btn-sm btn-secondary mt-0" data-id="${cert.id}">Delete</button>
                </div>
            `;
        }).join('<br>');

        Swal.fire({
            title: 'Certificates',
            html: buttonsAndLinksHtml,
            showCloseButton: true,
            showCancelButton: false,
        });

        // Attach click event listeners for "View File" and "Delete" buttons
        document.querySelectorAll('.viewFileBtn').forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                // Open the corresponding link in a new tab
                window.open(this.getAttribute('data-url'), '_blank');
            });
        });

        document.querySelectorAll('.deleteBtn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                // Handle deletion logic here
                const certificateId = this.getAttribute('data-id');
                fetch('{{ route("delete.certificate", ["certificateId" => ":certificateId"]) }}'.replace(':certificateId', certificateId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        // Add any additional headers if needed
                    },
                    // You can pass data in the body if required by the API
                    body: JSON.stringify({
                        // Add any payload you need for the delete request
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle success response
                    console.log('Delete request successful', data);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                })
                .catch(error => {
                    // Handle error
                    console.error('Error during delete request:', error);
                    Swal.fire(
                        'Error!',
                        'An error occurred while deleting the file.',
                        'error'
                    );
                });
                console.log('Delete button clicked for certificate:', this.getAttribute('data-id'));
            });
        });
    });
});
</script>
@endif
@endsection