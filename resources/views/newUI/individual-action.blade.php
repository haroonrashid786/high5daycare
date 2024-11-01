@extends('layouts.app')
@section('title', 'Individual Action | High5 Daycare')
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
                            <span>Individual Action</span>
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
                        <li class="breadcrumb-item text-white">Individual Action</li>
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
                            <form class="form" method="POST" id="kt_modal_add_event_form" action="{{route('add.kid.individual.action',['kid' => $kid->id])}}">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Individual action plan for child with
                                    identified medical condition</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">

                                    <div class="mb-12">

                                        <div class="rounded p-4 border mb-6 h6">
                                            This form must be completed and returned to the provider for children with
                                            any observed special requirements in respect of diet, rest or physical
                                            activity.
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <div class="row row-cols-2">
                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Child's Name
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="child_name" placeholder="" value="{{ old('child_name', optional($kid->individualPlan)->child_name) ?: $kid->full_name }}">
                                                    @error('child_name')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Child's Home Address
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="child_home_address" placeholder="" value="{{ old('child_name', optional($kid->individualPlan)->child_home_address) ?: Auth::user()->parent->address ?? $kid->parent->address }}">
                                                    @error('child_home_address')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Phone #
                                                    </label>
                                                    <!--end::Label-->
                                                    <div class="bg-gray-100 rounded d-flex align-items-center">
                                                        <div class="px-5 fw-bold">+1</div>
                                                        <input type="text" class="form-control form-control-solid" name="phone" placeholder="" value="{{ old('phone', optional($kid->individualPlan)->phone) ?: Auth::user()->parent->phone_number ?? '' }}">
                                                    </div>
                                                    @error('phone')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <div class="row row-cols-2">
                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Child Care Provider
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="child_care_provider" placeholder="" value="{{ old('child_care_provider', optional($kid->individualPlan)->child_care_provider) ?: $kid->provider->name }}">
                                                    @error('child_care_provider')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Child Care Address
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="child_care_address" placeholder="" value="{{ old('child_care_address', optional($kid->individualPlan)->child_care_address) ?: $kid->provider->address }}">
                                                    @error('child_care_address')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Phone #
                                                    </label>
                                                    <!--end::Label-->
                                                    <div class="bg-gray-100 rounded d-flex align-items-center">
                                                        <div class="px-5 fw-bold">+1</div>
                                                        <input type="number" class="form-control form-control-solid" name="child_care_phone" placeholder="" value="{{ old('child_care_phone', optional($kid->individualPlan)->child_care_phone) ?: $kid->provider->phone_number }}">
                                                    </div>
                                                    @error('child_care_phone')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="rounded p-4 border mb-6">
                                            <label class="d-flex align-items-center fs-4 fw-semibold mb-2">
                                                INFORMATION RE: MEDICAL CONDITION(S)
                                            </label>
                                            <div class="row row-cols-2">
                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Known Medical Conditions(s):
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" value="{{ old('medical_condition') }}" name="medical_condition" placeholder="">
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Symptoms:
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="symptoms" value="{{ old('symptoms') }}" placeholder="">
                                                </div>
                                                @error('symptoms')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="row row-cols-2 mt-6">
                                                    <div class="mb-2 fv-row">
                                                        <input type="checkbox" name="acute" value="1" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->individualPlan)->acute == 1) checked @endif>
                                                        <span class="form-check-label fw-semibold">Acute </span>
                                                    </div>
                                                    <div class="mb-2 fv-row">
                                                        <input type="checkbox" name="chronic" value="0" class="form-check-input h-20px w-20px" @if(isset($kid) && optional($kid->individualPlan)->acute == 0) checked @endif>
                                                        <span class="form-check-label fw-semibold">Chronic </span>
                                                    </div>
                                                </div>
                                                <div class="row col-12 mt-6">
                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Triggers, if any (i.e. allergen, food, dust, animal, exercise, excitement, times of occurrence, etc.)
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid" name="triggers" value="{{ old('triggers') }}" placeholder="">
                                                    </div>
                                                    @error('triggers')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="row col-12 mt-6">
                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Any other information related to medical condition/protocol (i.e. what reduces symptoms, calms child, how to avoid an occurrence, etc.)
                                                        </label>
                                                        <!--end::Label-->
                                                        <textarea name="other_information" id="" class="form-control form-control-solid">{{ old('other_information') }}</textarea>
                                                    </div>
                                                    @error('other_information')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="row col-12 mt-6">
                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Daily modifications required for child:
                                                        </label>
                                                        <!--end::Label-->
                                                        <textarea name="daily_modification" id="" class="form-control form-control-solid">{{ old('daily_modification') }}</textarea>
                                                    </div>
                                                    @error('daily_modification')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="row col-12 mt-6">
                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            A description of any medical devices used by the child and any instructions related to its use:
                                                        </label>
                                                        <!--end::Label-->
                                                        <textarea name="medical_devices" id="" class="form-control form-control-solid">{{ old('medical_devices') }}</textarea>
                                                    </div>
                                                    @error('medical_devices')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="row col-12 mt-6">
                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Support that available to the child:
                                                        </label>
                                                        <!--end::Label-->
                                                        <textarea name="support" id="" class="form-control form-control-solid">{{ old('support') }}</textarea>

                                                    </div>
                                                    @error('support')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="row col-12 mt-6">
                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Procedure to Follow during an Evacuation:
                                                        </label>
                                                        <!--end::Label-->
                                                        <textarea name="evacuation_procedure" id="" class="form-control form-control-solid">{{ old('evacuation_procedure') }}</textarea>
                                                    </div>
                                                    @error('evacuation_procedure')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" mt-6">
                                            <h1 class="h5">ACTION PLAN</h1>
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <p>In the event that</p>
                                                <input type="text" class="form-control form-control-solid w-175px" name="observed_requirements" placeholder="" value="{{ old('observed_requirements', optional($kid->individualPlan)->observed_requirements) ?: '' }}">
                                                @error('observed_requirements')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <p>will: (please check all)</p>
                                                <input type="text" class="form-control form-control-solid w-175px" name="call_parent_guardian" placeholder="" value="{{ old('call_parent_guardian', optional($kid->individualPlan)->call_parent_guardian) ?: '' }}">
                                                @error('call_parent_guardian')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <p>Call parent/guardian</p>
                                            </div>

                                            <div class="rounded p-4 border mt-6">
                                                <div class="row row-cols-2">
                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Parent/Guardian Name
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid" name="parent_guardian_name" placeholder="" value="{{ old('parent_guardian_name', optional($kid->individualPlan)->parent_guardian_name) ?: $kid->parent->name }}">
                                                        @error('parent_guardian_name')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="d-flex flex-column fv-row mt-6">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Phone (W)
                                                        </label>
                                                        <!--end::Label-->
                                                        <div class="bg-gray-100 rounded d-flex align-items-center">
                                                            <div class="px-5 fw-bold">+1</div>
                                                            <input type="number" class="form-control form-control-solid" name="parent_guardian_phone_work" placeholder="" value="{{ old('parent_guardian_phone_work', optional($kid->individualPlan)->parent_guardian_phone_work) ?: '' }}">
                                                        </div>
                                                        @error('parent_guardian_phone_work')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Phone (C)
                                                        </label>
                                                        <!--end::Label-->
                                                        <div class="bg-gray-100 rounded d-flex align-items-center">
                                                            <div class="px-5 fw-bold">+1</div>
                                                            <input type="number" class="form-control form-control-solid" name="parent_guardian_phone_cell" placeholder="" value="{{ old('parent_guardian_phone_cell', optional($kid->individualPlan)->parent_guardian_phone_cell) ?: '' }}">
                                                        </div>
                                                        @error('parent_guardian_phone_cell')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Phone (H)
                                                        </label>
                                                        <!--end::Label-->
                                                        <div class="bg-gray-100 rounded d-flex align-items-center">
                                                            <div class="px-5 fw-bold">+1</div>
                                                            <input type="number" class="form-control form-control-solid" name="parent_guardian_phone_home" placeholder="" value="{{ old('parent_guardian_phone_home', optional($kid->individualPlan)->parent_guardian_phone_home) ?: '' }}">
                                                        </div>
                                                        @error('parent_guardian_phone_home')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="rounded p-4 border mt-6">
                                                <div class="row row-cols-2">
                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Parent/Guardian Name
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid" name="emergency_contact_name" placeholder="" value="{{ old('emergency_contact_name', optional($kid->individualPlan)->emergency_contact_name) ?: '' }}">
                                                        @error('emergency_contact_name')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="d-flex flex-column fv-row mt-6">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Phone (W)
                                                        </label>
                                                        <!--end::Label-->
                                                        <div class="bg-gray-100 rounded d-flex align-items-center">
                                                            <div class="px-5 fw-bold">+1</div>
                                                            <input type="number" class="form-control form-control-solid" name="emergency_contact_phone_work" placeholder="" value="{{ old('emergency_contact_phone_work', optional($kid->individualPlan)->emergency_contact_phone_work) ?: '' }}">
                                                        </div>
                                                        @error('emergency_contact_phone_work')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Phone (C)
                                                        </label>
                                                        <!--end::Label-->
                                                        <div class="bg-gray-100 rounded d-flex align-items-center">
                                                            <div class="px-5 fw-bold">+1</div>
                                                            <input type="number" class="form-control form-control-solid" name="emergency_contact_phone_cell" placeholder="" value="{{ old('emergency_contact_phone_cell', optional($kid->individualPlan)->emergency_contact_phone_cell) ?: '' }}">
                                                        </div>
                                                        @error('emergency_contact_phone_cell')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Phone (H)
                                                        </label>
                                                        <!--end::Label-->
                                                        <div class="bg-gray-100 rounded d-flex align-items-center">
                                                            <div class="px-5 fw-bold">+1</div>
                                                            <input type="number" class="form-control form-control-solid" name="emergency_contact_phone_home" placeholder="" value="{{ old('emergency_contact_phone_home', optional($kid->individualPlan)->emergency_contact_phone_home) ?: '' }}">
                                                        </div>
                                                        @error('emergency_contact_phone_home')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-wrap gap-3 align-items-center mt-6">
                                                <p class="mb-0">Call 911</p>
                                                <input type="text" class="form-control form-control-solid w-175px" name="call_911" placeholder="" value="{{ old('call_911', optional($kid->individualPlan)->call_911) ?: '' }}">
                                                @error('call_911')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                <p class="mb-0">Call the child's doctor</p>
                                                <input type="text" class="form-control form-control-solid w-175px" name="call_doctor" placeholder="" value="{{ old('call_doctor', optional($kid->individualPlan)->call_doctor) ?: '' }}">
                                                @error('call_doctor')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="rounded p-4 border mt-6">
                                                <p class="h5 mb-5">Call the child’s doctor</p>
                                                <div class="row row-cols-2">
                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Dr’s Name
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid" name="doctor_name" placeholder="" value="{{ old('doctor_name', optional($kid->individualPlan)->doctor_name) ?: ''}}">
                                                        @error('doctor_name')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            Phone
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid" name="doctor_phone" placeholder="" value="{{ old('doctor_phone', optional($kid->individualPlan)->doctor_phone) ?: '' }}">
                                                        @error('doctor_phone')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="d-flex flex-column fv-row">
                                                    <p class="mb-3 mt-5 h5">Administer the following medication: Name of medication</p>
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Name of medication
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="medication_name" placeholder="" value="{{ old('medication_name', optional($kid->individualPlan)->medication_name) ?: '' }}">
                                                    @error('medication_name')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>


                                        <div class="rounded p-4 border my-6">
                                            <div class="d-flex flex-column fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Dose
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="dose" placeholder="" value="{{ old('dose', optional($kid->individualPlan)->dose) ?: '' }}">
                                                @error('dose')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="d-flex flex-column fv-row my-4">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Signature
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="signature" placeholder="" value="{{ old('signature', optional($kid->individualPlan)->signature) ?: '' }}">
                                                @error('signature')
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
                                                <input type="date" class="form-control form-control-solid" name="date" placeholder="" value="{{ old('date', optional($kid->individualPlan)->date ? date('Y-m-d', strtotime(optional($kid->individualPlan)->date)) : ''  ) }}">
                                                @error('date')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
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