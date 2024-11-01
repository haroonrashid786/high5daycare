@extends('layouts.app')
@section('title', 'Medication Consent | High5 Daycare')
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
                            <span>Medication Consent</span>
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
                        <li class="breadcrumb-item text-white">Medication Consent</li>
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
                            <form class="form" action="{{route('add.kid.medication',['kid' => $kid->id])}}" method="POST" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Medication Consent & Record</h2>
                                <p class="text-muted fw-semibold fs-5">(Use for both Prescription & Non-Prescription medications, if needed, otherwise please keep a copy of it when needed and don’t fill at this moment) </p>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">
                                    
                                    <div class="mb-12">
                                        <div class="row row-cols-2 mt-8 vehicle">
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Child's Name
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="child_name" placeholder="" value="{{ old('child_name', optional($kid->medicationConsent)->child_name) ?: $kid->full_name }}">
                                                    @error('child_name')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Address: 
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="address" value="{{ old('address', optional($kid->medicationConsent)->address) ?: '' }}">
                                                @error('address')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>

                                            
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Physician’ Name
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="physician_name" value="{{ old('physician_name', optional($kid->medicationConsent)->physician_name) ?: '' }}">
                                                @error('physician_name')
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
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="phone_number" value="{{ old('phone_number', optional($kid->medicationConsent)->phone_number) ?: '' }}">
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
                                                    Name of Medication
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder=""  name="medication_name" value="{{ old('medication_name', optional($kid->medicationConsent)->medication_name) ?: '' }}">
                                                @error('medication_name')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Date Medication Prescribed
                                                </label>
                                                <!--end::Label-->
                                                <input type="date" class="form-control form-control-solid" name="medication_prescribed_date" placeholder="" value="{{ old('medication_prescribed_date', optional($kid->medicationConsent)->medication_prescribed_date ? date('Y-m-d', strtotime(optional($kid->medicationConsent)->medication_prescribed_date)) : ''  ) }}">
                                                @error('medication_prescribed_date')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Start Date
                                                </label>
                                                <!--end::Label-->
                                                <input type="date" class="form-control form-control-solid" name="start_date" placeholder="" value="{{ old('start_date', optional($kid->medicationConsent)->start_date ? date('Y-m-d', strtotime(optional($kid->medicationConsent)->start_date)) : ''  ) }}">
                                                @error('start_date')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                            
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    End Date
                                                </label>
                                                <!--end::Label-->
                                                <input type="date" class="form-control form-control-solid" name="end_date" placeholder="" value="{{ old('end_date', optional($kid->medicationConsent)->end_date ? date('Y-m-d', strtotime(optional($kid->medicationConsent)->end_date)) : ''  ) }}">
                                                @error('end_date')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                            
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Dosage of Medication Prescribed
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="dosage" value="{{ old('dosage', optional($kid->medicationConsent)->dosage) ?: '' }}">
                                                @error('dosage')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                            
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Times given by the Parent
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="parent_times_given" value="{{ old('parent_times_given', optional($kid->medicationConsent)->parent_times_given) ?: '' }}">
                                                @error('parent_times_given')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                            
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 ">
                                                    Times to be given by Provider
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="provider_times_given" value="{{ old('provider_times_given', optional($kid->medicationConsent)->provider_times_given) ?: '' }}">
                                                @error('provider_times_given')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 ">
                                                    Amount to be given by Provider
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="provider_amount_given" value="{{ old('provider_amount_given', optional($kid->medicationConsent)->provider_amount_given) ?: '' }}">
                                                @error('provider_amount_given')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 ">
                                                    Storage Instructions (INACCESSIBLE TO CHILDREN)
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="storage_instructions" value="{{ old('storage_instructions', optional($kid->medicationConsent)->storage_instructions) ?: '' }}">
                                                @error('storage_instructions')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 ">
                                                    Discontinue medication if you notice any of these possible Side Effects:
                                                </label>
                                                <!--end::Label-->
                                                <textarea type="text" class="form-control form-control-solid" placeholder="" name="side_effects">{{ old('side_effects', optional($kid->medicationConsent)->side_effects) ?: '' }}</textarea>
                                                @error('side_effects')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>

                                        </div>

                                        <div class="d-flex align-items-center gap-3 flex-wrap">
                                            <p>I authorize the administration of the above medication to my child by the High5  Provider,</p>
                                            <input type="text" class="d-inline-block form-control form-control-solid" placeholder="">
                                            <p>as outlined above. </p>
                                        </div>

                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 ">
                                                Parent’s Signature
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" class="form-control form-control-solid" placeholder="" name="parent_signature" value="{{ old('parent_signature', optional($kid->medicationConsent)->parent_signature) ?: '' }}">
                                            @error('parent_signature')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                        </div>

                                        <div class="cardcard-flush h-lg-100">
                                            <!--begin::Header-->
                                            <div class="card-header p-0">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-gray-800">DISPENSING RECORD </span>
                                                </h3>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body pt-6 p-0">
                                                <!--begin::Table container-->
                                                <div class="table-responsive">
                                                    <!--begin::Table-->
                                                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                                                <th class="p-0 pb-3 min-w-175px text-start">Date</th>
                                                                <th class="p-0 pb-3 min-w-100px">Item Given</th>
                                                                <th class="p-0 pb-3 min-w-100px">Dosage</th>
                                                                <th class="p-0 pb-3 min-w-150px pe-12">Signature</th>
                                                                <th class="p-0 pb-3 w-125px pe-7">Observations</th>
                                                                <th class="p-0 pb-3 w-50px">View</th>
                                                            </tr>
                                                        </thead>
                                                        <!--end::Table head-- 
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            @if(isset($kid->medicationConsent->dispensingRecords) && !empty($kid->medicationConsent->dispensingRecords) && count($kid->medicationConsent->dispensingRecords) > 0)
                                                            @foreach($kid->medicationConsent->dispensingRecords as $index => $record)
                                                            <tr>
                                                                <td class=" pe-0">
                                                                    <!-- <span class="text-gray-600 fw-bold fs-6">725</span> -->
                                                                    <input style="width: 5rem;" class="w-[5rem]" type="text" name="dispensing_records[$index][date]" value="{{ old("dispensing_records.{$index}.date", $record->date) }}">
                                                                </td>
                                                                <td class=" pe-0">
                                                                    <!-- <span class="text-gray-600 fw-bold fs-6">725</span> -->
                                                                    <input style="width: 5rem;" class="w-[5rem]" type="text" name="dispensing_records[$index][item_given]" value="{{ old("dispensing_records.{$index}.item_given", $record->item_given) }}">
                                                                </td>
                                                                <td class=" pe-0">
                                                                    <!-- <span class="text-gray-600 fw-bold fs-6">725</span> -->
                                                                    <input style="width: 5rem;" class="w-[5rem]" type="text" name="dispensing_records[$index][dosage]" value="{{ old("dispensing_records.{$index}.dosage", $record->dosage) }}">
                                                                </td>
                                                                <td class=" pe-0">
                                                                    <!-- <span class="text-gray-600 fw-bold fs-6">725</span> -->
                                                                    <input style="width: 5rem;" class="w-[5rem]" type="text" name="dispensing_records[$index][signature]" value="{{ old("dispensing_records.{$index}.signature", $record->signature) }}"> 
                                                                </td>
                                                                <td class=" pe-0">
                                                                    <!-- <span class="text-gray-600 fw-bold fs-6">725</span> -->
                                                                    <input style="width: 5rem;" class="w-[5rem]" type="text" name="dispensing_records[$index][observations]" value="{{ old("dispensing_records.{$index}.observations", $record->observations) }}">
                                                                </td>
                                                                <td class=" pe-0">
                                                                    <input style="width: 5rem;" class="w-[5rem]" type="text">
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            
                                                            @else
                                                            <tr>
                                                                <td class=" pe-0">
                                                                    <!-- <span class="text-gray-600 fw-bold fs-6">725</span> -->
                                                                    <input style="width: 5rem;" class="w-[5rem]" type="text" name="dispensing_records[0][date]">
                                                                </td>
                                                                <td class=" pe-0">
                                                                    <!-- <span class="text-gray-600 fw-bold fs-6">725</span> -->
                                                                    <input style="width: 5rem;" class="w-[5rem]" type="text" name="dispensing_records[0][item_given]">
                                                                </td>
                                                                <td class=" pe-0">
                                                                    <!-- <span class="text-gray-600 fw-bold fs-6">725</span> -->
                                                                    <input style="width: 5rem;" class="w-[5rem]" type="text" name="dispensing_records[0][dosage]">
                                                                </td>
                                                                <td class=" pe-0">
                                                                    <!-- <span class="text-gray-600 fw-bold fs-6">725</span> -->
                                                                    <input style="width: 5rem;" class="w-[5rem]" type="text" name="dispensing_records[0][signature]">
                                                                </td>
                                                                <td class=" pe-0">
                                                                    <!-- <span class="text-gray-600 fw-bold fs-6">725</span> -->
                                                                    <input style="width: 5rem;" class="w-[5rem]" type="text" name="dispensing_records[0][observations]">
                                                                </td>
                                                                <td class=" pe-0">
                                                                    <input style="width: 5rem;" class="w-[5rem]" type="text">
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end: Card Body-->
                                        </div>

                                        <div class="mt-5">
                                            <p>* This form can be used as a “BLANKET CONSENT” for Tylenol or Tempera. The form must be. 
                                                completed and signed by the parent in advance. Telephone consent must be obtained from the 
                                                parent before the medication is administered. Then at pick up time, the parent must sign in the 
                                                Comments section beside the recorded dose.</p>

                                            <p>
                                                ALL MEDICATIONS MUST BE SUPPLIED BY THE PARENT LABELLED WITH KID’S NAME
                                                **NOTE: This record must be kept in the child’s file at the office when the medication is finished
                                            </p>
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