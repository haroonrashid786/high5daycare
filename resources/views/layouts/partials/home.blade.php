<style>
    .dashboard__cards__container {
        display: flex;
        align-items: center;
        justify-content: start;
    }

    .dashboard__card {
        max-width: 190px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: 10px;
        flex-direction: row-reverse;
    }

    .dashboard__card__box {
        max-width: 200px;
    }

    .dashboard__card__body {
        padding: 0 !important;
        padding-left: 10px !important;
    }

    .card__icon {
        margin-right: 0 !important;
    }

    @media (max-width: 992px) {
        .dashboard__cards__container {
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .dashboard__card {
            max-width: 100%;
            /* width: 100%; */
        }
    }

    @media (max-width: 500px) {
        .dashboard__card__box {
            max-width: 80%;
        }
    }

    .pl-2 {
        padding-left: 10px;
    }

    @media screen and (max-width: 992px) {
        .page-desc {
            font-size: 1rem !important;
        }

        .pl-2 {
            padding-left: 4px;
        }
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
                    <div class="page-title d-flex align-items-center me-3 text-white">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-white fw-bold fs-lg-3x gap-2">
                            <span>
                                Welcome back,&nbsp;@auth {{Auth::user()->name}}
                                @endauth</span>
                            <!--begin::Description-->
                            <span class="page-desc text-white fs-lg-3 fw-semibold pl-2">
                                @role('Admin')
                                You are logged in as a Super Admin
                                @elserole('Franchise')
                                You are logged in as a daycare provider: {{Auth::user()->provider->name}}
                                @else
                                You are logged in as a parent: {{Auth::user()->name}}
                                @endrole
                            </span>
                            <!--end::Description-->
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar container-->
                <!--begin::Actions-->

                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid home_page">
            <!--begin::Row-->
            <div class="row g-5 g-xl-5 mb-5 mb-xl-0 align-items-start dashboard__cards__container">



                @if(isset($totalKids) && (!empty($totalKids)))
                <!--begin::Col-->
                @role('Admin','Franchise')
                <a @role('Admin') href="{{route('admin.kids')}}" @elserole('Franchise') href="{{route('provider.kids')}}" @else href="{{route('parent.kids')}}" @endrole class="col-md-4 mb-xl-5 dashboard__card__box">
                    <div style="background: #EDF9E7;" class="card card-flush dashboard__card">
                        <div class="card-header px-4 pl-0">
                            <div class="card-title flex-stack flex-row-fluid justify-content-start card__icon">
                                <div class="symbol symbol-45px">
                                    <span class="symbol-label">
                                        <img src="{{asset('assets/media/kids.svg')}}" class="" alt="" />
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4 ">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-1 text-dark">{{$totalKids}}</span>
                                <span class="fw-bold fs-8">Total Kids</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endrole
                <!--end::Col-->
                @endif


                @if(isset($totalProviders) && (!empty($totalProviders)))
                <!--begin::Col-->
                <a href="{{route('admin.providers')}}" class="col-md-4 mb-xl-5 dashboard__card__box">
                    <div style="background: #FFEEE9;" class="card card-flush dashboard__card">
                        <div class="card-header px-4">
                            <div class="card-title flex-stack flex-row-fluid justify-content-start card__icon">
                                <div class="symbol symbol-45px">
                                    <span class="symbol-label">
                                        <img src="{{asset('assets/media/provider.svg')}}" class="" alt="" />
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-1 text-dark">{{$totalProviders}}</span>
                                <span class="fw-bold fs-8">Providers</span>
                            </div>
                        </div>
                    </div>
                </a>
                <!--end::Col-->
                @endif

                @if(isset($totalParents) && (!empty($totalParents)))
                <!--begin::Col-->
                <a @role('Admin') href="{{route('admin.parents')}}" @elserole('Franchise') href="{{route('provider.parents')}}" @endrole class="col-md-4 mb-xl-5 dashboard__card__box">
                    <div style="background: #DFFEFA;" class="card card-flush dashboard__card">
                        <div class="card-header px-4">
                            <div class="card-title flex-stack flex-row-fluid justify-content-start card__icon">
                                <div class="symbol symbol-45px">
                                    <span class="symbol-label">
                                        <img src="{{asset('assets/media/parents.svg')}}" class="" alt="" />
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-1 text-dark">{{$totalParents}}</span>
                                <span class="fw-bold fs-8">Parents</span>
                            </div>
                        </div>
                    </div>
                </a>
                <!--end::Col-->
                @endif


                @role('Admin','Franchise')

                <!--begin::Col-->
                @if(isset($totalInfants) && (!empty($totalInfants)))
                <a @role('Admin') href="{{route('admin.kids')}}" @elserole('Franchise') href="{{route('provider.kids')}}" @else href="{{route('parent.kids')}}" @endrole class="col-md-4 mb-xl-5 dashboard__card__box">
                    <div style="background: #F0E2FF;" class="card card-flush dashboard__card">
                        <div class="card-header px-4">
                            <div class="card-title flex-stack flex-row-fluid justify-content-start card__icon">
                                <div class="symbol symbol-45px">
                                    <span class="symbol-label">
                                        <img src="{{asset('assets/media/kids.svg')}}" class="" alt="" />
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-1 text-dark">{{$totalInfants}}</span>
                                <span class="fw-bold fs-8">Infants</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endif
                <!--end::Col-->

                <!--begin::Col-->
                @if(isset($totalToddlers) && (!empty($totalToddlers)))
                <a @role('Admin') href="{{route('admin.kids')}}" @elserole('Franchise') href="{{route('provider.kids')}}" @else href="{{route('parent.kids')}}" @endrole class="col-md-4 mb-xl-5 dashboard__card__box">
                    <div style="background: #FFF5D2;" class="card card-flush dashboard__card">
                        <div class="card-header px-4">
                            <div class="card-title flex-stack flex-row-fluid justify-content-start card__icon">
                                <div class="symbol symbol-45px">
                                    <span class="symbol-label ">
                                        <img src="{{asset('assets/media/kids.svg')}}" class="" alt="" />
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-1 text-dark">{{$totalToddlers}}</span>
                                <span class="fw-bold fs-8">Toddlers</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endif
                <!--end::Col-->


                <!--begin::Col-->
                @if(isset($totalPreschoolers) && (!empty($totalPreschoolers)))
                <a @role('Admin') href="{{route('admin.kids')}}" @elserole('Franchise') href="{{route('provider.kids')}}" @else href="{{route('parent.kids')}}" @endrole class="col-md-4 mb-xl-5 dashboard__card__box">
                    <div style="background: #FFF5D2;" class="card card-flush dashboard__card">
                        <div class="card-header px-4">
                            <div class="card-title flex-stack flex-row-fluid justify-content-start card__icon">
                                <div class="symbol symbol-45px">
                                    <span class="symbol-label">
                                        <img src="{{asset('assets/media/kids.svg')}}" class=""  alt=""   />
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-1 text-dark">{{$totalPreschoolers}}</span>
                                <span class="fw-bold fs-8">Pre Schoolers</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endif
                <!--end::Col-->

                @if(isset($totalSeatsAvailable) && (!empty($totalSeatsAvailable)) && isset($totalFreeSpaces) &&
                (!empty($totalFreeSpaces)))
                <a href="#" class="col-md-4 mb-xl-5 dashboard__card__box">
                    <div style="background: #F0E2FF;" class="card card-flush dashboard__card">
                        <div class="card-header px-4">
                            <div class="card-title flex-stack flex-row-fluid justify-content-start card__icon">
                                <div class="symbol symbol-45px">
                                    <span class="symbol-label">
                                        <img src="{{asset('assets/media/kids.svg')}}" class=""  alt=""   />
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4">
                            <div class="d-flex  flex-column">
                                <span class="fw-bolder fs-1 text-dark" style="text-wrap: nowrap;">{{$totalFreeSpaces}}
                                    /
                                    {{$totalSeatsAvailable}}</span>
                                <span class="fw-bold fs-8" style="text-wrap: nowrap;">Available
                                    Spots</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endif


                @if(isset($totalInfantsSeats) && (!empty($totalInfantsSeats)) && isset($freeInfantSeats) &&
                (!empty($freeInfantSeats)))
                <a href="#" class="col-md-4 mb-xl-5 dashboard__card__box">
                    <div style="background: #FFEEE9;" class="card card-flush dashboard__card">
                        <div class="card-header px-4">
                            <div class="card-title flex-stack flex-row-fluid justify-content-start card__icon">
                                <div class="symbol symbol-45px">
                                    <span class="symbol-label">
                                        <img src="{{asset('assets/media/kids.svg')}}" class=""  alt=""   />
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4">
                            <div class="d-flex  flex-column">
                                <span class="fw-bolder fs-1 text-dark" style="text-wrap: nowrap;">{{$freeInfantSeats}}
                                    /
                                    {{$totalInfantsSeats}}</span>
                                <span class="fw-bold fs-8" style="text-wrap: nowrap;">Infant Spots</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endif


                @if(isset($totalToddlerSeats) && (!empty($totalToddlerSeats)) && isset($freeToddlerSeats) &&
                (!empty($freeToddlerSeats)))
                <a href="#" class="col-md-4 mb-xl-5 dashboard__card__box">
                    <div style="background: #F0E2FF;" class="card card-flush dashboard__card">
                        <div class="card-header px-4">
                            <div class="card-title flex-stack flex-row-fluid justify-content-start card__icon">
                                <div class="symbol symbol-45px">
                                    <span class="symbol-label">
                                    <img src="{{asset('assets/media/kids.svg')}}" class=""  alt=""   />
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4">
                            <div class="d-flex  flex-column">
                                <span class="fw-bolder fs-1 text-dark" style="text-wrap: nowrap;">{{$freeToddlerSeats}}
                                    /
                                    {{$totalToddlerSeats}}</span>
                                <span class="fw-bold fs-8" style="text-wrap: nowrap;">Toddler Spots</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endif


                @if(isset($totalPreSchoolSeats) && (!empty($totalPreSchoolSeats)) && isset($freePreSchoolSeats) &&
                (!empty($freePreSchoolSeats)))
                <a href="#" class="col-md-4 mb-xl-5 dashboard__card__box">
                    <div style="background: #EDF9E7;" class="card card-flush dashboard__card">
                        <div class="card-header px-4">
                            <div class="card-title flex-stack flex-row-fluid justify-content-start card__icon">
                                <div class="symbol symbol-45px">
                                    <span class="symbol-label">
                                    <img src="{{asset('assets/media/kids.svg')}}" class=""  alt=""   />
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4">
                            <div class="d-flex  flex-column">
                                <span class="fw-bolder fs-1 text-dark" style="text-wrap: nowrap;">{{$freePreSchoolSeats}}
                                    /
                                    {{$totalPreSchoolSeats}}</span>
                                <span class="fw-bold fs-9" style="text-wrap: nowrap;">Pre Schoolers Spots</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endif

                @endrole

                <!-- begin::Col-->
                <!-- <div class="col-md-4 mb-xl-10 dashboard__card__box">
                    <div class="card card-flush dashboard__card">
                        <div class="card-header px-4">
                            <div class="card-title flex-stack flex-row-fluid">
                                <div class="symbol symbol-45px me-5">
                                    <span class="symbol-label bg-light-info">
                                        <i class="ki-outline ki-dollar fs-2x text-gray-800"></i>
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-3 text-dark">$450.00</span>
                                <span class="fw-bold fs-8 text-gray-500">Total Earnings</span>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!--end::Col -->

                @role('Parent')
                <!--begin::Col-->
                @if(isset($totalDocuments) && (!empty($totalDocuments)))
                <div class="col-md-4 mb-xl-5 dashboard__card__box">
                    <div class="card card-flush dashboard__card">
                        <div class="card-header px-4">
                            <div class="card-title flex-stack flex-row-fluid">
                                <div class="symbol symbol-45px me-5">
                                    <span class="symbol-label">
                                        <i class="ki-outline ki-document fs-2x text-gray-800"></i>
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-3 text-dark">{{$filledDocumentsCount}} / {{$totalDocuments}} </span>
                                <span class="fw-bold fs-8 text-gray-500">Filled Docs / Total Docs
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif


                @if(isset($kids) && (!empty($kids)) && count($kids) > 0)

                @foreach($kids as $kid)
                <a href="{{route('admin.edit.kid',['kid' => $kid->id])}}" class="col-md-4 mb-xl-10 dashboard__card__box custom__dashboard__card__box">
                    <div class="card card-flush dashboard__card custom__dashboard__card">
                        <div class="card-header px-4">
                            <div class="card-title flex-stack flex-row-fluid justify-content-start card__icon">
                                <div class="symbol symbol-45px">
                                    <span class="symbol-label bg-light-info">
                                        <img @if(isset($kid) && !empty($kid->profile_picture)) src="{{
                                        url($kid->profile_picture) }}" @else src="{{
                                        asset('assets/media/svg/avatars/011-boy-5.svg') }}" @endif class="" alt=""
                                        height="30px" width="30px"/>
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="dashboard__card__body card-body d-flex align-items-end px-5 py-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-3 text-dark" style="font-size: 16px  !important;">{{
                                    $kid->full_name }}</span>
                                <span class="fw-bold fs-8 text-gray-500">#{{ $kid->code }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach

                @endif

                <!--end::Col-->
                @endrole
            </div>
            <!--end::Row-->
            <!--begin::Row-->

            @role('Admin','Franchise')
            <div class="card p-5 mb-5">
                <canvas id="monthlyProviderChart" width="400" height="200"></canvas>
            </div>
            @endrole

            @role('Admin')
            <div class="home_card_div">
                <div class="home_card" style='background: #EDF9E7;'>
                    <h4>All Tickets</h4>
                    <div class='home_card_body'>
                        @if(isset($tickets) && (!empty($tickets)) && count($tickets) > 0)
                        @foreach($tickets as $ticket)
                        <a href="{{ route('communication-detail', ['ticket' => $ticket->id] )}}" class="home_card_map_div">
                            <div>
                                <div class='d-flex py-1 w-100'>
                                    <h5>ID: {{ $ticket->ticket_id }}</h5>
                                    <button>Open</button>
                                </div>
                                <div class="d-flex py-1 w-100">
                                    <p>Created: {{$ticket->created_at->format('d-m-Y')}}</p>
                                    <p>{{$ticket->subject}}</p>
                                </div>
                            </div>
                        </a>

                        @endforeach
                        @else
                        @include('layouts.partials.no-result')
                        @endif
                    </div>
                    <div>
                        <a class="view-btn" href="{{ route('communication') }}">View All</a>
                    </div>
                </div>

                <div class="home_card" style='background: #FFF5D2;'>
                    <h4>Payments</h4>
                    <div class='home_card_body'>
                        @if(isset($payments) && (!empty($payments)) && count($payments) > 0)
                        @foreach($payments as $payment)
                        <a href="{{ route('view.payment', ['paymentId' => $payment->payment_number]) }}" class="home_card_map_div">
                            <div>
                                <div class=' w-100'>
                                    <h5>{{ optional($payment->provider)->name }}</h5>
                                    <h5>Pay# {{ $payment->payment_number }} </h5>

                                </div>
                                <div class="d-flex w-100">
                                    <p>Created: {{$ticket->created_at->format('d-m-Y')}}</p>

                                </div>
                            </div>
                        </a>
                        @endforeach
                        @else
                        @include('layouts.partials.no-result')
                        @endif
                    </div>
                    <div class='btn_div'>
                      <a href="{{route('pay.stubs')}}" class="view-btn">View All</a>
                    </div>
                </div>

                <div class="home_card" style='background: #FFEEE9;'>
                    <h4>Attendance</h4>
                    <div class='home_card_body'>
                        @if(isset($attendance) && (!empty($attendance)) && count($attendance) > 0)
                        @foreach($attendance as $item)
                        <a href="{{route('attendance',['provider_id' => $item->id])}}" class="home_card_map_div">

                            <div class='d-flex justify-content-start align-items-start g-5' style='gap: 10px;align-items: center;'>
                                <div class='d-flex'>
                                    <img @isset($item->logo) src="{{url($item->logo)}}" @else src="" @endisset alt="img">
                                </div>
                                <div class="d-flex w-100">
                                    <div>
                                        <h5>{{ $item->name }}</h5>
                                        <p>Code: {{ $item->code }}</p>
                                    </div>

                                </div>
                            </div>
                        </a>
                        @endforeach
                        @else
                        @include('layouts.partials.no-result')
                        @endif
                    </div>
                    <div>
                      <a href="{{ route('admin.attendance') }}" class="view-btn">View All</a>
                    </div>
                </div>





            </div>
            @endrole
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

