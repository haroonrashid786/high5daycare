@extends('layouts.app')
@section('title', 'Release Information | High5 Daycare')
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
                            <span>Release Information</span>
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
                        <li class="breadcrumb-item text-white">Release Information</li>
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
                            <form class="form" action="{{route('add.kid.release',['kid'=> $kid->id])}}" method="POST" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Release Information</h2>
                                <p class="text-muted fw-semibold fs-5">(Use for both Prescription & Non-Prescription medications, if needed, otherwise please keep a copy of it when needed and don’t fill at this moment) </p>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">

                                    <div class="mb-12">
                                        <div class="row row-cols-2 mt-8">
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Child's Name
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('child_name', $kid->full_name) }}" name="child_name">
                                                @error('child_name')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="row row-cols-2 mt-8 border rounded p-3">

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Name
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('name', optional($kid->releaseInformation)->name) }}" name="name">
                                                @error('name')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Home Address
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('home_address', optional($kid->releaseInformation)->home_address) }}" name="home_address">
                                                @error('home_address')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Relationship
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('relationship', optional($kid->releaseInformation)->relationship) }}" name="relationship">
                                                @error('relationship')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Place of work
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('place_of_work', optional($kid->releaseInformation)->place_of_work) }}" name="place_of_work">
                                                @error('place_of_work')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Work Address
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('work_address', optional($kid->releaseInformation)->work_address) }}" name="work_address">
                                                @error('work_address')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Cell #
                                                </label>
                                                <!--end::Label-->
                                                <div class="bg-gray-100 rounded d-flex align-items-center">
                                                    <div class="px-5 fw-bold">+1</div>
                                                    <input type="number" class="form-control form-control-solid" placeholder="" value="{{ old('cell_number', optional($kid->releaseInformation)->cell_number) }}" name="cell_number">
                                                </div>
                                                @error('cell_number')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Phone #
                                                </label>
                                                <!--end::Label-->
                                                <div class="bg-gray-100 rounded d-flex align-items-center">
                                                    <div class="px-5 fw-bold">+1</div>
                                                    <input type="number" class="form-control form-control-solid" placeholder="" value="{{ old('phone_number', optional($kid->releaseInformation)->phone_number) }}" name="phone_number">
                                                </div>
                                                @error('phone_number')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    W #
                                                </label>
                                                <!--end::Label-->
                                                <div class="bg-gray-100 rounded d-flex align-items-center">
                                                    <div class="px-5 fw-bold">+1</div>
                                                    <input type="number" class="form-control form-control-solid" placeholder="" value="{{ old('work_number', optional($kid->releaseInformation)->work_number) }}" name="work_number">
                                                </div>
                                                @error('work_number')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Special Instructions for release
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('special_instructions', optional($kid->releaseInformation)->special_instructions) }}" name="special_instructions">
                                                @error('special_instructions')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row row-cols-2 mt-8 border rounded p-3">

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Name
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('name_2', optional($kid->releaseInformation)->name_2) }}" name="name_2">
                                                @error('name_2')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Home Address
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('home_address_2', optional($kid->releaseInformation)->home_address_2) }}" name="home_address_2">
                                                @error('home_address_2')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Relationship
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('relationship_2', optional($kid->releaseInformation)->relationship_2) }}" name="relationship_2">
                                                @error('relationship_2')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Place of work
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('place_of_work_2', optional($kid->releaseInformation)->place_of_work_2) }}" name="place_of_work_2">
                                                @error('place_of_work_2')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Work Address
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('work_address_2', optional($kid->releaseInformation)->work_address_2) }}" name="work_address_2">
                                                @error('work_address_2')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Cell #
                                                </label>
                                                <!--end::Label-->
                                                <div class="bg-gray-100 rounded d-flex align-items-center">
                                                    <div class="px-5 fw-bold">+1</div>
                                                    <input type="number" class="form-control form-control-solid" placeholder="" value="{{ old('cell_number_2', optional($kid->releaseInformation)->cell_number_2) }}" name="cell_number_2">
                                                </div>
                                                @error('cell_number_2')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Phone #
                                                </label>
                                                <!--end::Label-->
                                                <div class="bg-gray-100 rounded d-flex align-items-center">
                                                    <div class="px-5 fw-bold">+1</div>
                                                    <input type="number" class="form-control form-control-solid" placeholder="" value="{{ old('phone_number_2', optional($kid->releaseInformation)->phone_number_2) }}" name="phone_number_2">
                                                </div>
                                                @error('phone_number_2')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    W #
                                                </label>
                                                <!--end::Label-->
                                                <div class="bg-gray-100 rounded d-flex align-items-center">
                                                    <div class="px-5 fw-bold">+1</div>
                                                    <input type="number" class="form-control form-control-solid" placeholder="" value="{{ old('work_number_2', optional($kid->releaseInformation)->work_number_2) }}" name="work_number_2">
                                                </div>
                                                @error('work_number_2')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Special Instructions for release
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('special_instructions_2', optional($kid->releaseInformation)->special_instructions_2) }}" name="special_instructions_2">
                                                @error('special_instructions_2')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row row-cols-2 mt-8 border rounded p-3">

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Name
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('name_3', optional($kid->releaseInformation)->name_3) }}" name="name_3">
                                                @error('name_3')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Home Address
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('home_address_3', optional($kid->releaseInformation)->home_address_3) }}" name="home_address_3">
                                                @error('home_address_3')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Relationship
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('relationship_3', optional($kid->releaseInformation)->relationship_3) }}" name="relationship_3">
                                                @error('relationship_3')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Place of work
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('place_of_work_3', optional($kid->releaseInformation)->place_of_work_3) }}" name="place_of_work_3">
                                                @error('place_of_work_3')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Work Address
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('work_address_3', optional($kid->releaseInformation)->work_address_3) }}" name="work_address_3">
                                                @error('work_address_3')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Cell #
                                                </label>
                                                <!--end::Label-->
                                                <div class="bg-gray-100 rounded d-flex align-items-center">
                                                    <div class="px-5 fw-bold">+1</div>
                                                    <input type="number" class="form-control form-control-solid" placeholder="" value="{{ old('cell_number_3', optional($kid->releaseInformation)->cell_number_3) }}" name="cell_number_3">
                                                </div>
                                                @error('cell_number_3')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Phone #
                                                </label>
                                                <!--end::Label-->
                                                <div class="bg-gray-100 rounded d-flex align-items-center">
                                                    <div class="px-5 fw-bold">+1</div>
                                                    <input type="number" class="form-control form-control-solid" placeholder="" value="{{ old('phone_number_3', optional($kid->releaseInformation)->phone_number_3) }}" name="phone_number_3">
                                                </div>
                                                @error('phone_number_3')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    W #
                                                </label>
                                                <!--end::Label-->
                                                <div class="bg-gray-100 rounded d-flex align-items-center">
                                                    <div class="px-5 fw-bold">+1</div>
                                                    <input type="number" class="form-control form-control-solid" placeholder="" value="{{ old('work_number_3', optional($kid->releaseInformation)->work_number_3) }}" name="work_number_3">
                                                </div>
                                                @error('work_number_3')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Special Instructions for release
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('special_instructions_3', optional($kid->releaseInformation)->special_instructions_3) }}" name="special_instructions_3">
                                                @error('special_instructions_3')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="mt-8 border rounded px-4 py-3">
                                            <p class="m-0">Authorization: I, <input type="text" class="form-control form-control-solid" value="{{ old('authorization_name', optional($kid->releaseInformation)->authorization_name) }}" name="authorization_name"> am
                                                @error('authorization_name')
                                            <div style="color: red;">
                                                {{ $message }}
                                            </div>
                                            @enderror

                                            <input type="text" class="form-control form-control-solid" value="{{ old('authorization_relationship', optional($kid->releaseInformation)->authorization_relationship) }}" name="authorization_relationship">
                                            @error('authorization_relationship')
                                            <div style="color: red;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            to the child(ren) listed above and I give my permission to the persons listed on this form within the restrictions (if any) to pick up my child(ren) from any High5 Daycare licensed home. Please bring photo ID on arrival </p>
                                            <div class="row row-cols-2 mt-8">
                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Signature
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" placeholder="" value="{{ old('authorization_signature', optional($kid->releaseInformation)->authorization_signature) }}" name="authorization_signature">
                                                    @error('authorization_signature')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Date
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="date" class="form-control form-control-solid" placeholder="" value="{{ old('authorization_date', optional($kid->releaseInformation)->authorization_date ? date('Y-m-d', strtotime(optional($kid->releaseInformation)->authorization_date)) : '') }}" name="authorization_date">
                                                    @error('authorization_date')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    @role('Parent','Franchise')
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
                                    @endrole

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