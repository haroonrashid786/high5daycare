<style>
.fixed_cols_heading_container{
    width: 400px;
}
.fixed_cols_heading_container_Admin{
    grid-template-columns: repeat( 2,minmax(200px,200px))
}
.fixed_cols_heading_container_Franchise{
    grid-template-columns: repeat( 1,minmax(200px,200px))
}
.provider_detail{
    display: flex;
}

    .truncate {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      width: 100px;
      margin: 2.1px;
      font-weight: 100;
    }
@media (max-width: 640px) {
    .fixed_cols_heading_container{
        width: 180px;
    }
    .fixed_cols_heading_container_Admin{
    grid-template-columns: repeat( 1,minmax(180px,180px))
}
    .provider_detail,
    .provider_heading{
        display:none !important;
    }
    /* .fixed_cols_container{
        width: 300px;
    }
    .fixed_cols_heading_container_Admin{
        grid-template-columns: repeat(@role('Admin','Parent') 2 @elserole('Franchise') 1 @else 1 @endrole ,minmax(200px,200px))  
        grid-template-columns: repeat( 1,minmax(150px,150px))      
    }
    .fixed_cols_heading_container_Franchise{
        grid-template-columns: repeat( 1,minmax(150px,150px))        
    } */
}
</style>

@extends('layouts.app')
@section('title', 'All Kids | Admin | High5 Daycare')
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
                            <span>Kids</span>
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
                        <li class="breadcrumb-item text-white">Kids</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
                @role('Admin','Franchise','Parent')
                <!--begin::Actions-->
                <div class="d-flex align-self-center flex-center flex-shrink-0">
                    <a href="{{route('admin.add.kid')}}" class="btn btn-sm btn-dark ms-3 px-4 py-3">Create
                        <span class="d-none d-sm-inline">New Kid</span></a>
                </div>
                <!--end::Actions-->
                @endrole
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
                            <form class="form" @role('Admin') action="{{route('admin.kids')}}" @elserole('Franchise') action="{{route('provider.kids')}}" @else action="{{route('parent.kids')}}" @endrole id="kt_modal_add_event_form" method="GET">
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Search Kids</h2>
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
                                                <label class="fs-6 fw-semibold mb-2 required">Search</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="search_text" placeholder="Search by Name, Code, Contact" id="" type="text" value="{{Request('search_text')}}" />
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        @role('Admin')

                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Provider Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select class="form-control form-control-solid" name="provider_name" placeholder="" id="" data-control="select2" data-hide-search="false">
                                                <option value="">Select Provider</option>
                                                @if(isset($providers) && !empty($providers) && count($providers) > 0)
                                                @foreach($providers as $provider)
                                                    <option value="{{$provider->code}}" @if(old('provider_name', Request('provider_name')) == $provider->code) selected @endif>{{ ucfirst($provider->name) }}</option>
                                                @endforeach
                                                @endif
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        @elserole('Franchise')
                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Parent Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="parent_name" placeholder="" id="" type="text" value="{{Request('parent_name')}}" />
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        @endrole
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
                                        <span class="indicator-label">Search</span>
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
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">All Kids</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Items-->
                            <div class="d-flex">
                            <div class="">
                                    <div class="d-grid mb-5 fixed_cols_heading_container @role('Admin','Parent') fixed_cols_heading_container_Admin @elserole('Franchise') fixed_cols_heading_container_Franchise @else fixed_cols_heading_container_Franchise @endrole" >
                                        <div>
                                            <h5>Kid Name</h5>
                                        </div>
                                        @role('Admin')
                                        <div class="provider_heading">
                                            <h5>Provider Name</h5>
                                        </div>
                                        @endrole
                                    </div>
                                    <div class="">
                                        @if(isset($kids) && !empty($kids) && count($kids) > 0)
                                        @foreach($kids as $kid)
                                        <!--begin::Item-->
                                        <div class="d-inline-grid flex-stack pb-3 mb-3 h-50px  @role('Admin','Parent') fixed_cols_heading_container_Admin @elserole('Franchise') fixed_cols_heading_container_Franchise @else fixed_cols_heading_container_Franchise @endrole" style=" border-bottom: 2px dashed #ddd;">
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center me-5">
                                                <!--begin::Flag-->
                                                <img src="{{ isset($kid->profile_picture) ? url($kid->profile_picture) : ''}}" class="me-4 w-30px h-30px object-fit-cover" style="border-radius: 4px" alt="kid img">
                                                <!--end::Flag-->
                                                <!--begin::Content-->
                                                <div class="me-5">
                                                    <!--begin::Title-->
                                                    <h3 class="truncate">
                                                        <a href="{{route('admin.edit.kid',['kid' => $kid->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6" >{{ucfirst($kid->full_name)}}</a>
                                                    </h3>
                                                    <!--end::Title-->
                                                    <!--begin::Desc-->
                                                    <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0" style="white-space: nowrap;">Joined:
                                                        {{$kid->contract_start->format('d-m-Y')}}</span>
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Content-->
                                            </div>
        
        
        
                                            @role('Admin')
                                            <!--begin::Section-->
                                            <div class=" align-items-center me-5 provider_detail">
                                                <!--begin::Flag-->
                                                <!--end::Flag-->
                                                <!--begin::Content-->
                                                <div class="me-5">
                                                    <!--begin::Title-->
                                                    <h3 class="truncate">    
                                                        <a href="{{route('admin.providers',[ 'search_text' => $kid->provider->code ])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">{{ucfirst(optional($kid->provider)->name)}}</a>
                                                    </h3>
                                                    <!--end::Title-->
                                                    <!--begin::Desc-->
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Section-->
                                            @endrole
                                            <!--begin::Section-->
                                            
                                        </div>
                                        <!--end::Item-->
        
                                        @endforeach
             
                                        @endif
                                </div>
                                </div>
                                <div class="overflow-auto">
                                        
                                        <div class="d-grid mb-5" style="grid-template-columns: repeat(@role('Admin','Parent') 8 @elserole('Franchise') 8 @else 8 @endrole ,minmax(200px,1fr));">
                                            <div>
                                                <h5>Kid age</h5>
                                            </div>
        
                                            <div>
                                                <h5>Parent Name</h5>
                                            </div>
                                            <div>
                                                <h5>Contact Info</h5>
                                            </div>
                                            <div class="text-center">
                                                <h5>Photo Permission</h5>
                                            </div>
                                            <div class="text-center">
                                                <h5>Status</h5>
                                            </div>
                                            <div>
                                                <h5 class="ps-8">Allergies</h5>
                                            </div>
                                            <div class="text-center">
                                                <h5>Part Time</h5>
                                            </div>
                                            <div class="text-center">
                                                <h5>Actions</h5>
                                            </div>
        
                                        </div>
                                        @if(isset($kids) && !empty($kids) && count($kids) > 0)
                                        @foreach($kids as $kid)
                                        <!--begin::Item-->
                                        <div class="d-inline-grid flex-stack pb-3 mb-3 h-50px" style="grid-template-columns: repeat(8,minmax(200px,1fr));border-bottom: 2px dashed #ddd;">
                                            <!--begin::Section-->
        
        
        
    
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center me-5">
                                                  @php
                                                  $age = App\Helper\GlobalHelper::calculateAgeFromDOB($kid->dob);
                                                  @endphp
                                                  
                                                <!--begin::Content-->
                                                <div class="me-5">
                                                    <!--begin::Title-->
                                                    <a href="{{route('admin.edit.kid',['kid' => $kid->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">{{$age}} yrs</a>
                                                    <!--end::Title-->
                                                    <!--begin::Desc-->
                                                    <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Type:
                                                        @if($age < 2) Infant  @elseif($age >=2 && $age < 4) Toddler @else  Pre School @endif</span>
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
                                                    <h3 class="truncate">
                                                        <a @role('Admin') href="{{route('admin.parents',[ 'search_text' => $kid->parent->code ])}}" @else href="{{route('provider.parents',[ 'search_text' => $kid->parent->code ])}}" @endrole class="text-gray-800 fw-bold text-hover-primary fs-6">{{ucfirst(optional($kid->parent)->name)}}</a>
                                                    </h3>
                                                    <!--end::Title-->
                                                    <!--begin::Desc-->
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Section-->
        
        
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center me-5">
                                                <!--begin::Flag-->
                                                <!--end::Flag-->
                                                <!--begin::Content-->
                                                <div class="me-5">
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">{{$kid->contact_number}}</a>
                                                    <!--end::Title-->
                                                    <!--begin::Desc-->
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Section-->
        
        
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center justify-content-center me-5">
                                                <!--begin::Flag-->
                                                <!--end::Flag-->
                                                <!--begin::Content-->
                                                <div class="me-5">
                                                    <!--begin::Title-->
                                                    <button @if($kid->photo_permission == 1) class="btn btn-sm btn-dark" @else class="btn btn-sm btn-light" @endif>@if($kid->photo_permission == 1) Yes @else No @endif</button>
                                                        <!--end::Title-->
                                                        <!--begin::Desc-->
                                                        <!--end::Desc-->
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Section-->
        
                                            <!--begin::Wrapper-->
                                            <div class="d-flex align-items-center justify-content-center">
                                                <!--begin::Number-->
                                                <!--begin::Info-->
                                                <div class="m-0">
                                                    <!--begin::Label-->
                                                    @if($kid->status == 0)
                                                    <span class="badge badge-light-danger fs-base">
                                                        Suspended</span>
                                                    @else
                                                    <span class="badge badge-light-success fs-base">
                                                        Active</span>
                                                    @endif
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <div class="mx-10">
                                                <div class="" style="max-width: 180px; height: 35px; overflow-x: scroll; text-wrap: nowrap;">{{ $kid->allergies }}</div>
                                            </div>
        
        
                                                  <!--begin::Section-->
                                                  <div class="d-flex align-items-center justify-content-center me-5">
                                                <!--begin::Flag-->
                                                <!--end::Flag-->
                                                <!--begin::Content-->
                                                <div class="">
                                                    <!--begin::Title-->
                                                    <button @if($kid->is_part_time == 1) class="partTimeButton btn btn-sm btn-dark" @else class="btn btn-sm btn-light" @endif>@if($kid->is_part_time == 1) Yes @else No @endif</button>
                                                    <div class="selectedDays" style="display: none;">
                                                        @if($kid->is_part_time == 1 && !empty($kid->selected_days))
                                                        <ul>
                                                        @foreach(json_decode($kid->selected_days) as $day)
                                                        <li>{{ ucfirst($day) }}</li>
                                                        @endforeach
                                                        </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Section-->
        
                                            <div class="d-flex align-items-center justify-content-center">
                                                <!--begin::Info-->
                                                <a href="{{route('admin.edit.kid',['kid' => $kid->id])}}" class="btn btn-sm btn-light">View</a>
                                                @role('Parent','Admin','Franchise')
                                                <a href="{{route('kid.documents', ['id' => $kid->id] )}}" class="btn btn-sm btn-light">Documents</a>
                                                @endrole
                                                @role('Admin')
                                                <a href="{{route('kid.payment', ['kid_id' => $kid->id] )}}" class="btn btn-sm btn-light">Legder</a>
                                                @endrole
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Wrapper-->
        
        
        
                                        </div>
                                        <!--end::Item-->
        
                                        @endforeach
                                        @else
                                        @include('layouts.partials.no-result')
                                        @endif
        
        
        
                                    </div>
                                </div>
                            </div>
                            <!--end::Items-->
                            @include('layouts.partials.custom_pagination', ['paginator' => $kids])
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
    document.addEventListener('DOMContentLoaded', function () {
        var partTimeButtons = document.querySelectorAll('.partTimeButton');

        partTimeButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var selectedDays = this.nextElementSibling;

                if (this.classList.contains('btn-dark')) {
                    selectedDays.style.display = selectedDays.style.display === 'block' ? 'none' : 'block';
                } else {
                    selectedDays.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection