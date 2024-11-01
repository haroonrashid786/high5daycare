@extends('layouts.app')
@section('title', 'Child Enrolment Form | High5 Daycare')
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
                            <span>Child Enrolment </span>
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-[#fff] fw-bold lh-1">
                            <a @role('Admin') href="{{ route('admin.home') }}" @elserole('Franchise')
                                href="{{ route('provider.home') }}" @else href="{{ route('parent.home') }}" @endrole
                                class="text-white text-hover-primary">
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
                        <li class="breadcrumb-item text-white">Child Enrolment</li>
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
                            <form class="form" action="{{ route('add.kid.enrollement.form',[ 'kid' => $kid->id]) }}" method="POST" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->

                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">

                                    <div class="mb-12">

                                        <div class="rounded p-4 border mb-6">
                                            <div class="row  row-cols-2 ">
                                                <div class="d-flex flex-column col-12 col-md-6  fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Surname:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="surname" value="{{ old('surname', optional($kid->enrollementForm)->surname) }}" placeholder="">
                                                </div>
                                                @error('surname')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                <div class="d-flex flex-column col-12 col-md-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Given Name:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="given_name" value="{{ old('given_name', optional($kid->enrollementForm)->given_name) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('given_name')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                <div class="p-4 col-12 col-md-6">
                                                    <p class='fs-6 fw-semibold'>Sex:</p>

                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input type="radio" name="sex"  value="male" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->sex == 'male') checked @endif>
                                                            <span class="form-check-label fw-semibold">Male</span>
                                                        </div>
                                                        <div>
                                                            <input type="radio" name="sex" value="female" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->sex == 'female') checked @endif>
                                                            <span class="form-check-label fw-semibold">Female</span>
                                                        </div>
                                                    </div>
                                                    @error('sex')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-12 col-md-6 fv-row mt-6">
                                                    <label class="required fs-6 fw-semibold mb-2">Date of Birth(mm/dd/yyyy)</label>
                                                    <!--begin::Input-->
                                                    <div class="position-relative d-flex align-items-center">
                                                        <!--begin::Icon-->
                                                        <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Datepicker-->
                                                        <input type="date" class="form-control form-control-solid ps-12" value="{{ old('date_of_birth', optional($kid->enrollementForm)->date_of_birth) }}" placeholder="Select a date" name="date_of_birth">
                                                        <!--end::Datepicker-->

                                                    </div>
                                                    @error('date_of_birth')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <!--end::Input-->
                                                </div>

                                                <div class="p-4 col-12 col-sm-6">
                                                    <p class='fs-6 fw-semibold'>Special Need:</p>

                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input type="radio" name="special_need" value="1" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->special_need == 1) checked @endif>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input type="radio" name="special_need" value="0" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->special_need == 0) checked @endif>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                    @error('special_need')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="p-4 col-12 col-sm-6">
                                                    <p class='fs-6 fw-semibold'>Allergies(Life Threatening):</p>

                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input type="radio" name="allergies_life_threatening" value="1" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->allergies_life_threatening == 1) checked @endif>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input type="radio" name="allergies_life_threatening" value="0" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->allergies_life_threatening == 0) checked @endif>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                    @error('allergies_life_threatening')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="p-4 col-12 col-sm-6">
                                                    <p class='fs-6 fw-semibold'>Allergies (Non-Life Threatening)</p>

                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input type="radio" value="1" name="allergies_non_life_threatening" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->allergies_non_life_threatening == 1) checked @endif>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input type="radio" value="0" name="allergies_non_life_threatening" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->allergies_non_life_threatening == 0) checked @endif>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                    @error('allergies_non_life_threatening')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="p-4 col-12 col-sm-6">
                                                    <p class='fs-6 fw-semibold'>Medical / Skin Condition:</p>

                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input type="radio" name="medical_condition" value="1" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->medical_condition == 1) checked @endif>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input type="radio" name="medical_condition" value="0" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->medical_condition == 0) checked @endif>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                    @error('medical_condition')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="p-4 col-12 col-sm-6">
                                                    <p class='fs-6 fw-semibold'>Potty Trained:</p>

                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input type="radio" name="potty_trained" value="1" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->potty_trained == 1) checked @endif>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input type="radio" name="potty_trained" value="0" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->potty_trained == 0) checked @endif>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                    @error('potty_trained')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="p-4 col-12">
                                                    <p class='fs-6 fw-semibold'>Does you child have any special feeding arrangements (e.g: sippy cups, mashed/puree food/ milk)s Does your child have any special dietary requirements /restrictions (e.g.: vegetarian, kosher , Halal) Does you child need eats independently :</p>

                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input type="radio" name="special_feeding_arrangements" value="1" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->special_feeding_arrangements == 1) checked @endif>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input type="radio" name="special_feeding_arrangements" value="0" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->special_feeding_arrangements == 0) checked @endif>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                    @error('special_feeding_arrangements')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="d-flex flex-column mb-6 col-12 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Please explain, if there is anyother concern:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="extra_concern" value="{{ old('extra_concern', optional($kid->enrollementForm)->extra_concern) }}" placeholder="">
                                                </div>
                                                @error('extra_concern')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="rounded p-4 border mb-6">
                                            <h2 class="">Mother</h2>
                                            <div class="row row-cols-md-2 row-cols-1 ">
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Surname:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="mother_surname" value="{{ old('mother_surname', optional($kid->enrollementForm)->mother_surname) }}" placeholder="">
                                                </div>
                                                @error('mother_surname')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Given Name:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="mother_given_name" value="{{ old('mother_given_name', optional($kid->enrollementForm)->mother_given_name) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('mother_given_name')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 col-12 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Home Address:
                                                    </label>
                                                    <!--end::Label-->
                                                    <textarea name="mother_home_address" id="" class="form-control form-control-solid">{{ old('mother_home_address', optional($kid->enrollementForm)->mother_home_address) }}</textarea>
                                                </div>
                                                @error('mother_home_address')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Postal code:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="mother_postal_code" value="{{ old('mother_postal_code', optional($kid->enrollementForm)->mother_postal_code) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('mother_postal_code')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Cell Phone:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="mother_cell_phone" value="{{ old('mother_cell_phone', optional($kid->enrollementForm)->mother_cell_phone) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('mother_cell_phone')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Home Phone:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="mother_home_phone" value="{{ old('mother_home_phone', optional($kid->enrollementForm)->mother_home_phone) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('mother_home_phone')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Place of Work:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="mother_work_place" value="{{ old('mother_work_place', optional($kid->enrollementForm)->mother_work_place) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('mother_work_place')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 col-12 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Work of Address:
                                                    </label>
                                                    <!--end::Label-->
                                                    <textarea id="" name="mother_work_address" class="form-control form-control-solid">{{ old('mother_work_address', optional($kid->enrollementForm)->mother_work_address) }}</textarea>
                                                </div>
                                                @error('mother_work_address')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Work Phone:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="mother_work_phone" value="{{ old('mother_work_phone', optional($kid->enrollementForm)->mother_work_phone) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('mother_work_phone')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Email:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="mail" name="mother_email" value="{{ old('mother_email', optional($kid->enrollementForm)->mother_email) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('mother_email')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="col-md-6 fv-row mt-6">
                                                    <label class="required fs-6 fw-semibold mb-2">Date of Birth</label>
                                                    <!--begin::Input-->
                                                    <div class="position-relative d-flex align-items-center">
                                                        <!--begin::Icon-->
                                                        <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Datepicker-->
                                                        <input type="date" class="form-control form-control-solid ps-12" placeholder="Select a date" value="{{ old('mother_date_of_birth', optional($kid->enrollementForm)->mother_date_of_birth) }}" name="mother_date_of_birth">
                                                        <!--end::Datepicker-->

                                                    </div>
                                                    @error('mother_date_of_birth')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <!--end::Input-->
                                                </div>

                                                <div class="p-4 mb-6">
                                                    <p class='fs-6 fw-semibold'>Custody:</p>

                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input type="radio" name="mother_custody" value="1" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->mother_custody == 1) checked @endif>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input type="radio" name="mother_custody" value="0" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->mother_custody == 10) checked @endif>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                    @error('mother_custody')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <h2 class="">Father</h2>
                                            <div class="row row-cols-md-2 row-cols-1 ">
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Surname:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="father_surname" value="{{ old('father_surname', optional($kid->enrollementForm)->father_surname) }}" placeholder="">
                                                </div>
                                                @error('father_surname')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Given Name:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="father_given_name" value="{{ old('father_given_name', optional($kid->enrollementForm)->father_given_name) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('father_given_name')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 col-12 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Home Address:
                                                    </label>
                                                    <!--end::Label-->
                                                    <textarea name="father_home_address" id="" class="form-control form-control-solid">{{ old('father_home_address', optional($kid->enrollementForm)->father_home_address) }}</textarea>
                                                </div>
                                                @error('father_home_address')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Postal code:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="father_postal_code" value="{{ old('father_postal_code', optional($kid->enrollementForm)->father_postal_code) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('father_postal_code')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Cell Phone:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="father_cell_phone" value="{{ old('father_cell_phone', optional($kid->enrollementForm)->father_cell_phone) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('father_cell_phone')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Home Phone:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="father_home_phone" value="{{ old('father_home_phone', optional($kid->enrollementForm)->father_home_phone) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('father_home_phone')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Place of Work:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="father_work_place" value="{{ old('father_work_place', optional($kid->enrollementForm)->father_work_place) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('father_work_place')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 col-12 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Work of Address:
                                                    </label>
                                                    <!--end::Label-->
                                                    <textarea id="" name="father_work_address" class="form-control form-control-solid">{{ old('father_work_address', optional($kid->enrollementForm)->father_work_address) }}</textarea>
                                                </div>
                                                @error('father_work_address')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Work Phone:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="father_work_phone" value="{{ old('father_work_phone', optional($kid->enrollementForm)->father_work_phone) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('father_work_phone')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Email:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="mail" name="father_email" value="{{ old('father_email', optional($kid->enrollementForm)->father_email) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('father_email')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="col-md-6 fv-row mt-6">
                                                    <label class="required fs-6 fw-semibold mb-2">Date of Birth</label>
                                                    <!--begin::Input-->
                                                    <div class="position-relative d-flex align-items-center">
                                                        <!--begin::Icon-->
                                                        <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Datepicker-->
                                                        <input type="date" class="form-control form-control-solid ps-12" placeholder="Select a date" value="{{ old('father_date_of_birth', optional($kid->enrollementForm)->father_date_of_birth) }}" name="father_date_of_birth">
                                                        <!--end::Datepicker-->

                                                    </div>
                                                    @error('father_date_of_birth')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <!--end::Input-->
                                                </div>

                                                <div class="p-4 mb-6">
                                                    <p class='fs-6 fw-semibold'>Custody:</p>

                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input type="radio" name="father_custody" value="1" class="form-check-input h-20px w-20px"  @if(isset($kid) && optional($kid->enrollementForm)->father_custody == 1) checked @endif>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input type="radio" name="father_custody" value="0" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->father_custody == 0) checked @endif>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                    @error('father_custody')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="rounded p-4 border mb-6">
                                            <div class="row row-cols-md-2 row-cols-1 ">
                                                <div class="p-4 mb-6">
                                                    <p class='fs-6 fw-semibold'>Type of Care:</p>

                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input type="radio" name="type_of_care" value="parttime" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->type_of_care == 'parttime') checked @endif>
                                                            <span class="form-check-label fw-semibold">Part Time </span>
                                                        </div>
                                                        <div>
                                                            <input type="radio" name="type_of_care" value="fulltime" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->type_of_care == 'fulltime') checked @endif >
                                                            <span class="form-check-label fw-semibold">Full Time</span>
                                                        </div>
                                                        <div>
                                                            <input type="radio" name="type_of_care" value="before/after" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->enrollementForm)->type_of_care == 'before/after') checked @endif >
                                                            <span class="form-check-label fw-semibold">Before / After School</span>
                                                        </div>
                                                    </div>
                                                    @error('type_of_care')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Start Date:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="date" name="start_date" value="{{ old('start_date', optional($kid->enrollementForm)->start_date) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('start_date')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Days of Care:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="days_of_care" value="{{ old('days_of_care', optional($kid->enrollementForm)->days_of_care) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('days_of_care')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Term Date:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="date" name="term_date" value="{{ old('term_date', optional($kid->enrollementForm)->term_date) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('term_date')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Hours of Care:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="house_of_care" value="{{ old('house_of_care', optional($kid->enrollementForm)->house_of_care) }}" class="form-control form-control-solid">
                                                </div>

                                                @error('house_of_care')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <div class="row row-cols-md-2 row-cols-1 ">
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Parent Sign:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="parent_sign" value="{{ old('parent_sign', optional($kid->enrollementForm)->parent_sign) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('parent_sign')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Provider Sign:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="provider_sign" value="{{ old('provider_sign', optional($kid->enrollementForm)->parent_sign) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('provider_sign')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Agency Sign:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="agency_sign" value="{{ old('agency_sign', optional($kid->enrollementForm)->agency_sign) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('agency_sign')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        OFFICE USE ONLY: Child File No:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="chiled_file_number" value="{{ old('chiled_file_number', optional($kid->enrollementForm)->chiled_file_number) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('chiled_file_number')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="d-flex flex-column mb-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Deposit Amount :
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" name="deposit_amount" value="{{ old('deposit_amount', optional($kid->enrollementForm)->deposit_amount) }}" class="form-control form-control-solid">
                                                </div>
                                                @error('deposit_amount')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
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

                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->

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


@endsection