@extends('layouts.app')
@section('title', 'Kid Documents | High5 Daycare')
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
                            <span>Kids Documents</span>
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
                        <li class="breadcrumb-item text-white">Documents</li>
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


            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::List widget 23-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Documents</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <!-- <div class="card-toolbar">
                            <a href="#" type="button" class="btn btn-sm btn-primary"><i class="ki-outline ki-exit-up fs-2"
                            style="
                            color: white !important;
                            "></i>Print All</a>
                            </div> -->
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Items-->
                            <div class="">

                                <!--begin::Item-->
                                <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                    <div class="d-flex align-items-center me-5">
                                        <div class="me-5">
                                            <a href="{{route('emergency',['kid'=> $kid->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Emergency Information</a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">

                                        <div class="m-0">
                                            @if(isset($kid->emergencyInformation) && !empty($kid->emergencyInformation))
                                            <span class="badge badge-light-success fs-base">
                                                Submitted</span>
                                            @else
                                            <span class="badge badge-light-danger fs-base">
                                                Not Submitted</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">

                                        <a href="{{route('emergency',['kid'=> $kid->id])}}" class="btn btn-sm btn-light">View</a>
                                    </div>

                                </div>
                                <!--end::Item-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->


                                <!--begin::Item-->
                                <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                    <div class="d-flex align-items-center me-5">
                                        <div class="me-5">
                                            <a href="{{route('drug',['kid'=> $kid->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Drug Information</a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">

                                        <div class="m-0">
                                            @if(isset($kid->drugInformation) && !empty($kid->drugInformation) && count($kid->drugInformation) > 0)
                                            <span class="badge badge-light-success fs-base">
                                                Submitted</span>
                                            @else
                                            <span class="badge badge-light-danger fs-base">
                                                Not Submitted</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">

                                        <a href="{{route('drug',['kid'=> $kid->id])}}" class="btn btn-sm btn-light">View</a>

                                    </div>

                                </div>
                                <!--end::Item-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->


                                <!--begin::Item-->
                                <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                    <div class="d-flex align-items-center me-5">
                                        <div class="me-5">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Outdoor Supervision</a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">

                                        <div class="m-0">
                                            @if(isset($kid->supervision) && !empty($kid->supervision))
                                            <span class="badge badge-light-success fs-base">
                                                Submitted</span>
                                            @else
                                            <span class="badge badge-light-danger fs-base">
                                                Not Submitted</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">

                                        <a href="{{route('outdoor-supervision',['kid'=> $kid->id])}}" class="btn btn-sm btn-light">View</a>

                                    </div>

                                </div>
                                <!--end::Item-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->


                                <!--begin::Item-->
                                <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                    <div class="d-flex align-items-center me-5">
                                        <div class="me-5">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Photo Permission</a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">

                                        <div class="m-0">
                                            @if(isset($kid->photoPermission) && !empty($kid->photoPermission))
                                            <span class="badge badge-light-success fs-base">
                                                Submitted</span>
                                            @else
                                            <span class="badge badge-light-danger fs-base">
                                                Not Submitted</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">

                                        <a href="{{route('photo-permission',['kid'=> $kid->id])}}" class="btn btn-sm btn-light">View</a>

                                    </div>

                                </div>
                                <!--end::Item-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->


                                <!--begin::Item-->
                                <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                    <div class="d-flex align-items-center me-5">
                                        <div class="me-5">
                                            <a href="{{route('medication-consent',['kid'=> $kid->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Medication Consent</a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">

                                        <div class="m-0">
                                            @if(isset($kid->medicationConsent) && !empty($kid->medicationConsent))
                                            <span class="badge badge-light-success fs-base">
                                                Submitted</span>
                                            @else
                                            <span class="badge badge-light-danger fs-base">
                                                Not Submitted</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">

                                        <a href="{{route('medication-consent',['kid'=> $kid->id])}}" class="btn btn-sm btn-light">View</a>

                                    </div>

                                </div>
                                <!--end::Item-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->


                                <!--begin::Item-->
                                <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                    <div class="d-flex align-items-center me-5">
                                        <div class="me-5">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Release Information</a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">

                                        <div class="m-0">
                                            @if(isset($kid->releaseInformation) && !empty($kid->releaseInformation))
                                            <span class="badge badge-light-success fs-base">
                                                Submitted</span>
                                            @else
                                            <span class="badge badge-light-danger fs-base">
                                                Not Submitted</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">

                                        <a href="{{route('release',['kid'=> $kid->id])}}" class="btn btn-sm btn-light">View</a>

                                    </div>

                                </div>
                                <!--end::Item-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->


                                <!--begin::Item-->
                                <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                    <div class="d-flex align-items-center me-5">
                                        <div class="me-5">
                                            <a href="{{route('alternate-sleeping',['kid'=> $kid->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Alternate Sleeping</a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">

                                        <div class="m-0">
                                            @if(isset($kid->alternateSleeping) && !empty($kid->alternateSleeping))
                                            <span class="badge badge-light-success fs-base">
                                                Submitted</span>
                                            @else
                                            <span class="badge badge-light-danger fs-base">
                                                Not Submitted</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">

                                        <a href="{{route('alternate-sleeping',['kid'=> $kid->id])}}" class="btn btn-sm btn-light">View</a>

                                    </div>

                                </div>
                                <!--end::Item-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->


                                <!--begin::Item-->
                                <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                    <div class="d-flex align-items-center me-5">
                                        <div class="me-5">
                                            <a href="{{route('anaphylactic-emergency',['kid'=> $kid->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Anaphylactic Emergency</a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">

                                        <div class="m-0">
                                            @if(isset($kid->anaphylacticEmergency) && !empty($kid->anaphylacticEmergency))
                                            <span class="badge badge-light-success fs-base">
                                                Submitted</span>
                                            @else
                                            <span class="badge badge-light-danger fs-base">
                                                Not Submitted</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">

                                        <a href="{{route('anaphylactic-emergency',['kid'=> $kid->id])}}" class="btn btn-sm btn-light">View</a>

                                    </div>

                                </div>
                                <!--end::Item-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->


                                <!--begin::Item-->
                                <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                    <div class="d-flex align-items-center me-5">
                                        <div class="me-5">
                                            <a href="{{route('individual-action',['kid'=> $kid->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Individual Action Plan</a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">

                                        <div class="m-0">
                                            @if(isset($kid->individualPlan) && !empty($kid->individualPlan))
                                            <span class="badge badge-light-success fs-base">
                                                Submitted</span>
                                            @else
                                            <span class="badge badge-light-danger fs-base">
                                                Not Submitted</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">

                                        <a href="{{route('individual-action',['kid'=> $kid->id])}}" class="btn btn-sm btn-light">View</a>

                                    </div>

                                </div>
                                <!--end::Item-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->


                                <!--begin::Item-->
                                <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                    <div class="d-flex align-items-center me-5">
                                        <div class="me-5">
                                            <a href="{{route('immunization',['kid'=> $kid->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Immunization Record</a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">

                                        <div class="m-0">
                                            @if(isset($kid->immunizationRecord) && !empty($kid->immunizationRecord))
                                            <span class="badge badge-light-success fs-base">
                                                Submitted</span>
                                            @else
                                            <span class="badge badge-light-danger fs-base">
                                                Not Submitted</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">

                                        <a href="{{route('immunization',['kid'=> $kid->id])}}" class="btn btn-sm btn-light">View</a>

                                    </div>

                                </div>
                                <!--end::Item-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->


                                @php
                                if(isset($kid) && !empty($kid->age))
                                {
                                if($kid->age > 1)
                                { $title = 'Contract Infant';
                                $route = 'contract-infant';
                                }elseif($kid->age < 1){ $title='Contract Toddler' ; $route='contract-toddler' ; } } @endphp @role('Admin','Parent') @if(isset($title) && isset($route) && !empty($title) && !empty($route)) <!--begin::Item-->
                                    <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                        <div class="d-flex align-items-center me-5">
                                            <div class="me-5">
                                                <a href="{{route($route,['kid'=> $kid->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">{{$title}}</a>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center">

                                            <div class="m-0">
                                                @if(isset($kid->contract) && !empty($kid->contract))
                                                <span class="badge badge-light-success fs-base">
                                                    Submitted</span>
                                                @else
                                                <span class="badge badge-light-danger fs-base">
                                                    Not Submitted</span>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">

                                            <a href="{{route($route,['kid'=> $kid->id])}}" class="btn btn-sm btn-light">View</a>

                                        </div>

                                    </div>
                                    <!--end::Item-->
                                    @endif


                                    <!--begin::Separator-->
                                    <!-- <div class="separator separator-dashed my-3"></div> -->
                                    <!--end::Separator-->

                                    <!--begin::Item-->
                                    <!-- <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                        <div class="d-flex align-items-center me-5">
                                            <div class="me-5">
                                                <a href="{{route('admin.edit.kid',['kid' => $kid->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Kid Enrollment Form</a>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center">

                                            <div class="m-0">
                                                <span class="badge badge-light-success fs-base">Submitted</span>
                                            </div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">

                                            <a href="{{route('admin.edit.kid',['kid' => $kid->id])}}" class="btn btn-sm btn-light">View</a>

                                        </div>

                                    </div> -->
                                    <!--end::Item-->


                                    <!--begin::Separator-->
                                    <!-- <div class="separator separator-dashed my-3"></div> -->
                                    <!--end::Separator-->

                                    <!--begin::Item-->
                                    <div class="d-grid flex-stack" style="grid-template-columns: repeat(3,1fr);">
                                        <div class="d-flex align-items-center me-5">
                                            <div class="me-5">
                                                <a href="{{route('child-enrolment-form',['kid' => $kid->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Child Enrollment Form</a>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center">

                                        <div class="m-0">
                                                @if(isset($kid->enrollementForm) && !empty($kid->enrollementForm))
                                                <span class="badge badge-light-success fs-base">
                                                    Submitted</span>
                                                @else
                                                <span class="badge badge-light-danger fs-base">
                                                    Not Submitted</span>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">

                                            <a href="{{route('child-enrolment-form',['kid' => $kid->id])}}" class="btn btn-sm btn-light">View</a>

                                        </div>

                                    </div>
                                    <!--end::Item-->
                                    @endrole



                            </div>
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


@endsection