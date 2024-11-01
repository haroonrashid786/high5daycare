@extends('layouts.app')


@role('Admin')
@section('title', 'Communications | Admin | High5 Daycare')
@elserole('Franchise')
@section('title', 'Communications | Provider | High5 Daycare')
@else
@section('title', 'Communications | Parent | High5 Daycare')
@endrole
@section('content')

<style>
    .modal-body input,
    .modal-body .rate,
    .modal-body textarea,
    .modal-body button {
        background: #f9f9f9;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        box-shadow: inset 0 1px 1px #e1e1e1;
        font-size: 16px;
        padding: 8px;
    }

    #review-form input,
    #review-form .rate,
    #review-form textarea,
    #review-form button {
        background: #f9f9f9;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        box-shadow: inset 0 1px 1px #e1e1e1;
        font-size: 16px;
        padding: 8px;
    }

    .rateBox {
        width: 100%;
    }

    .rateBox>label {
        outline: none;
    }

    .reviewComments {
        width: 100%;
    }

    #review-form input[type="radio"] {
        box-shadow: none;
    }

    #review-form button {
        min-width: 48px;
        min-height: 48px;
    }

    #review-form button:hover {
        border: 1px solid #ccc;
        background-color: #fff;
    }

    #review-form .fieldset {
        margin-top: 20px;
        padding: 10px 20px;
    }

    #review-form .right {
        align-self: flex-end;
    }

    button:hover {
        border: 1px solid #ccc;
        background-color: #fff;
    }

    #review-form .rate label,
    #review-form .rate input,
    #review-form .rate1 label,
    #review-form .rate1 input {
        display: inline-block;
    }

    #review-form .rate {
        height: 36px;
        display: inline-flex;
        flex-direction: row-reverse;
        align-items: flex-start;
        justify-content: flex-end;
    }

    #review-form .rate>label {
        margin-bottom: 0;
        margin-top: -5px;
        height: 30px;
    }

    #review-form .rate:not(:checked)>input {
        top: -9999px;
        margin-left: -24px;
        width: 20px;
        padding-right: 14px;
        z-index: -10;
    }

    #review-form .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    /* #star1:focus{

} */
    #review-form .rate2 {
        float: none;
    }

    #review-form .rate:not(:checked)>label::before {
        content: '★ ';
        position: relative;
        top: -10px;
        left: 2px;
    }

    #review-form .rate>input:checked~label {
        color: #ffc700;
        /* outline: -webkit-focus-ring-color auto 5px; */
    }

    .rate>input:checked:focus+label,
    .rate>input:focus+label {
        outline: -webkit-focus-ring-color auto 5px;
    }

    #review-form .rate:not(:checked)>label:hover,
    #review-form .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    #review-form .rate>input:checked+label:hover,
    #review-form .rate>input:checked+label:hover~label,
    #review-form .rate>input:checked~label:hover,
    #review-form .rate>input:checked~label:hover~label,
    #review-form .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .rate:not(:checked)>label::before {
        content: '★ ';
        position: relative;
        top: -10px;
        left: 2px;
    }

    .rate>input:checked~label {
        color: #ffc700;
        /* outline: -webkit-focus-ring-color auto 5px; */
    }

    .rate>input:checked:focus+label,
    .rate>input:focus+label {
        outline: -webkit-focus-ring-color auto 5px;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
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
                            <span>Blogs</span>
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
                        <li class="breadcrumb-item text-white">Blogs</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
                <!--begin::Actions-->
                <div class="d-flex align-self-center flex-center flex-shrink-0">
                    <a href="{{route('create.blog')}}" class="btn btn-sm btn-dark ms-3 px-4 py-3">Create
                        <span class="d-none d-sm-inline">New blog</span></a>
                </div>
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
                        <!--begin::Card body-->
                        <div class="card-body align-items-end">
                            <!--begin::Wrapper-->
                            <form class="form" action="{{ route('all.blogs') }}" method="GET" id="kt_modal_add_event_form">
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Search Blog</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">
                                    <!--begin::Input group-->

                                    <!--end::Input group-->

                                    <div class="row row-cols-lg-1 g-10">
                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Blog Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="search_query" placeholder="Search any ticket id / subject" id="" type="text" value="{{Request('search_query')}}" required />
                                                <!--end::Input-->
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
                            @if(!empty($searchText) )
                           
                            <h3 class="card-title align-items-start flex-column">
                            <span class="site-title-tagline">Search results for "{{ $searchText }}"</span>
                            </h3>
                            @else
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">All Blogs</span>
                            </h3>
                            @endif
                            <!--end::Title-->

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Items-->
                            <div class="">

                                @if(isset($blogs) && !empty($blogs) && count($blogs) > 0)
                                @foreach($blogs as $blog)
                                <!--begin::Item-->
                                <div class="d-grid flex-stack  bg-gray-200 px-3 py-2 rounded" style="grid-template-columns: repeat(4,1fr);">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-5">
                                        <!--begin::Flag-->
                                        <!--end::Flag-->
                                        <!--begin::Content-->
                                        <div class="me-5">
                                            <!--begin::Title-->
                                            <a href="{{ route('edit.blog',['slug'=> $blog->slug]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bold">Title: {{$blog->title}}</a>
                                            <!--end::Title-->
                                            <!--begin::Desc-->
                                            <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Created:
                                                {{$blog->created_at->format('d-m-Y')}}</span>
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
                                            <img style="width:120px; border-radius:20px; object-fit:contain; height:80px" @if(!empty($blog->image)) src="{{url($blog->image)}} " @else src="" @endif class="" alt="" />
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Number-->
                                        <!--end::Number-->
                                        <!--begin::Info-->
                                        <div class="m-0">
                                            <a href="{{ route('edit.blog',['slug'=> $blog->slug]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bold">Content: {{ \Illuminate\Support\Str::limit($blog->content, 30) }}</a>

                                        </div>

                                        <!--end::Info-->
                                    </div>
                                    <div class="d-flex flex-stack justify-content-center gap-1  align-items-center">

                                        <!--begin::Switch-->
                                        <label class="form-check form-switch form-check-custom form-check-solid">

                                            <!--begin::Label-->
                                            @if($blog->status == 0)
                                            <span class="form-check-label fw-semibold text-muted me-4">Deactive</span>
                                            @else
                                            <span class="form-check-label fw-semibold text-muted me-4">Active</span>
                                            @endif
                                            <!--end::Label-->

                                            <input class="form-check-input toggle-status" data-blog-id="{{ $blog->id }}" type="checkbox" value="1" name="status" id="status{{ $blog->id }}" @if(isset($blog) && $blog->status == 1) checked="checked" style="background-color: #557b43;" @elseif(isset($blog) && $blog->status == 0) style="background-color: #eb6f45;" @endif>
                                            
                                        </label>
                                        <a href="{{ route('edit.blog',['slug'=> $blog->slug]) }}"><button style="padding: 10px;" type="button" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></button></a> 
                                        <!--end::Switch-->
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

                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::List widget 23-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <!--end::Col-->
            </div>
            @include('layouts.partials.custom_pagination', ['paginator' => $blogs])
            <!--end::Row-->
            <!--begin::Row-->

            <!--end::Row-->
        </div>
        <!--end::Content-->
    </div>

</div>
@endsection
@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.toggle-status').forEach(function(element) {
            element.addEventListener('change', function() {
                const blogId = this.getAttribute('data-blog-id');
                const status = this.checked ? 1 : 0;

                console.log(status);
                // Make an AJAX request to update the status
                axios.post('/update-blog-status', {
                        blogId: blogId,
                        status: status,
                    })
                    .then(function(response) {
                        if (response.data.success) {
                            let backgroundColor = '#556d33';
                            if (response.data.message == 'Status Updated Successfully') {
                                backgroundColor = '#ea6f44';
                            }

                            Snackbar.show({
                                pos: 'bottom-center',
                                text: response.data.message,
                                backgroundColor: backgroundColor,
                                actionTextColor: '#fff',
                                duration: 100000,
                            });
                            window.location.reload();
                        } else {
                            Snackbar.show({
                                pos: 'bottom-center',
                                text: 'Nap Time Updated Successfully',
                                backgroundColor: '#556d33',
                                actionTextColor: '#fff',
                                duration: 100000,
                            });
                            window.location.reload();
                        }
                        console.log(response.data);
                    })
                    .catch(function(error) {
                        // Handle errors
                        console.error(error);
                        alert('An error occurred while marking attendance.');
                    });
            });
        });
    });
</script>

@endsection