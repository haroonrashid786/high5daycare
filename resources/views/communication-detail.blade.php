@extends('layouts.app')
@role('Admin')
@section('title', $ticket->subject . ' Communications | Admin | High5 Daycare')
@elserole('Franchise')
@section('title', $ticket->subject . ' Communications | Provider | High5 Daycare')
@else
@section('title', $ticket->subject . ' Communications | Parent | High5 Daycare')
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
                            <span>Communication</span>
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
                        <li class="breadcrumb-item text-white">Communications</li>
                        <li class="breadcrumb-item text-white"> / Ticket ID: {{$ticket->ticket_id}}</li>

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
                        <!--begin::Card body-->
                        <div class="card-body align-items-end">
                            <!--begin::Wrapper-->
                            <!--begin::Modal header-->
                            <!--begin::Modal title-->
                            <h2 class="fw-bold" data-kt-calendar="title">Ticket ID: {{$ticket->ticket_id}}</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->

                            <!--end::Close-->
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="py-5 px-lg-10">
                                <!--begin::Input group-->

                                <!--end::Input group-->

                                <div class="row row-cols-lg-2 g-10">
                                    <div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0">
                                        <!--begin::Ticket view-->
                                        <div class="mb-0">
                                            <!--begin::Heading-->
                                            <div class="d-flex align-items-center mb-12">
                                                <!--begin::Icon-->
                                                <i class="ki-outline ki-file-added fs-4qx text-success ms-n2 me-3"></i>
                                                <!--end::Icon-->
                                                <!--begin::Content-->
                                                <div class="d-flex flex-column">
                                                    <!--begin::Title-->
                                                    <h1 class="text-gray-800 fw-semibold">{{$ticket->subject}}</h1>
                                                    <!--end::Title-->
                                                    <!--begin::Info-->
                                                    <div class="">
                                                        <!--begin::Label-->
                                                        <span class="fw-semibold text-muted me-6">Reason:
                                                            <a href="#" class="text-muted text-hover-primary">{{optional($ticket->reason)->name}}</a></span>
                                                        <!--end::Label-->
                                                        <!--begin::Label-->
                                                        <span class="fw-semibold text-muted me-6">By:
                                                            <a href="#" class="text-muted text-hover-primary">{{optional($ticket->sender)->name}}</a></span>
                                                        <!--end::Label-->
                                                        <!--begin::Label-->
                                                        <span class="fw-semibold text-muted">Created:
                                                            <span class="fw-bold text-gray-600 me-1"></span>({{ \Carbon\Carbon::parse($ticket->created_at)->format('d.m.Y \a\t g:i A') }})</span>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Heading-->
                                            <!--begin::Details-->
                                            <div class="mb-15">
                                                <!--begin::Description-->
                                                <div class="mb-15 fs-5 fw-normal text-gray-800">
                                                    <!--begin::Text-->
                                                    <div class="mb-5 fs-5">Hello,</div>
                                                    <!--end::Text-->
                                                    <!--begin::Text-->
                                                    <div class="mb-10">{{$ticket->description}}</div>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Description-->
                                                <!--begin::Row-->

                                                <!--end::Row-->

                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Comments-->
                                            <div class="mb-15">
                                                <div class="overflow-auto border mb-5 rounded p-4 scroll-bottom" style="height: 50vh;">
                                                    @if(isset($messages) && !empty($messages))
                                                    @foreach($messages as $message)
                                                    <!--begin::Comment-->
                                                    <div class="mb-9">
                                                        <!--begin::Card-->
                                                        <div class="card card-bordered w-100">
                                                            <!--begin::Body-->
                                                            <div class="card-body">
                                                                <!--begin::Wrapper-->
                                                                <div class="w-100 d-flex flex-stack mb-8">
                                                                    <!--begin::Container-->
                                                                    <div class="d-flex align-items-center f">
                                                                        <!--begin::Author-->
                                                                        <div class="symbol symbol-50px me-5 w-auto">
                                                                            <div class="symbol-label fs-1 fw-bold bg-light-info text-info">
                                                                                <img class="h-100 w-100" style="object-fit: contain;" alt="" @if(isset($message->sender) && $message->sender->hasRole('Admin')) src="{{ asset('assets/media/logos/favicon.png') }}"
                                                                                @elseif(isset($message->sender) && $message->sender->hasRole('Franchise')) src="{{isset($message->sender->provider->logo) ? url($message->sender->provider->logo) : 'https://source.unsplash.com/random'}}"
                                                                                @elseif(isset($message->sender) && $message->sender->hasRole('Parent')) src="{{isset($message->sender->parent->display_picture) ? url($message->sender->parent->display_picture) : 'https://source.unsplash.com/random'}}"
                                                                                @else src="https://source.unsplash.com/random" @endif>
                                                                            </div>
                                                                        </div>
                                                                        <!--end::Author-->
                                                                        <!--begin::Info-->
                                                                        <div class="d-flex flex-column fw-semibold fs-5 text-gray-600 text-dark">
                                                                            <!--begin::Text-->
                                                                            <div class="d-flex align-items-center">
                                                                                <!--begin::Username-->
                                                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-5 me-3">{{$message->sender->name}}</a>
                                                                                <!--end::Username-->
                                                                                @if($message->sender_id == $ticket->sender_id)
                                                                                <span class="badge badge-light-danger">Author</span>
                                                                                @endif
                                                                            </div>
                                                                            <!--end::Text-->
                                                                            <!--begin::Date-->
                                                                            <span class="text-muted fw-semibold fs-6"> {{$message->created_at->diffForHumans() }}</span>
                                                                            <!--end::Date-->
                                                                        </div>
                                                                        <!--end::Info-->
                                                                    </div>
                                                                    <!--end::Container-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Desc-->
                                                                <p class="fw-normal fs-5 text-gray-700 m-0">{{ $message->message }}</p>
                                                                @if(count($message->media) > 0)
                                                                <div class="mt-2">
                                                                    @foreach($message->media as $m)
                                                                    <a href="{{ url($m->path) }}" class="text-green-500 hover:text-green-600" target="_blank">View Attachment</a>
                                                                    @endforeach
                                                                </div>
                                                                @endif
                                                                <!--end::Desc-->
                                                            </div>
                                                            <!--end::Body-->
                                                        </div>
                                                        <!--end::Card-->
                                                    </div>
                                                    <!--end::Comment-->
                                                    @endforeach
                                                    @endif
                                                </div>

                                                @if($ticket->sender_id == Auth::id() || $ticket->receiver_id == Auth::id())
                                                @if ($ticket->status == 'open')
                                                <form action="{{ route('send-message') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="receiver_id" value="{{ $ticket->sender->id == Auth::id() ? $ticket->receiver->id : $ticket->sender->id }}">
                                                    <!--begin::Input group-->
                                                    <div class="mb-0">
                                                        <textarea class="form-control form-control-solid placeholder-gray-600 fw-bold fs-4 ps-9 pt-7" rows="6" name="message" placeholder="Enter your message"></textarea>
                                                        <!--begin::Submit-->
                                                        <button type="submit" class="btn btn-primary mt-n20 mb-20 position-relative float-end me-7">Reply</button>
                                                        <!--end::Submit-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </form>
                                                @else
                                                <div class="mb-0">
                                                    <textarea class="form-control form-control-solid placeholder-gray-600 fw-bold fs-4 ps-9 pt-7" rows="6" name="message" placeholder="Ticket has been closed" disabled></textarea>
                                                    <!--begin::Submit-->
                                                    <button type="submit" class="btn btn-primary mt-n20 mb-20 position-relative float-end me-7" disabled>Closed</button>
                                                    <!--end::Submit-->
                                                </div>
                                                @endif
                                                @endif

                                            </div>
                                            <!--end::Comments-->
                                            <!--begin::Pagination-->

                                            <!--end::Pagination-->
                                        </div>
                                        <!--end::Ticket view-->
                                    </div>
                                </div>

                                <!--end::Input group-->

                                <!--end::Input group-->
                            </div>
                            <!--end::Modal body-->
                            <!--begin::Modal footer-->

                            <!--end::Modal footer-->
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

            <!--end::Row-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>
<script>
    let scroll_bottom = document.querySelector('.scroll-bottom');
    if (scroll_bottom) {
        scroll_bottom.scrollTop = scroll_bottom.scrollHeight
    }
</script>
@endsection