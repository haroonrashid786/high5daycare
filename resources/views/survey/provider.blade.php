@extends('layouts.app')
@section('title', 'STAFF SURVEY | High5 Daycare')
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
                            <span>STAFF SURVEY @isset($survey) Of {{ ucfirst(optional($survey->provider)->name) }} @endisset</span>
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
                        <li class="breadcrumb-item text-white">STAFF SURVEY</li>
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
                            <form class="form"  method="post" @isset($survey) action="{{ route('update.provider.survey',['id' => $survey->id ]) }}" @else action="{{ route('add.provider.survey') }}" @endisset>
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">STAFF SURVEY</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">

                                    <div class="mb-12">

                                        <div class="rounded p-4 border mb-6 h6">
                                            Thank you for being a part of High5 Daycare Inc. Your feedback is crucial in helping us enhance the quality of our services. Please take a few minutes to complete this survey.
                                        </div>

                                        <div class="rounded p-4 border mb-6">
                                            <div class="row">
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q1. You are willing to participate in professional development learning.</p>
                                                    <div class="d-flex align-items-center flex-wrap gap-5">
                                                        <div>
                                                            <input required type="radio" name="question1" value="stronglydisagree" class="form-check-input h-20px w-20px" {{ (old('question1', isset($survey) ? $survey->q1 : null) == 'stronglydisagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question1" value="disagree" class="form-check-input h-20px w-20px" {{ (old('question1', isset($survey) ? $survey->q1 : null) == 'disagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question1" value="neutral" class="form-check-input h-20px w-20px" {{ (old('question1', isset($survey) ? $survey->q1 : null) == 'neutral') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Neutral</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question1" value="agree" class="form-check-input h-20px w-20px" {{ (old('question1', isset($survey) ? $survey->q1 : null) == 'agree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Agree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question1" value="stronglyagree" class="form-check-input h-20px w-20px" {{ (old('question1', isset($survey) ? $survey->q1 : null) == 'stronglyagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Agree</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q2. You feel that you are heard at your organization.</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question2" value="stronglydisagree" class="form-check-input h-20px w-20px" {{ (old('question2', isset($survey) ? $survey->q2 : null) == 'stronglydisagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question2" value="disagree" class="form-check-input h-20px w-20px" {{ (old('question2', isset($survey) ? $survey->q2 : null) == 'disagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question2" value="neutral" class="form-check-input h-20px w-20px" {{ (old('question2', isset($survey) ? $survey->q2 : null) == 'neutral') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Neutral</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question2" value="agree" class="form-check-input h-20px w-20px" {{ (old('question2', isset($survey) ? $survey->q2 : null) == 'agree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Agree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question2" value="stronglyagree" class="form-check-input h-20px w-20px" {{ (old('question2', isset($survey) ? $survey->q2 : null) == 'stronglyagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Agree</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q3. You receive the right amount of support and guidance from your supervisor.</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question3" value="stronglydisagree" class="form-check-input h-20px w-20px" {{ (old('question3', isset($survey) ? $survey->q3 : null) == 'stronglydisagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question3" value="disagree" class="form-check-input h-20px w-20px" {{ (old('question3', isset($survey) ? $survey->q3 : null) == 'disagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question3" value="neutral" class="form-check-input h-20px w-20px" {{ (old('question3', isset($survey) ? $survey->q3 : null) == 'neutral') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Neutral</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question3" value="agree" class="form-check-input h-20px w-20px" {{ (old('question3', isset($survey) ? $survey->q3 : null) == 'agree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Agree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question3" value="stronglyagree" class="form-check-input h-20px w-20px" {{ (old('question3', isset($survey) ? $survey->q3 : null) == 'stronglyagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Agree</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q4. Your supervisor encourages you to offer suggestions and improvement.</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question4" value="stronglydisagree" class="form-check-input h-20px w-20px" {{ (old('question4', isset($survey) ? $survey->q4 : null) == 'stronglydisagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question4" value="disagree" class="form-check-input h-20px w-20px" {{ (old('question4', isset($survey) ? $survey->q4 : null) == 'disagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question4" value="neutral" class="form-check-input h-20px w-20px" {{ (old('question4', isset($survey) ? $survey->q4 : null) == 'neutral') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Neutral</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question4" value="agree" class="form-check-input h-20px w-20px" {{ (old('question4', isset($survey) ? $survey->q4 : null) == 'agree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Agree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question4" value="stronglyagree" class="form-check-input h-20px w-20px" {{ (old('question4', isset($survey) ? $survey->q4 : null) == 'stronglyagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Agree</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q5. It’s easy to communicate with High5 Day Care staff/leadership.</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question5" value="stronglydisagree" class="form-check-input h-20px w-20px" {{ (old('question5', isset($survey) ? $survey->q5 : null) == 'stronglydisagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question5" value="disagree" class="form-check-input h-20px w-20px" {{ (old('question5', isset($survey) ? $survey->q5 : null) == 'disagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question5" value="neutral" class="form-check-input h-20px w-20px" {{ (old('question5', isset($survey) ? $survey->q5 : null) == 'neutral') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Neutral</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question5" value="agree" class="form-check-input h-20px w-20px" {{ (old('question5', isset($survey) ? $survey->q5 : null) == 'agree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Agree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question5" value="stronglyagree" class="form-check-input h-20px w-20px" {{ (old('question5', isset($survey) ? $survey->q5 : null) == 'stronglyagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Agree</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q6. You find the pay process easy and smooth.</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question6" value="stronglydisagree" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == 'stronglydisagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="disagree" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == 'disagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="neutral" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == 'neutral') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Neutral</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="agree" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == 'agree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Agree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question6" value="stronglyagree" class="form-check-input h-20px w-20px" {{ (old('question6', isset($survey) ? $survey->q6 : null) == 'stronglyagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Agree</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q7. You will recommend others to join High5 Day Care as a Provider.</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question7" value="stronglydisagree" class="form-check-input h-20px w-20px" {{ (old('question7', isset($survey) ? $survey->q7 : null) == 'stronglydisagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question7" value="disagree" class="form-check-input h-20px w-20px" {{ (old('question7', isset($survey) ? $survey->q7 : null) == 'disagree') ? 'checked' : '' }} @isset($survey) disabled @endisset> 
                                                            <span class="form-check-label fw-semibold">Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question7" value="neutral" class="form-check-input h-20px w-20px" {{ (old('question7', isset($survey) ? $survey->q7 : null) == 'neutral') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Neutral</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question7" value="agree" class="form-check-input h-20px w-20px" {{ (old('question7', isset($survey) ? $survey->q7 : null) == 'agree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Agree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question7" value="stronglyagree" class="form-check-input h-20px w-20px" {{ (old('question7', isset($survey) ? $survey->q7 : null) == 'stronglyagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Agree</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q8. The high5 Day Care leadership/management gives you constructive/valuable feedback.</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question8" value="stronglydisagree" class="form-check-input h-20px w-20px" {{ (old('question8', isset($survey) ? $survey->q8 : null) == 'stronglydisagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question8" value="disagree" class="form-check-input h-20px w-20px" {{ (old('question8', isset($survey) ? $survey->q8 : null) == 'disagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question8" value="neutral" class="form-check-input h-20px w-20px" {{ (old('question8', isset($survey) ? $survey->q8 : null) == 'neutral') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Neutral</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question8" value="agree" class="form-check-input h-20px w-20px" {{ (old('question8', isset($survey) ? $survey->q8 : null) == 'agree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Agree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question8" value="stronglyagree" class="form-check-input h-20px w-20px" {{ (old('question8', isset($survey) ? $survey->q8 : null) == 'stronglyagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Agree</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q9. You are appreciated at work.</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question9" value="stronglydisagree" class="form-check-input h-20px w-20px" {{ (old('question9', isset($survey) ? $survey->q9 : null) == 'stronglydisagree') ? 'checked' : '' }} @isset($survey) disabled @endisset> 
                                                            <span class="form-check-label fw-semibold">Strongly Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question9" value="disagree" class="form-check-input h-20px w-20px" {{ (old('question9', isset($survey) ? $survey->q9 : null) == 'disagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question9" value="neutral" class="form-check-input h-20px w-20px" {{ (old('question9', isset($survey) ? $survey->q9 : null) == 'neutral') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Neutral</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question9" value="agree" class="form-check-input h-20px w-20px" {{ (old('question9', isset($survey) ? $survey->q9 : null) == 'agree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Agree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question9" value="stronglyagree" class="form-check-input h-20px w-20px" {{ (old('question9', isset($survey) ? $survey->q9 : null) == 'stronglyagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Agree</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q10. You feel respected by the leadership/management of High5 DayCare.</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question10" value="stronglydisagree" class="form-check-input h-20px w-20px"  {{ (old('question10', isset($survey) ? $survey->q10 : null) == 'stronglydisagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="disagree" class="form-check-input h-20px w-20px"  {{ (old('question10', isset($survey) ? $survey->q10 : null) == 'disagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="neutral" class="form-check-input h-20px w-20px"  {{ (old('question10', isset($survey) ? $survey->q10 : null) == 'neutral') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Neutral</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="agree" class="form-check-input h-20px w-20px"  {{ (old('question10', isset($survey) ? $survey->q10 : null) == 'agree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Agree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question10" value="stronglyagree" class="form-check-input h-20px w-20px"  {{ (old('question10', isset($survey) ? $survey->q10 : null) == 'stronglyagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Agree</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q11. Your job allows you to have a good work-life balance.</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question11" value="stronglydisagree" class="form-check-input h-20px w-20px" {{ (old('question11', isset($survey) ? $survey->q11 : null) == 'stronglydisagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question11" value="disagree" class="form-check-input h-20px w-20px" {{ (old('question11', isset($survey) ? $survey->q11 : null) == 'disagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Disagree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question11" value="neutral" class="form-check-input h-20px w-20px" {{ (old('question11', isset($survey) ? $survey->q11 : null) == 'neutral') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Neutral</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question11" value="agree" class="form-check-input h-20px w-20px" {{ (old('question11', isset($survey) ? $survey->q11 : null) == 'agree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Agree</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question11" value="stronglyagree" class="form-check-input h-20px w-20px" {{ (old('question11', isset($survey) ? $survey->q11 : null) == 'stronglyagree') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">Strongly Agree</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q12. On a scale of 1 to 5, how satisfied are you with the overall work environment at [Daycare Name]? (1 = Not Satisfied, 5 = Very Satisfied)</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question12" value="1" class="form-check-input h-20px w-20px" {{ (old('question12', isset($survey) ? $survey->q12 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
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
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q13 How effective do you find the communication between daycare staff and management? (1 = Not Effective, 5 = Very Effective)</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question13" value="1" class="form-check-input h-20px w-20px" {{ (old('question13', isset($survey) ? $survey->q13 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">1</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question13" value="2" class="form-check-input h-20px w-20px" {{ (old('question13', isset($survey) ? $survey->q13 : null) == '2') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">2</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question13" value="3" class="form-check-input h-20px w-20px" {{ (old('question13', isset($survey) ? $survey->q13 : null) == '3') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">3</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question13" value="4" class="form-check-input h-20px w-20px" {{ (old('question13', isset($survey) ? $survey->q13 : null) == '4') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">4</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question13" value="5" class="form-check-input h-20px w-20px" {{ (old('question13', isset($survey) ? $survey->q13 : null) == '5') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">5</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q14 How satisfied are you with the relationship between daycare staff and parents? (1 = Not Satisfied, 5 = Very Satisfied)</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question14" value="1" class="form-check-input h-20px w-20px" {{ (old('question14', isset($survey) ? $survey->q13 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">1</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question14" value="2" class="form-check-input h-20px w-20px" {{ (old('question14', isset($survey) ? $survey->q13 : null) == '2') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">2</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question14" value="3" class="form-check-input h-20px w-20px" {{ (old('question14', isset($survey) ? $survey->q13 : null) == '3') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">3</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question14" value="4" class="form-check-input h-20px w-20px" {{ (old('question14', isset($survey) ? $survey->q13 : null) == '4') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">4</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question14" value="5" class="form-check-input h-20px w-20px" {{ (old('question14', isset($survey) ? $survey->q13 : null) == '5') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">5</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q15 Have you received sufficient training for handling different age groups and developmental stages? </p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
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
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q16 How satisfied are you with the facilities and resources available for childcare activities?</p>
                                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                                        <div>
                                                            <input required type="radio" name="question16" value="1" class="form-check-input h-20px w-20px" {{ (old('question16', isset($survey) ? $survey->q16 : null) == '1') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">1</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question16" value="2" class="form-check-input h-20px w-20px" {{ (old('question16', isset($survey) ? $survey->q16 : null) == '2') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">2</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question16" value="3" class="form-check-input h-20px w-20px" {{ (old('question16', isset($survey) ? $survey->q16 : null) == '3') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">3</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question16" value="4" class="form-check-input h-20px w-20px" {{ (old('question16', isset($survey) ? $survey->q16 : null) == '4') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">4</span>
                                                        </div>
                                                        <div>
                                                            <input required type="radio" name="question16" value="5" class="form-check-input h-20px w-20px" {{ (old('question16', isset($survey) ? $survey->q16 : null) == '5') ? 'checked' : '' }} @isset($survey) disabled @endisset>
                                                            <span class="form-check-label fw-semibold">5</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q17 Are there any improvements or additional resources you believe would benefit the daycare?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <input type="text" name="question17" class='form-control form-control-solid' required value="{{ old('question17',isset($survey) ? $survey->q17 : '') }}" @isset($survey) disabled @endisset>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q18Are there any challenges in working with colleagues that you would like to address?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <input type="text" name="question18" class='form-control form-control-solid' required value="{{ old('question18',isset($survey) ? $survey->q18 : '') }}" @isset($survey) disabled @endisset>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q19Please share any additional comments or feedback you have about your experience as a daycare provider at [Daycare Name].</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <input type="text" name="question19" class='form-control form-control-solid' required value="{{ old('question19',isset($survey) ? $survey->q19 : '') }}" @isset($survey) disabled @endisset> 
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q20. How did you hear about High5 Day Care?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <input type="text" name="question20" class='form-control form-control-solid' required value="{{ old('question20',isset($survey) ? $survey->q20 : '') }}" @isset($survey) disabled @endisset>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column fv-row mb-6">
                                                    <!--begin::Label-->
                                                    <p class='fs-4  fw-medium'>Q21. What’s one thing that makes your day care best?</p>
                                                    <div class="d-flex align-items-center gap-5">
                                                        <input type="text" name="question21" class='form-control form-control-solid' required value="{{ old('question21',isset($survey) ? $survey->q21 : '') }}" @isset($survey) disabled @endisset>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        @role('Franchise')
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