<style>
    .home_card_div {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding-bottom: 20px;
    }

    @media screen and (max-width: 1300px) {
        .home_card_div {
            flex-wrap: wrap;
        }

    }

    @media screen and (max-width: 992px) {
        .home_card_div {
            flex-wrap: nowrap;
        }

    }

    @media screen and (max-width: 770px) {
        .home_card_div {
            flex-wrap: wrap;
        }

    }

    .home_card {
        padding: 20px;
        border-radius: 10px;
        width: 100%;

        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    }


    .home_card_body .home_card_map_div>div>div {
        justify-content: space-between;
        align-items: center;
    }

    .home_card_body {
        padding: 10px 0 0 0;
        min-height: 450px;
    }

    .home_card_body .home_card_map_div > div {
        padding: 10px 0;
        max-height: 85px;
    }

    .home_card_body .home_card_map_div:not(:last-child) > div{
        border-bottom: 1px solid rgba(0, 0, 0, 0.2) !important;
    }

    .home_card .view-btn {
        padding: 10px 20px !important;
        width: 100%;
        background: white;
        color: black;
        font-weight: 700;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
    }

    .home_card_body img {
        border-radius: 50%;
        height: 50px;
        width: 50px;
    }


    .home_card h5 {
        font-size: 16px;
        font-weight: 600;
        color: #3A3A3A;
    }

    .home_card h4 {
        font-size: 24px;
        color: #000;
        padding-bottom: 10px;
    }

    .home_card button {
        background: #54AB26;
        padding: 5px 10px;
        border-radius: 5px;
        border: 0;
        color: white;
    }

    .home_card p {
        color: #3A3A3A;
        font-size: 12px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@role('Admin','Franchise')

@php
$datasets = [];
if (isset($monthlyProviderCounts) && !empty($monthlyProviderCounts)) {
$datasets[] = [
'label' => 'Providers Registered',
'data' => $monthlyProviderCounts,
'backgroundColor' => 'rgba(235, 94, 47, 0.2)',
'borderColor' => 'rgba(235, 94, 47, 1)',
'borderWidth' => 1,
];
}

if (isset($monthlyParentCounts) && !empty($monthlyParentCounts)) {
$datasets[] = [
'label' => 'Parents Registered',
'data' => $monthlyParentCounts,
'backgroundColor' => 'rgba(85, 103, 45, 0.2)',
'borderColor' => 'rgba(85, 103, 45, 1)',
'borderWidth' => 1,
];
}

if (isset($monthlyKidCounts) && !empty($monthlyKidCounts)) {
$datasets[] = [
'label' => 'Kids Registered',
'data' => $monthlyKidCounts,
'backgroundColor' => 'rgba(62, 151, 255, 0.2)',
'borderColor' => 'rgba(62, 151, 255, 1)',
'borderWidth' => 1,
];
}
@endphp


<script>
    var ctx = document.getElementById('monthlyProviderChart').getContext('2d');
    var datasets = <?php echo json_encode($datasets); ?>;
    var chartData = {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: datasets
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    if (chartData.data.datasets.length > 0) {
        var chart = new Chart(ctx, chartData);
    }
</script>
@endrole

@role('Parent')
@isset($unfilledDocuments)
<script>
    console.log(<?php echo $unfilledDocuments ?>);
    if (<?php echo $unfilledDocuments ?> > 0) {
        // Display SweetAlert popup
        Swal.fire({
            title: 'Attention!',
            text: 'You have {{ $unfilledDocuments }} unfilled documents for your kid(s). Please take action.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Do Now',
            cancelButtonText: 'Later',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to Laravel route on "Do Now" click
                window.location.href = '{{ route("parent.kids") }}';
            }
        });

    }
</script>
@endisset
@else

@isset($kidsWithUnfilledDocuments)
<script>
    console.log(<?php echo $kidsWithUnfilledDocuments ?>);
    if (<?php echo $kidsWithUnfilledDocuments ?> > 0) {
        // Display SweetAlert popup
        Swal.fire({
            title: 'Attention!',
            text: 'You have {{ $kidsWithUnfilledDocuments }} active kid(s) with unfilled documents. Please take action.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Do Now',
            cancelButtonText: 'Later',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to Laravel route on "Do Now" click
                window.location.href = '{{ route("provider.kids") }}';
            }
        });

    }
</script>
@endisset
@endrole