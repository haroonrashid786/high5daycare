@extends('layouts.app')
@section('title', 'Anaphylactic emergency | High5 Daycare')
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
                            <span>Anaphylactic emergency</span>
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
                        <li class="breadcrumb-item text-white">Anaphylactic emergency</li>
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
                            <form class="form" method="POST" action="{{route('add.kid.anaphylactic',['kid' => $kid->id])}}" id="kt_modal_add_event_form" enctype="multipart/form-data">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Anaphylactic emergency Plan</h2>
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
                                                <input type="text" class="form-control form-control-solid" name="child_name" placeholder="" value="{{ old('child_name', optional($kid->anaphylacticEmergency)->child_name) ?: $kid->full_name }}">
                                                @error('child_name')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Photo
                                                </label>
                                                <!--end::Label-->
                                                <input type="file" class="form-control form-control-solid" name="photo">
                                                @error('photo')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                @if(isset($kid) && isset($kid->anaphylacticEmergency) && (!empty($kid->anaphylacticEmergency->photo)))
                                                <a href="{{url($kid->anaphylacticEmergency->photo)}}" target="_blank">View File</a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <p>Check all appropriate boxes.</p>

                                            <div class="row row-cols-2">
                                                <div class="mb-8 fv-row">
                                                    <input type="checkbox" name="peanuts" class="form-check-input h-20px w-20px" @if(isset($kid) && isset($kid->anaphylacticEmergency) && !empty($kid->anaphylacticEmergency) && $kid->anaphylacticEmergency->peanuts == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">Peanuts</span>
                                                </div>
                                                <div class="mb-8 fv-row">
                                                    <input type="checkbox" name="tree_nuts" class="form-check-input h-20px w-20px" @if(isset($kid) && isset($kid->anaphylacticEmergency) && !empty($kid->anaphylacticEmergency) && $kid->anaphylacticEmergency->tree_nuts == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">Tree Nuts </span>
                                                </div>
                                                <div class="mb-8 fv-row">
                                                    <input type="checkbox" name="eggs" class="form-check-input h-20px w-20px" @if(isset($kid) && isset($kid->anaphylacticEmergency) && !empty($kid->anaphylacticEmergency) && $kid->anaphylacticEmergency->eggs == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">Eggs </span>
                                                </div>
                                                <div class="mb-8 fv-row">
                                                    <input type="checkbox" name="milk" class="form-check-input h-20px w-20px" @if(isset($kid) && isset($kid->anaphylacticEmergency) && !empty($kid->anaphylacticEmergency) && $kid->anaphylacticEmergency->milk == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">Milk </span>
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Insect Stings
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="insect_stings" placeholder="" value="{{ old('insect_stings', optional($kid->anaphylacticEmergency)->insect_stings) ?: '' }}">
                                                    @error('insect_stings')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Latex
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="latex" placeholder="" value="{{ old('latex', optional($kid->anaphylacticEmergency)->latex) ?: '' }}">
                                                    @error('latex')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Medications
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="medications" placeholder="" value="{{ old('medications', optional($kid->anaphylacticEmergency)->medications) ?: '' }}">
                                                    @error('medications')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Others
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="others" placeholder="" value="{{ old('others', optional($kid->anaphylacticEmergency)->others) ?: '' }}">
                                                    @error('others')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <span class="h5">FOOD: </span>The key to prevent an anaphylactic reaction is complete avoidance of the allergen. Do not ingest food that are unmarked, purchased in bulk or labelled as “May Contain”.
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <p class="h6">Injection Dosage</p>

                                            <div class="row row-cols-2 mt-5">
                                                <div class="mb-8 fv-row">
                                                    <input type="checkbox" name="epipen_jr" class="form-check-input h-20px w-20px" @if(isset($kid) && isset($kid->anaphylacticEmergency) && !empty($kid->anaphylacticEmergency) && $kid->anaphylacticEmergency->epipen_jr == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">EpiPen Jr. 0.15 mg</span>
                                                </div>
                                                <div class="mb-8 fv-row">
                                                    <input type="checkbox" name="epipen" class="form-check-input h-20px w-20px" @if(isset($kid) && isset($kid->anaphylacticEmergency) && !empty($kid->anaphylacticEmergency) && $kid->anaphylacticEmergency->epipen == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">EpiPen 0.30 mg </span>
                                                </div>
                                                <div class="mb-8 fv-row">
                                                    <input type="checkbox" name="twinjet_015mg" class="form-check-input h-20px w-20px" @if(isset($kid) && isset($kid->anaphylacticEmergency) && !empty($kid->anaphylacticEmergency) && $kid->anaphylacticEmergency->twinjet_015mg == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">Twinjet 0.15 mg </span>
                                                </div>
                                                <div class="mb-8 fv-row">
                                                    <input type="checkbox" name="twinjet_030mg" class="form-check-input h-20px w-20px" @if(isset($kid) && isset($kid->anaphylacticEmergency) && !empty($kid->anaphylacticEmergency) && $kid->anaphylacticEmergency->twinjet_030mg == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">Twinjet 0.30 mg </span>
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Location of (Auto) injectors
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="location_of_auto_injectors" placeholder="" value="{{ old('location_of_auto_injectors', optional($kid->anaphylacticEmergency)->location_of_auto_injectors) ?: '' }}">
                                                    @error('location_of_auto_injectors')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <p>
                                                <span class="h6">Skin system:</span> hives, swelling, itching, warmth, redness, rash
                                            </p>
                                            <p>
                                                <span class="h6">Respiratory system (breathing):</span> coughing, wheezing, shortness of breath, chest pain/tightness, throat tightness, difficulty in speaking, hoarse voice, nasal congestion, hi fever-like symptoms (runny, itchy nose and watery eyes and sneezing), trouble swallowing
                                            </p>
                                            <p>
                                                <span class="h6">Gastrointestinal system (stomach):</span> nausea, pain/cramps, vomiting, diarrhea
                                            </p>
                                            <p>
                                                <span class="h6">Cardiovascular system (heart):</span> pale/blue color, weak pulse, passing out dizzy/lightheaded, shock
                                            </p>
                                            <p>
                                                <span class="h6">Others:</span> anxiety, feeling of ‘impending doom’, headache, metallic taste
                                            </p>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <p>
                                                <span class="h6">Give epinephrine auto-injector</span> at the first sign of a known or suspected anaphylactic reaction.
                                            </p>
                                            <p>
                                                <span class="h6">Call 9-1-1.</span> Tell them someone is having a life-threatening allergic reaction.
                                            </p>
                                            <p>
                                                <span class="h6">Give a 2nd dose of epinephrine</span> in 5 to 15 minutes IF the reaction continues or worsens.
                                            </p>
                                            <p>
                                                <span class="h6">Go to the nearest hospital</span> (ideally by ambulance) even if symptoms are mild or have stopped.
                                            </p>
                                            <p>
                                                <span class="h6">Call emergency contact person of child</span> i.e. parent or guardian.
                                            </p>
                                        </div>


                                        <div class="rounded p-4 border mb-6">
                                            <label class="d-flex align-items-center fs-3 fw-semibold mb-2">
                                                Info 1
                                            </label>
                                            <div class="row row-cols-2 vehicle">

                                                <div class="d-flex flex-column fv-row my-2">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Name
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="emergency_contact_name" placeholder="" value="{{ old('emergency_contact_name', optional($kid->anaphylacticEmergency)->emergency_contact_name) ?: '' }}">
                                                    @error('emergency_contact_name')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row my-2">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Relationship
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="emergency_contact_relationship" placeholder="" value="{{ old('emergency_contact_relationship', optional($kid->anaphylacticEmergency)->emergency_contact_relationship) ?: '' }}">
                                                    @error('emergency_contact_relationship')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row my-2">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Home Phone
                                                    </label>
                                                    <!--end::Label-->
                                                    <div class="bg-gray-100 rounded d-flex align-items-center">
                                                        <div class="px-5 fw-bold">+1</div>
                                                        <input type="text" class="form-control form-control-solid" name="emergency_contact_home_phone" placeholder="" value="{{ old('emergency_contact_home_phone', optional($kid->anaphylacticEmergency)->emergency_contact_home_phone) ?: '' }}">
                                                    </div>
                                                    @error('emergency_contact_home_phone')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row my-2">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Cell Phone
                                                    </label>
                                                    <!--end::Label-->
                                                    <div class="bg-gray-100 rounded d-flex align-items-center">
                                                        <div class="px-5 fw-bold">+1</div>
                                                        <input type="text" class="form-control form-control-solid" name="emergency_contact_cell_phone" placeholder="" value="{{ old('emergency_contact_cell_phone', optional($kid->anaphylacticEmergency)->emergency_contact_cell_phone) ?: '' }}">
                                                    </div>
                                                    @error('emergency_contact_cell_phone')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row my-2">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Work Phone
                                                    </label>
                                                    <!--end::Label-->
                                                    <div class="bg-gray-100 rounded d-flex align-items-center">
                                                        <div class="px-5 fw-bold">+1</div>
                                                        <input type="text" class="form-control form-control-solid" name="emergency_contact_work_phone" placeholder="" value="{{ old('emergency_contact_work_phone', optional($kid->anaphylacticEmergency)->emergency_contact_work_phone) ?: '' }}">
                                                    </div>
                                                    @error('emergency_contact_work_phone')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="rounded p-4 border mb-6">
                                            <label class="d-flex align-items-center fs-3 fw-semibold mb-2">
                                                Info 2
                                            </label>
                                            <div class="row row-cols-2 vehicle">

                                                <div class="d-flex flex-column fv-row my-2">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Name
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="emergency_contact_name_2" placeholder="" value="{{ old('emergency_contact_name_2', optional($kid->anaphylacticEmergency)->emergency_contact_name_2) ?: '' }}">
                                                    @error('emergency_contact_name_2')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row my-2">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Relationship
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" name="emergency_contact_relationship_2" placeholder="" value="{{ old('emergency_contact_relationship_2', optional($kid->anaphylacticEmergency)->emergency_contact_relationship_2) ?: '' }}">
                                                    @error('emergency_contact_relationship_2')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row my-2">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Home Phone
                                                    </label>
                                                    <!--end::Label-->
                                                    <div class="bg-gray-100 rounded d-flex align-items-center">
                                                        <div class="px-5 fw-bold">+1</div>
                                                        <input type="text" class="form-control form-control-solid" name="emergency_contact_home_phone_2" placeholder="" value="{{ old('emergency_contact_home_phone_2', optional($kid->anaphylacticEmergency)->emergency_contact_home_phone_2) ?: '' }}">
                                                    </div>
                                                    @error('emergency_contact_home_phone_2')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row my-2">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Cell Phone
                                                    </label>
                                                    <!--end::Label-->
                                                    <div class="bg-gray-100 rounded d-flex align-items-center">
                                                        <div class="px-5 fw-bold">+1</div>
                                                        <input type="text" class="form-control form-control-solid" name="emergency_contact_cell_phone_2" placeholder="" value="{{ old('emergency_contact_cell_phone_2', optional($kid->anaphylacticEmergency)->emergency_contact_cell_phone_2) ?: '' }}">
                                                    </div>
                                                    @error('emergency_contact_cell_phone_2')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex flex-column fv-row my-2">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        Work Phone
                                                    </label>
                                                    <!--end::Label-->
                                                    <div class="bg-gray-100 rounded d-flex align-items-center">
                                                        <div class="px-5 fw-bold">+1</div>
                                                        <input type="text" class="form-control form-control-solid" name="emergency_contact_work_phone_2" placeholder="" value="{{ old('emergency_contact_work_phone_2', optional($kid->anaphylacticEmergency)->emergency_contact_work_phone_2) ?: '' }}">
                                                    </div>
                                                    @error('emergency_contact_work_phone_2')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <div class="d-flex flex-column fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Signature:
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="parent_signature" placeholder="" value="{{ old('parent_signature', optional($kid->anaphylacticEmergency)->parent_signature) ?: '' }}">
                                                @error('parent_signature')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="d-flex flex-column mt-6 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Date
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="date" placeholder="">
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