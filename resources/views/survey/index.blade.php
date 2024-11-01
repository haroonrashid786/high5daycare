@extends('layouts.app')
@section('title', 'Survey | High5 Daycare')
@section('content')

<style>
   .symbol-label {
        background: #577D44 !important;
    }
</style>
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
                            <span>Survey</span>
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                            <a @role('Admin') href="{{ route('admin.home') }}" @elserole('Franchise') href="{{ route('provider.home') }}" @else href="{{ route('parent.home') }}" @endrole class="text-white text-hover-primary">
                                <img src="{{asset('assets/media/Home.svg')}}" class="" alt="" />
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-white">Survey</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>

                
                <!--begin::Actions-->
                <div class="d-flex align-items-center @role('Parent') justify-content-lg-center @elserole('Franchise') justify-content-lg-center @endrole gap-2">
                    
                    @role('Parent')

                    @if($showParentsSurvey)
                    <div class="d-flex align-items-center">
                        <a href="{{ route('view.survey.parent') }}">
                            <button class="btn btn-primary" type="submit">Complete Survey</button>
                        </a>
                    </div>
                    @endif
                    
                    @endrole
                    
                    @role('Franchise')

                    @if($showProviderSurvey)
                    <div class="d-flex align-items-center">
                    <a href="{{ route('view.survey.provider') }}">
                            <button class="btn btn-primary">Complete Survey</button>
                    </a>
                    </div>
                    @endif

                    @endrole

                </div>
                <!--end::Actions-->
                
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


                @role('Admin','Parent')
                <!--begin::Col-->
                <a href="{{route('survey.parents')}}" @role('Admin') class="col-md-6 mb-xl-12" @else class="col-md-12 mb-xl-12" @endrole>
                    <div class="card card-flush">
                        <div class="card-header pt-7">
                            <div class="card-title flex-stack flex-row-fluid">
                                <div class="symbol symbol-45px me-5">
                                    <span class="symbol-label bg-light-info">
                                        <i class="ki-outline ki-cheque fs-2x text-gray-800"></i>
                                    </span>
                                    <span class="fw-bolder fs-2x text-dark">Parent's Survey</span>
                                </div>

                            </div>
                        </div>

                        <div class="card-body d-flex align-items-end">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-2x text-dark">{{ $totalParentSurveyCount }}</span>
                                <span class="fw-bold fs-7 text-gray-500">Total Survey's</span>
                            </div>
                        </div>
                    </div>
                </a>
                <!--end::Col-->
                @endrole

                @role('Admin','Franchise')
                <!--begin::Col-->
                <a href="{{route('survey.providers')}}" @role('Admin') class="col-md-6 mb-xl-12" @else class="col-md-12 mb-xl-12" @endrole>
                    <div class="card card-flush">
                        <div class="card-header pt-7">
                            <div class="card-title flex-stack flex-row-fluid">
                                <div class="symbol symbol-45px me-5">
                                    <span class="symbol-label bg-light-info">
                                        <i class="ki-outline ki-dollar fs-2x text-gray-800"></i>
                                    </span>
                                    <span class="fw-bolder fs-2x text-dark">Provider's Survey</span>
                                </div>

                            </div>
                        </div>

                        <div class="card-body d-flex align-items-end">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-2x text-dark">{{ $totalProviderSurveyCount }}</span>
                                <span class="fw-bold fs-7 text-gray-500">Total Survey's</span>
                            </div>
                        </div>
                    </div>
                </a>
                <!--end::Col-->
                @endrole

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