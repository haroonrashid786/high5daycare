@extends('layouts.app')
@section('title', 'Alternate Sleeping | High5 Daycare')
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
                            <span>Alternate Sleeping</span>
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
                        <li class="breadcrumb-item text-white">Alternate Sleeping</li>
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
                            <form class="form" action="{{route('add.kid.alternate.sleeping',['kid' => $kid->id])}}" method="POST" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Alternate Sleeping Plan</h2>
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
                                                    Parent's Name
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="parent_name" placeholder="" value="{{ old('parent_name', optional($kid->alternateSleeping)->parent_name) ?: optional(auth()->user()->parent)->name }}">
                                                @error('parent_name')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Child's Full Legal Name: 
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="child_name" placeholder="" value="{{ old('child_name', optional($kid->alternateSleeping)->child_name) ?: $kid->full_name }}">
                                                @error('child_name')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Date of Birth
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="date_of_birth" placeholder="" value="{{ old('date_of_birth', optional($kid->alternateSleeping)->date_of_birth ? date('Y-m-d', strtotime(optional($kid->alternateSleeping)->date_of_birth)) : date('Y-m-d', strtotime($kid->dob))  ) }}">
                                                @error('date_of_birth')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="rounded p-4 border mb-6">
                                            <p class="m-0">
                                                In order to ensure that all requirements of the Day Nurseries Act are met, according to the Act, children under 18 months of age must nap in a crib or playpen. Children over 18 months of age must sleep in a crib, cot or bed. 
                                            </p>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <p>Has your child shown any sleeping problems?.</p>

                                            <div class="d-flex align-items-center gap-5">
                                                <div>
                                                    <input type="radio" name="sleeping_problems" value="1" class="form-check-input h-20px w-20px" @if (old('sleeping_problems', optional($kid->alternateSleeping)->sleeping_problems) == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">Yes</span>
                                                </div>
                                                <div>
                                                    <input type="radio" name="sleeping_problems" value="0" class="form-check-input h-20px w-20px" @if (old('sleeping_problems', optional($kid->alternateSleeping)->sleeping_problems) == 0) checked @endif>
                                                    <span class="form-check-label fw-semibold">No</span>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-column fv-row mt-8">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    If yes, What kind
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="sleeping_problem_type" placeholder="" value="{{ old('sleeping_problem_type', optional($kid->alternateSleeping)->sleeping_problem_type) }}">
                                                @error('sleeping_problem_type')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <div class="d-flex flex-column fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                How long does he typically sleep at night?
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="night_sleep_duration" value="{{ old('night_sleep_duration', optional($kid->alternateSleeping)->night_sleep_duration) }}">
                                                @error('night_sleep_duration')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="rounded p-4 border mb-6">
                                            <div class="d-flex flex-column fv-row mb-6">
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    What is his sleeping pattern for the day 
                                                </label>
                                            </div>
                                            <div class="d-flex flex-column fv-row mb-6">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Sleeping Time 
                                                </label>
                                                <!--end::Label-->
                                                <input type="time" class="form-control form-control-solid" name="day_sleep_pattern" placeholder="" value="{{ old('day_sleep_pattern', optional($kid->alternateSleeping)->day_sleep_pattern) }}">
                                                @error('day_sleep_pattern')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                            <div class="d-flex flex-column fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Awaking Time
                                                </label>
                                                <!--end::Label-->
                                                <input type="time" class="form-control form-control-solid" name="awaking_time" placeholder="" value="{{ old('awaking_time', optional($kid->alternateSleeping)->awaking_time) }}">
                                                @error('awaking_time')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="rounded p-4 border mb-6">
                                            <div class="d-flex flex-column fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                Does he prefer his stomach/ side/ back for sleep?
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="sleeping_position" placeholder="" value="{{ old('sleeping_position', optional($kid->alternateSleeping)->sleeping_position) }}">
                                                @error('sleeping_position')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="rounded p-4 border mb-6">
                                            <p>Do you have any special ways of helping him to go to sleep? </p>

                                            <div class="d-flex align-items-center gap-5">
                                                <div>
                                                    <input type="radio" name="special_ways_to_sleep" value="1" class="form-check-input h-20px w-20px" @if (old('special_ways_to_sleep', optional($kid->alternateSleeping)->special_ways_to_sleep) == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">Yes</span>
                                                </div>
                                                <div>
                                                    <input type="radio" name="special_ways_to_sleep" value="0" class="form-check-input h-20px w-20px" @if (old('special_ways_to_sleep', optional($kid->alternateSleeping)->special_ways_to_sleep) == 0) checked @endif>
                                                    <span class="form-check-label fw-semibold">No</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <p>Does he usually cry when he goes to sleep?  </p>

                                            <div class="d-flex align-items-center gap-5">
                                                <div>
                                                    <input type="radio" name="cries_before_sleep" value="1" class="form-check-input h-20px w-20px" @if (old('cries_before_sleep', optional($kid->alternateSleeping)->cries_before_sleep) == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">Yes</span>
                                                </div>
                                                <div>
                                                    <input type="radio" name="cries_before_sleep" value="0" class="form-check-input h-20px w-20px" @if (old('cries_before_sleep', optional($kid->alternateSleeping)->cries_before_sleep) == 0) checked @endif>
                                                    <span class="form-check-label fw-semibold">No</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <p>Does he cry when he wakes up? </p>

                                            <div class="d-flex align-items-center gap-5">
                                                <div>
                                                    <input type="radio" name="cries_after_waking_up" value="1" class="form-check-input h-20px w-20px" @if (old('cries_after_waking_up', optional($kid->alternateSleeping)->cries_after_waking_up) == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">Yes</span>
                                                </div>
                                                <div>
                                                    <input type="radio" name="cries_after_waking_up" value="0" class="form-check-input h-20px w-20px" @if (old('cries_after_waking_up', optional($kid->alternateSleeping)->cries_after_waking_up) == 0) checked @endif>
                                                    <span class="form-check-label fw-semibold">No</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <p>Does he sleep in his own room? </p>

                                            <div class="d-flex align-items-center gap-5">
                                                <div>
                                                    <input type="radio" name="sleeps_in_own_room" value="1" class="form-check-input h-20px w-20px" @if (old('sleeps_in_own_room', optional($kid->alternateSleeping)->sleeps_in_own_room) == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">Yes</span>
                                                </div>
                                                <div>
                                                    <input type="radio" name="sleeps_in_own_room" value="0" class="form-check-input h-20px w-20px" @if (old('sleeps_in_own_room', optional($kid->alternateSleeping)->sleeps_in_own_room) == 0) checked @endif>
                                                    <span class="form-check-label fw-semibold">No</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <p>Does he sleep in his own crib/bed </p>

                                            <div class="d-flex align-items-center gap-5">
                                                <div>
                                                    <input type="radio" name="sleeps_in_own_crib_bed" value="1" class="form-check-input h-20px w-20px" @if (old('sleeps_in_own_crib_bed', optional($kid->alternateSleeping)->sleeps_in_own_crib_bed) == 1) checked @endif>
                                                    <span class="form-check-label fw-semibold">Yes</span>
                                                </div>
                                                <div>
                                                    <input type="radio" name="sleeps_in_own_crib_bed" value="0" class="form-check-input h-20px w-20px" @if (old('sleeps_in_own_crib_bed', optional($kid->alternateSleeping)->sleeps_in_own_crib_bed) == 0) checked @endif>
                                                    <span class="form-check-label fw-semibold">No</span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="rounded p-4 border mb-6">
                                            <div class="d-flex flex-column fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Are there any special toys , ,blanket etc he takes to bed? 
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="special_toys_blanket" placeholder="" value="{{ old('special_toys_blanket', optional($kid->alternateSleeping)->special_toys_blanket) }}">
                                                @error('special_toys_blanket')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>


                                        <div class="rounded p-4 border mb-6">
                                            <p>To allow alternate arrangements, the following consent must be completed and signed by the child’s parent or guardian.</p>
                                            <p>I give consent for my child to nap/sleep on: </p>
                                            <ul class="d-flex flex-column gap-3">
                                                <li>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <p style="white-space: nowrap;">a cot</p>
                                                        <input type="text" class="form-control form-control-solid" name="consent_to_sleep_on_cot" placeholder="" value="{{ old('consent_to_sleep_on_cot', optional($kid->alternateSleeping)->consent_to_sleep_on_cot) }}">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <p style="white-space: nowrap;">a playpen</p>
                                                        <input type="text" class="form-control form-control-solid" name="consent_to_sleep_on_playpen" placeholder="" value="{{ old('consent_to_sleep_on_playpen', optional($kid->alternateSleeping)->consent_to_sleep_on_playpen) }}">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <p style="white-space: nowrap;">one of the Provider’s bed specify</p>
                                                        <input type="text" class="form-control form-control-solid" name="consent_to_sleep_on_provider_bed" placeholder="" value="{{ old('consent_to_sleep_on_provider_bed', optional($kid->alternateSleeping)->consent_to_sleep_on_provider_bed) }}">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <p style="white-space: nowrap;"> the couch</p>
                                                        <input type="text" class="form-control form-control-solid" name="consent_to_sleep_on_couch" placeholder="" value="{{ old('consent_to_sleep_on_couch', optional($kid->alternateSleeping)->consent_to_sleep_on_couch) }}">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <p style="white-space: nowrap;"> other</p>
                                                        <input type="text" class="form-control form-control-solid" name="consent_to_sleep_on_other" placeholder="" value="{{ old('consent_to_sleep_on_other', optional($kid->alternateSleeping)->consent_to_sleep_on_other) }}">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        
                                        <div class="rounded p-4 border mb-6">
                                            <div class="d-flex flex-column fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Parent's signature:
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="parent_signature" placeholder="" value="{{ old('parent_signature', optional($kid->alternateSleeping)->parent_signature) }}">
                                                @error('parent_signature')
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