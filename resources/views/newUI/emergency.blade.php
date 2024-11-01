@extends('layouts.app')
@section('title', 'Emergency | High5 Daycare')
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
                            <span>Emergency</span>
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
                        <li class="breadcrumb-item text-white">Emergency</li>
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
                            <form class="form" action="{{route('add.kid.emergency',['kid' => $kid->id])}}" method="POST" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Emergency Information</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">

                                    <div class="mb-12">
                                        <div class="my-5">
                                            <h3>Child Name</h3>
                                        </div>

                                        <div class="row row-cols-lg-2 g-10">

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('child_name', optional($kid->emergencyInformation)->child_name) }}" name="child_name" />
                                                    @error('child_name')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <!--end::Input-->
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="mb-12">
                                        <div class="my-5">
                                            <h3>Doctor's Information</h3>
                                        </div>

                                        <div class="row row-cols-lg-2 g-10">

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('doctor_name', optional($kid->emergencyInformation)->doctor_name) }}" name="doctor_name" />
                                                    @error('doctor_name')
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
                                                    <label class="fs-6 fw-semibold mb-2 required">Address</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('doctor_address', optional($kid->emergencyInformation)->doctor_address) }}" name="doctor_address" />
                                                    <!--end::Input-->
                                                    @error('doctor_address')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Medical Center (if applicable)</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('medical_center', optional($kid->emergencyInformation)->medical_center) }}" name="medical_center" />
                                                    <!--end::Input-->
                                                    @error('medical_center')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Phone No.</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="bg-gray-100 rounded d-flex align-items-center">
                                                        <div class="px-5 fw-bold">+1</div>
                                                        <input class="form-control form-control-solid" id="" type="tel" value="{{ old('doctor_phone', optional($kid->emergencyInformation)->doctor_phone) }}" name="doctor_phone" />
                                                        <!--end::Input-->
                                                    </div>
                                                    @error('doctor_phone')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="mb-12">
                                        <div class="my-5">
                                            <h3>Emergency Contact Information</h3>
                                        </div>

                                        <div class="row row-cols-1 row-cols-md-2 g-10 my-1">

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Surname</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_surname', optional($kid->emergencyInformation)->emergency_contact_surname) }}" name="emergency_contact_surname" />
                                                    <!--end::Input-->
                                                    @error('emergency_contact_surname')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">First Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_first_name', optional($kid->emergencyInformation)->emergency_contact_first_name) }}" name="emergency_contact_first_name" />
                                                    <!--end::Input-->
                                                    @error('emergency_contact_first_name')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Home Address</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_address', optional($kid->emergencyInformation)->emergency_contact_address) }}" name="emergency_contact_address" />
                                                    <!--end::Input-->
                                                    @error('emergency_contact_address')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Relationship</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="d-flex gap-2">
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_relationship', optional($kid->emergencyInformation)->emergency_contact_relationship) }}" name="emergency_contact_relationship" />
                                                        @error('emergency_contact_relationship')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_c_no', optional($kid->emergencyInformation)->emergency_contact_c_no) }}" name="emergency_contact_c_no" />
                                                        @error('emergency_contact_c_no')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_p_no', optional($kid->emergencyInformation)->emergency_contact_p_no) }}" name="emergency_contact_p_no" />
                                                        @error('emergency_contact_p_no')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row row-cols-1 row-cols-md-2 g-10 my-1">

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Surname</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_surname_2', optional($kid->emergencyInformation)->emergency_contact_surname_2) }}" name="emergency_contact_surname_2" />
                                                    <!--end::Input-->
                                                    @error('emergency_contact_surname_2')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">First Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_first_name_2', optional($kid->emergencyInformation)->emergency_contact_first_name_2) }}" name="emergency_contact_first_name_2" />
                                                    <!--end::Input-->
                                                    @error('emergency_contact_first_name_2')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Home Address</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_address_2', optional($kid->emergencyInformation)->emergency_contact_address_2) }}" name="emergency_contact_address_2" />
                                                    <!--end::Input-->
                                                    @error('emergency_contact_address_2')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Relationship</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="d-flex gap-2">
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_relationship_2', optional($kid->emergencyInformation)->emergency_contact_relationship_2) }}" name="emergency_contact_relationship_2" />
                                                        @error('emergency_contact_relationship_2')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_c_no_2', optional($kid->emergencyInformation)->emergency_contact_c_no_2) }}" name="emergency_contact_c_no_2" />
                                                        @error('emergency_contact_c_no_2')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_p_no_2', optional($kid->emergencyInformation)->emergency_contact_p_no_2) }}" name="emergency_contact_p_no_2" />
                                                        @error('emergency_contact_p_no_2')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row row-cols-1 row-cols-md-2 g-10 my-1">

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Surname</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_surname_3', optional($kid->emergencyInformation)->emergency_contact_surname_3) }}" name="emergency_contact_surname_3" />
                                                    <!--end::Input-->
                                                    @error('emergency_contact_surname_3')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">First Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_first_name_3', optional($kid->emergencyInformation)->emergency_contact_first_name_3) }}" name="emergency_contact_first_name_3" />
                                                    <!--end::Input-->
                                                    @error('emergency_contact_first_name_3')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Home Address</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_address_3', optional($kid->emergencyInformation)->emergency_contact_address_3) }}" name="emergency_contact_address_3" />
                                                    <!--end::Input-->
                                                    @error('emergency_contact_address_3')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Relationship</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="d-flex gap-2">
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_relationship_3', optional($kid->emergencyInformation)->emergency_contact_relationship_3) }}" name="emergency_contact_relationship_3" />
                                                        @error('emergency_contact_relationship_3')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_c_no_3', optional($kid->emergencyInformation)->emergency_contact_c_no_3) }}" name="emergency_contact_c_no_3" />
                                                        @error('emergency_contact_c_no_3')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_p_no_3', optional($kid->emergencyInformation)->emergency_contact_p_no_3) }}" name="emergency_contact_p_no_3" />
                                                        @error('emergency_contact_p_no_3')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row row-cols-1 row-cols-md-2 g-10 my-1">

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Surname</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_surname_4', optional($kid->emergencyInformation)->emergency_contact_surname_4) }}" name="emergency_contact_surname_4" />
                                                    <!--end::Input-->
                                                    @error('emergency_contact_surname_4')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">First Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_first_name_4', optional($kid->emergencyInformation)->emergency_contact_first_name_4) }}" name="emergency_contact_first_name_4" />
                                                    <!--end::Input-->
                                                    @error('emergency_contact_first_name_4')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Home Address</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_address_4', optional($kid->emergencyInformation)->emergency_contact_address_4) }}" name="emergency_contact_address_4" />
                                                    <!--end::Input-->
                                                    @error('emergency_contact_address_4')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Relationship</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="d-flex gap-2">
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_relationship_4', optional($kid->emergencyInformation)->emergency_contact_relationship_4) }}" name="emergency_contact_relationship_4" />
                                                        @error('emergency_contact_relationship_4')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_c_no_4', optional($kid->emergencyInformation)->emergency_contact_c_no_4) }}" name="emergency_contact_c_no_4" />
                                                        @error('emergency_contact_c_no_4')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('emergency_contact_p_no_4', optional($kid->emergencyInformation)->emergency_contact_p_no_4) }}" name="emergency_contact_p_no_4" />
                                                        @error('emergency_contact_p_no_4')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="mb-12">
                                        <div class="my-5">
                                            <h3>Health Card Number</h3>
                                        </div>

                                        <div class="row row-cols-1 row-cols-md-2 g-10">

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Card Number</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="d-flex gap-2">
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('health_card_number', optional($kid->emergencyInformation)->health_card_number) }}" name="health_card_number" />
                                                        @error('health_card_number')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('health_card_number_2', optional($kid->emergencyInformation)->health_card_number_2) }}" name="health_card_number_2" />
                                                        @error('health_card_number_2')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">DOB</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="date" value="{{ old('health_card_dob', optional($kid->emergencyInformation)->health_card_dob ? date('Y-m-d', strtotime(optional($kid->emergencyInformation)->health_card_dob)) : ''  ) }}" name="health_card_dob" />
                                                    <!--end::Input-->
                                                    @error('health_card_dob')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Allergies</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="d-flex gap-2">
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('allergies', optional($kid->emergencyInformation)->allergies) }}" name="allergies" />
                                                        @error('allergies')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('allergies_2', optional($kid->emergencyInformation)->allergies_2) }}" name="allergies_2" />
                                                        @error('allergies_2')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <!--end::Input-->

                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Dietary Reuirement/Health Condtions</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="d-flex gap-2">
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('health_conditions', optional($kid->emergencyInformation)->health_conditions) }}" name="health_conditions" />
                                                        @error('health_conditions')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <input class="form-control form-control-solid" id="" type="text" value="{{ old('health_conditions_2', optional($kid->emergencyInformation)->health_conditions_2) }}" name="health_conditions_2" />
                                                        @error('health_conditions_2')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-12">
                                        <div class="my-5">
                                            <h3>Parent's Signature</h3>
                                        </div>

                                        <div>
                                            <p class="fs-6 fw-semibold mb-4">I verify that the above Information is accurate and complete.</p>
                                        </div>
                                        <div class="row row-cols-lg-2 g-10">


                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Signature</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ old('parent_signature', optional($kid->emergencyInformation)->parent_signature) }}" name="parent_signature" />
                                                    <!--end::Input-->
                                                    @error('parent_signature')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="date" value="{{ old('parent_signature_date', optional($kid->emergencyInformation)->parent_signature_date ? date('Y-m-d', strtotime(optional($kid->emergencyInformation)->parent_signature_date)) : ''  ) }}" name="parent_signature_date" />

                                                    <!--end::Input-->
                                                    @error('parent_signature_date')
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


@endsection