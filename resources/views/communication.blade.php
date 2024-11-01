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
              <span>Support</span>
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
            <li class="breadcrumb-item text-white">Support</li>
            <!--end::Item-->
          </ul>
          <!--end::Breadcrumb-->
        </div>
        <!--end::Toolbar container-->
        <!--begin::Actions-->
        <div class="d-flex align-self-center flex-center flex-shrink-0">
          <a href="{{route('create.ticket')}}" class="btn btn-sm btn-dark ms-3 px-4 py-3">Create
            <span class="d-none d-sm-inline">Support Ticket</span></a>
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
              <form class="form" action="" method="GET" id="kt_modal_add_event_form">
                <!--begin::Modal header-->
                <!--begin::Modal title-->
                <h2 class="fw-bold" data-kt-calendar="title">Search Support Ticket</h2>
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
                        <label class="fs-6 fw-semibold mb-2 required">Ticket ID / Subject</label>
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
              <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800">All Tickets</span>
              </h3>
              <!--end::Title-->

            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
              <!--begin::Items-->
              <div class="">

                @if(isset($tickets) && !empty($tickets) && count($tickets) > 0)
                @foreach($tickets as $ticket)
                <!--begin::Item-->
                <div class="d-grid flex-stack @if($ticket->unread_count > 0) bg-gray-200 px-3 py-2 rounded @endif" style="grid-template-columns: repeat(4,1fr);">
                  <!--begin::Section-->
                  <div class="d-flex align-items-center me-5">
                    <!--begin::Flag-->
                    <!--end::Flag-->
                    <!--begin::Content-->
                    <div class="me-5">
                      <!--begin::Title-->
                      <a href="{{ route('communication-detail', ['ticket' => $ticket->id] )}}" class="text-gray-800 fw-bold text-hover-primary fs-6">ID:
                        {{$ticket->ticket_id}}</a>
                      <!--end::Title-->
                      <!--begin::Desc-->
                      <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Created:
                        {{$ticket->created_at->format('d-m-Y')}}</span>
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
                      <a href="{{ route('communication-detail', ['ticket' => $ticket->id] )}}" class="text-gray-800 text-hover-primary fs-6 fw-bold">Subject: {{$ticket->subject}}</a>
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
                    <div class="m-0">
                      <!--begin::Label-->
                      @if($ticket->status == 'closed')
                      <span class="badge badge-light-danger fs-base">
                        Closed</span>
                      @else
                      <span class="badge badge-light-success fs-base">
                        Open</span>
                      @endif
                      <!--end::Label-->
                    </div>

                    <!--end::Info-->
                  </div>
                  <div class="d-flex align-items-center gap-2">
                    <!--begin::Number-->
                    <!--end::Number-->
                    <!--begin::Info-->

                    <a href="{{ route('communication-detail', ['ticket' => $ticket->id] )}}" class="btn btn-sm btn-light">View</a>
                    @if(isset($ticket) && (!empty($ticket)) && $ticket->status == 'open' && ($ticket->sender_id == Auth::id() || $ticket->receiver_id == Auth::id()))
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#endSupportTicketPopup">End</button>
                    @endif

                    @if(!empty($ticket->sender_id) && !empty($ticket->receiver_rating) && $ticket->sender_id == Auth::id())
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="popover" title="Rating {{$ticket->receiver_rating}} ⭐" data-bs-content="{{$ticket->receiver_feedback}}">Feedback</button>
                    @elseif(!empty($ticket->receiver_id) && !empty($ticket->sender_rating) && $ticket->receiver_id == Auth::id())
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="popover" title="Rating {{$ticket->sender_rating}} ⭐" data-bs-content="{{$ticket->sender_feedback}}">Feedback</button>
                    @endif

                    @role('Admin')

                    @if(!empty($ticket->sender_id) && $ticket->sender_id != Auth::id() && !empty($ticket->receiver_rating))
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="popover" title="Rating {{$ticket->receiver_rating}} ⭐" data-bs-content="{{$ticket->receiver_feedback}}">Feedback</button>
                    @elseif(!empty($ticket->receiver_id) && $ticket->receiver_id != Auth::id() && !empty($ticket->sender_rating))
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="popover" title="Rating {{$ticket->sender_rating}} ⭐" data-bs-content="{{$ticket->sender_feedback}}">Feedback</button>
                    @endif

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
              @include('layouts.partials.custom_pagination', ['paginator' => $tickets])
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
  <!-- Button trigger modal -->

  <!-- Modal -->
  @if(isset($ticket))
  <form class="m-0" action="{{ route('end-communication', ['ticket' => $ticket->id] )}}" method="post">
    @csrf
    <div class="modal fade" id="endSupportTicketPopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Give us your feedback</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="review-form">
              <div class="fieldset">
                <label>Rating</label>
                <div class="rate rateBox">
                  <input class="rating__input" type="radio" id="star5" name="rating" value="5" required="">
                  <label class="rating__label" for="star5" title="5 stars">5 stars</label>
                  <input class="rating__input" type="radio" id="star4" name="rating" value="4">
                  <label class="rating__label" for="star4" title="4 stars">4 stars</label>
                  <input class="rating__input" type="radio" id="star3" name="rating" value="3">
                  <label class="rating__sslabel" for="star3" title="3 stars">3 stars</label>
                  <input class="rating__input" type="radio" id="star2" name="rating" value="2">
                  <label class="rating__label" for="star2" title="2 stars">2 stars</label>
                  <input class="rating__input" type="radio" id="star1" name="rating" value="1">
                  <label class="rating__label" for="star1" title="1 star">1 star</label>
                </div>
              </div>

              <div class="fieldset">
                <label class="Comments__label" for="reviewComments">Comments</label>
                <textarea class="reviewComments Comments__textarea" name="feedback" id="reviewComments" cols="20" rows="5"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  @endif
  <!--begin::Footer-->

  <!--end::Footer-->
</div>
@endsection

<script>
  document.getElementById('feedbackBtn').addEventListener('click', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  });
</script>