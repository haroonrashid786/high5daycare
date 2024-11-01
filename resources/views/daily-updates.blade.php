@extends('layouts.app')
@role('Admin')
@section('title', 'Daily Updates | Admin | High5 Daycare')
@elserole('Franchise')
@section('title', 'Daily Updates | Provider | High5 Daycare')
@else
@section('title', 'Daily Updates | Parent | High5 Daycare')
@endrole
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
                            <span>Daily Updates</span>
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
                        <li class="breadcrumb-item text-white">Daily Updates</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
                <!--begin::Actions-->

                <!--end::Actions-->
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
                        @role('Franchise')
                        <!--begin::Card body-->
                        <div class="card-body align-items-end">
                            <!--begin::Wrapper-->
                            <form class="form" action="{{route('provider.add.updates')}}" method="POST" id="kt_modal_add_event_form" enctype="multipart/form-data">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Create Daily Updates</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">
                                    <!--begin::Input group-->

                                    <!--end::Input group-->

                                    <div class="row row-cols-lg-2 g-10">
                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Select a Date</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="date" placeholder="" id="" type="date" value="{{ old('date', date('Y-m-d')) }}" />
                                                @error('date')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="fv-row mb-8">
                                                <input type="file" name="files[]" id="images_" hidden multiple>
                                                <label class="fs-6 fw-semibold mb-2 required">Attachments</label>
                                                <!--begin::Dropzone-->
                                                <label for="images_" class="dropzone dz-clickable" id="kt_modal_create_ticket_attachments">
                                                    <!--begin::Message-->
                                                    <div class="dz-message needsclick align-items-center">
                                                        <!--begin::Icon-->
                                                        <i class="ki-outline ki-file-up fs-3hx text-primary"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Info-->
                                                        <div class="ms-4">
                                                            <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here
                                                                or click to upload.</h3>
                                                            <span class="fw-semibold fs-7 text-gray-400">Upload up to 30
                                                                files</span>
                                                        </div>

                                                        <!--end::Info-->
                                                    </div>
                                                </label>
                                                @error('files')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @error('files.*')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Dropzone-->
                                            </div>
                                        </div>
                                    </div>

                                    <!--end::Input group-->

                                    <!--end::Input group-->
                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
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
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Card body-->
                        @endrole
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
            <!--begin::Row-->

            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::List widget 23-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class=" p-7 pb-0  d-block">

                            <form action="{{ route('daily-updates') }}" class="w-100" method="GET">
                                <div class="d-flex align-items-center w-100 ">
                                    <div class="d-flex align-items-center">

                                        <!-- Search Filter -->
                                        @role('Admin')
                                        <div class="me-3">
                                            <label for="search" class="form-label">Search:</label>
                                            <input type="text" for="search" name="search_text" class="form-control" placeholder="Search..." value="{{ Request('search_text') }}">
                                        </div>
                                        @endrole
                                        <!-- Start Date Filter -->
                                        <div class="me-3">
                                            <label for="start_date" class="form-label">Start Date:</label>
                                            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ Request('start_date') }}">
                                        </div>
                                        <!-- End Date Filter -->
                                        <div class="me-3">
                                            <label for="end_date" class="form-label">End Date:</label>
                                            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ Request('end_date') }}">
                                        </div>
                                    </div>
                                    <!-- Apply Filter Button -->
                                    <div class="align-self-end">
                                        <button type="submit" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </form>

                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">All Daily Updates</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Items-->
                            <div class="">
                                @if(isset($updates) && !empty($updates) && count($updates) > 0)
                                @foreach($updates as $update)
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-5">
                                        <!--begin::Flag-->
                                        <!--end::Flag-->
                                        <!--begin::Content-->
                                        <div class="me-5">
                                            <!--begin::Title-->
                                            <a href="{{route('single-update',['id'=> $update->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">{{optional($update->provider)->name}} <br> Date:
                                                {{$update->date->format('d-m-Y')}} </a>
                                            <!--end::Title-->
                                            <!--begin::Desc-->
                                            <!--end::Desc-->
                                        </div>
                                        <!--end::Content-->
                                    </div>

                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-5">
                                        <!--begin::Flag-->
                                        <!--end::Flag-->
                                        <!--begin::Content-->
                                        <div class="me-5">
                                            <!--begin::Title-->
                                            <a href="{{route('single-update',['id'=> $update->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">{{$update->media()->count()}} files
                                                attached</a>
                                            <!--end::Title-->
                                            <!--begin::Desc-->
                                            <!--end::Desc-->
                                        </div>
                                        <!--end::Content-->
                                    </div>


                                    <!--end::Section-->
                                    <!--begin::Wrapper-->

                                    <div class="d-flex align-items-center">
                                        <!--begin::Number-->
                                        <!--end::Number-->
                                        <!--begin::Info-->

                                        <a href="{{route('single-update',['id'=> $update->id])}}" class="btn btn-sm btn-light">View</a>
                                        @role('Franchise')
                                        <a style="background-color:#eb5c2d" class="btn btn-sm btn-danger" onclick="confirmDelete()"> <i class="ki-outline ki-trash fs-1" style="color:white !important ;"></i>Delete</a>
                                        <form id="delete-update" action="{{route('provider.delete.update',['id' => $update->id])}}" method="post" style="display: none;">
                                            @csrf
                                        </form>
                                        @endrole
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->
                                @endforeach
                                @else
                                @include('layouts.partials.no-result')
                                @endif
                            </div>
                            <!--end::Items-->
                            @include('layouts.partials.custom_pagination', ['paginator' => $updates])

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

<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user clicks "Yes", submit the form
                document.getElementById('delete-update').submit();
            }
        });
    }
</script>
@endsection