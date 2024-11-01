@extends('layouts.app')
@section('title', 'Parent Survey | High5 Daycare')
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
                            <span>Parent Survey</span>
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
                        <li class="breadcrumb-item text-white">Parent Survey</li>
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
                            <form class="form" route="{{ route('add.parent.survey') }}" method="post">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Parent Survey Questions</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">

                                    <div class="mb-12">

                                        <div class="rounded p-4 border mb-6 h6">
                                            Thank you for choosing @role('Parent') {{ ucfirst(Auth::user()->parent->provider->name) }} @endrole for your child's care. We value your feedback to ensure that we are providing the best possible experience for your family. Please take a few minutes to complete this survey.
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <div class="row">
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q1. Do you feel your suggestions and thoughts are well valued by High5 Day Care?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input required type="radio" name="question1" value="1" class="form-check-input h-20px w-20px" {{ (old('question1', isset($survey) ? $survey->q1 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question1" value="0" class="form-check-input h-20px w-20px" {{ (old('question1', isset($survey) ? $survey->q1 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q2. Do you feel you have a good relationship with your child’s provider?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input required type="radio" name="question2" value="1" class="form-check-input h-20px w-20px" {{ (old('question2', isset($survey) ? $survey->q2 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question2" value="0" class="form-check-input h-20px w-20px" {{ (old('question2', isset($survey) ? $survey->q2 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q3. Do you find it easy to communicate with High5 Day Care?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input required type="radio" name="question3" value="1" class="form-check-input h-20px w-20px" {{ (old('question3', isset($survey) ? $survey->q3 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question3" value="0" class="form-check-input h-20px w-20px" {{ (old('question3', isset($survey) ? $survey->q3 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q4. Are you satisfied with the quality of child care service at High5 Day Care?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input required type="radio" name="question4" value="1" class="form-check-input h-20px w-20px" {{ (old('question4', isset($survey) ? $survey->q4 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question4" value="0" class="form-check-input h-20px w-20px" {{ (old('question4', isset($survey) ? $survey->q4 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q5. Do you feel that the activities offered at daycare, encourage the development of your child in all areas (physical, emotional, social, etc.)?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input required type="radio" name="question5" value="1" class="form-check-input h-20px w-20px" {{ (old('question5', isset($survey) ? $survey->q5 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question5" value="0" class="form-check-input h-20px w-20px" {{ (old('question5', isset($survey) ? $survey->q5 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q6. On the scale of 1-10, how do you rate the caring atmosphere that your child care provider provides (1 means least caring and 10 means very caring)?</p>
                                                    <div class="d-flex align-items-center flex-wrap gap-5">
                                                        <div>
                                                            <input required type="radio" name="question6" value="1" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">1</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="2" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == '2') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">2</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="3" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == '3') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">3</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="4" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == '4') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">4</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="5" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == '5') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">5</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="6" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == '6') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">6</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="7" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == '7') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">7</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="8" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == '8') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">8</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="9" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == '9') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">9</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="10" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == '10') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">10</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q7. Do you feel that your child’s day care provider is approachable and listens to your concerns/questions?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input required type="radio" name="question7" value="1" class="form-check-input h-20px w-20px" {{ (old('question7', isset($survey) ? $survey->q7 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question7" value="0" class="form-check-input h-20px w-20px" {{ (old('question7', isset($survey) ? $survey->q7 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q8. Do you feel confident that you would be notified should there be an incident involving the safety of your child?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input required type="radio" name="question8" value="1" class="form-check-input h-20px w-20px" {{ (old('question8', isset($survey) ? $survey->q8 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question8" value="0" class="form-check-input h-20px w-20px" {{ (old('question8', isset($survey) ? $survey->q8 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q9. Do you feel that the provider treats all information about your child and family as confidential?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input required type="radio" name="question9" value="1" class="form-check-input h-20px w-20px" {{ (old('question9', isset($survey) ? $survey->q9 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question9" value="0" class="form-check-input h-20px w-20px" {{ (old('question9', isset($survey) ? $survey->q9 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q10. How would you rate the friendliness and professionalism of the daycare staff? (1 = Not Satisfied, 10 = Very Satisfied)</p>
                                                    <div class="d-flex align-items-center flex-wrap gap-5">
                                                        <div>
                                                            <input required type="radio" name="question10" value="1" class="form-check-input h-20px w-20px" {{ (old('question10', isset($survey) ? $survey->q10 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">1</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="2" class="form-check-input h-20px w-20px" {{ (old('question10', isset($survey) ? $survey->q10 : null) == '2') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">2</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="3" class="form-check-input h-20px w-20px" {{ (old('question10', isset($survey) ? $survey->q10 : null) == '3') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">3</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="4" class="form-check-input h-20px w-20px" {{ (old('question10', isset($survey) ? $survey->q10 : null) == '4') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">4</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="5" class="form-check-input h-20px w-20px" {{ (old('question10', isset($survey) ? $survey->q10 : null) == '5') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">5</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="6" class="form-check-input h-20px w-20px" {{ (old('question10', isset($survey) ? $survey->q10 : null) == '6') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">6</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="7" class="form-check-input h-20px w-20px" {{ (old('question10', isset($survey) ? $survey->q10 : null) == '7') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">7</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="8" class="form-check-input h-20px w-20px" {{ (old('question10', isset($survey) ? $survey->q10 : null) == '8') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">8</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="9" class="form-check-input h-20px w-20px" {{ (old('question10', isset($survey) ? $survey->q10 : null) == '9') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">9</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="10" class="form-check-input h-20px w-20px" {{ (old('question10', isset($survey) ? $survey->q10 : null) == '10') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">10</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q11. Are you informed regularly about your child's daily activities, meals, and naps?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input required type="radio" name="question11" value="1" class="form-check-input h-20px w-20px" {{ (old('question11', isset($survey) ? $survey->q11 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question11" value="0" class="form-check-input h-20px w-20px" {{ (old('question11', isset($survey) ? $survey->q11 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q12. How satisfied are you with the cleanliness and safety of the daycare facilities? (1 = Not Satisfied, 10 = Very Satisfied)</p>
                                                    <div class="d-flex align-items-center flex-wrap gap-5">
                                                        <div>
                                                            <input required type="radio" name="question12" value="1" class="form-check-input h-20px w-20px" {{ (old('question12', isset($survey) ? $survey->q12 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset >
                                                            <span class="form-check-label fw-semibold">1</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question12" value="2" class="form-check-input h-20px w-20px" {{ (old('question12', isset($survey) ? $survey->q12 : null) == '2') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">2</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question12" value="3" class="form-check-input h-20px w-20px" {{ (old('question12', isset($survey) ? $survey->q12 : null) == '3') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">3</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question12" value="4" class="form-check-input h-20px w-20px" {{ (old('question12', isset($survey) ? $survey->q12 : null) == '4') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">4</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question12" value="5" class="form-check-input h-20px w-20px" {{ (old('question12', isset($survey) ? $survey->q12 : null) == '5') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">5</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question12" value="6" class="form-check-input h-20px w-20px" {{ (old('question12', isset($survey) ? $survey->q12 : null) == '6') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">6</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question12" value="7" class="form-check-input h-20px w-20px" {{ (old('question12', isset($survey) ? $survey->q12 : null) == '7') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">7</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question12" value="8" class="form-check-input h-20px w-20px" {{ (old('question12', isset($survey) ? $survey->q12 : null) == '8') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">8</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question12" value="9" class="form-check-input h-20px w-20px" {{ (old('question12', isset($survey) ? $survey->q12 : null) == '9') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">9</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question12" value="10" class="form-check-input h-20px w-20px" {{ (old('question12', isset($survey) ? $survey->q12 : null) == '10') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">10</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q13. Does your child feel safe and happy at daycare?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input required type="radio" name="question13" value="1" class="form-check-input h-20px w-20px" {{ (old('question13', isset($survey) ? $survey->q13 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question13" value="0" class="form-check-input h-20px w-20px" {{ (old('question13', isset($survey) ? $survey->q13 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q14. Do you find the enrolment process easy?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input required type="radio" name="question14" value="1" class="form-check-input h-20px w-20px" {{ (old('question14', isset($survey) ? $survey->q14 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question14" value="0" class="form-check-input h-20px w-20px" {{ (old('question14', isset($survey) ? $survey->q14 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q15. From 1-10, how easy to use is our payment system/process (1 means not easy and 10 means very easy)</p>
                                                    <div class="d-flex align-items-center flex-wrap gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question15" value="1" class="form-check-input h-20px w-20px" {{ (old('question15', isset($survey) ? $survey->q15 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">1</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question15" value="2" class="form-check-input h-20px w-20px" {{ (old('question15', isset($survey) ? $survey->q15 : null) == '2') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">2</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question15" value="3" class="form-check-input h-20px w-20px" {{ (old('question15', isset($survey) ? $survey->q15 : null) == '3') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">3</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question15" value="4" class="form-check-input h-20px w-20px" {{ (old('question15', isset($survey) ? $survey->q15 : null) == '4') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">4</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question15" value="5" class="form-check-input h-20px w-20px" {{ (old('question15', isset($survey) ? $survey->q15 : null) == '5') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">5</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question15" value="6" class="form-check-input h-20px w-20px" {{ (old('question15', isset($survey) ? $survey->q15 : null) == '6') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">6</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question15" value="7" class="form-check-input h-20px w-20px" {{ (old('question15', isset($survey) ? $survey->q15 : null) == '7') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">7</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question15" value="8" class="form-check-input h-20px w-20px" {{ (old('question15', isset($survey) ? $survey->q15 : null) == '8') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">8</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question15" value="9" class="form-check-input h-20px w-20px" {{ (old('question15', isset($survey) ? $survey->q15 : null) == '9') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">9</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question15" value="10" class="form-check-input h-20px w-20px" {{ (old('question15', isset($survey) ? $survey->q15 : null) == '10') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">10</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q16. Would you recommend High5 Day Care to someone else?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <div>
                                                            <input required type="radio" name="question16" value="1" class="form-check-input h-20px w-20px" {{ (old('question16', isset($survey) ? $survey->q16 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Yes</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question16" value="0" class="form-check-input h-20px w-20px" {{ (old('question16', isset($survey) ? $survey->q16 : null) == '0') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q17. Do you have any suggestions for improvement?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <textarea name="question17" id="" class='form-control form-control-solid' @isset($survey) disabled @endisset requried>{{ old('question17', isset($survey) ? $survey->q17 : '' ) }}</textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        @role('Parent')
                                        <div class="modal-footer flex-right">
                                            <!--begin::Button-->
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                            @isset($survey)

                                            @else
                                            <button type="submit" id="kt_modal_add_event_submit" class="btn btn-primary">
                                                <span class="indicator-label">Submit</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            @endisset
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