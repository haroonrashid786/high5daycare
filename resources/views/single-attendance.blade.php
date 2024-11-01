@extends('layouts.app')
@section('title', 'Attendance | High5 Daycare')
@section('content')

<style>
    .weekend {
        background-color: orange;
    }

    .marked {
        background-color: lightgreen;
    }

    .non-markable-day {
        color: red;
    }

    .calendar-body {
        overflow-x: scroll;
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
                            <span>Attendance</span>
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
                        <li class="breadcrumb-item text-white">Attendance</li>
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
        <div id="kt_app_content" class="app-content flex-column-fluid overflow-auto card px-8 pt-5">

            @php
            $year = date("Y");
            $month = date("n");
            $firstDay = date("N", strtotime("$year-$month-01"));
            $lastDay = date("t", strtotime("$year-$month-01"));
            $isCurrentDay = now()->day;
            @endphp

            <div id="exampleModalToggle">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" id="exampleModalToggleLabel">{{ now()->format('F') }} | {{ucfirst($kid->full_name)}}</h5> -->
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body pt-0">
                            <div class="container">
                                <div class="row justify-content-center mt-5">
                                    <div class="custom-calendar">

                                        <div class="calendar-header  text-light text-center py-2" style="background-color: #557b43;">
                                            <h4 class="text-white m-0 py-2">{{ now()->format('F') }} | {{ucfirst($kid->full_name)}}</h4>
                                        </div>
                                        <div class="calendar-body p-3">

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Mon</th>
                                                        <th class="text-center">Tue</th>
                                                        <th class="text-center">Wed</th>
                                                        <th class="text-center">Thu</th>
                                                        <th class="text-center">Fri</th>
                                                        <th class="text-center">Sat</th>
                                                        <th class="text-center">Sun</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @for ($row = 0; $row < 6; $row++) <tr>
                                                        @for ($col = 0; $col < 7; $col++) @php $currentDay=$row * 7 + $col - $firstDay + 2; $isWeekend=in_array(date('N',strtotime("$year-$month-$currentDay")), [6, 7]); $isCurrent=$currentDay===date('j'); @endphp 
                                                        @if ($currentDay >= 1 && $currentDay <= $lastDay) 
                                                        @php 
                                                        $dateCheck= new DateTime("$currentMonth->year-$currentMonth->month-$currentDay"); 
                                                        @endphp
                                                        @endif
                                                                <th class="text-center
                                                        
                                                            @if ($isCurrent)
                                                            bg-danger
                                                            @endif" @if ($isWeekend || (isset($dateCheck) && $dateCheck < $kid->contract_start) || (!empty($kid->contract_end) && (isset($dateCheck) && $dateCheck > $kid->contract_end))) style="background:#ccc;" @endif>

                                                                    @if ($currentDay >= 1 && $currentDay <= $lastDay) @php $date=new DateTime("$currentMonth->year-$currentMonth->month-$currentDay");

                                                                        $providerId = $provider->id;
                                                                        $isMarked = App\Helper\GlobalHelper::isAttendanceMarked($kid->id, $date,$providerId);
                                                                        @endphp

                                                                        <label for="checkbox_{{ $currentDay }}" class="checkbox-label cursor-pointer w-100 h-100 @if($isMarked) styled-element @elseif(isset($isCurrentDay) && ($isCurrentDay==$currentDay)) nonstyled-element @endif">{{$currentDay }}</label>
                                                                        <input type="checkbox" @if($date < $kid->contract_start || (!empty($kid->contract_end) && $dateCheck > $kid->contract_end)) disabled @endif style="display: none;" id="checkbox_{{ $currentDay }}" class="hidden checkbox_input @role('Admin') mark-attendance @endrole" @if($isMarked) checked @endif data-student-id="{{ $kid->id }}" data-attendance-date="{{ $date->format('Y-m-d') }}" @role('Franchise') @if(isset($isCurrentDay) && ($isCurrentDay !=$currentDay)) disabled @endif @elserole('Parent') disabled @endrole @if ($isWeekend) disabled @endif>
                                                                </th>
                                                                @endif
                                                                @endfor
                                                                </tr>
                                                                @endfor
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>

<style>
    .styled-element {
        /* default styles */
        background-color: #557b43;
        border-radius: 10px;
        padding: 5px 0px;
        color: #fff;
    }

    .notstyled-element {
        background-color: #ea6f44;
        border-radius: 10px;
        padding: 5px 0px;
        color: #fff;
    }
</style>

<script>
    var markAttendanceRoute = '{{ route("mark-attendance") }}';

    function markAttendance(studentId, attendanceDate) {

        axios.post(markAttendanceRoute, {
                student_id: studentId,
                attendance_date: attendanceDate,
            })
            .then(function(response) {
                // Handle the response from the server
                if (response.data.success) {

                    let backgroundColor = '#556d33';
                    if (response.data.message == 'Attendance Unmarked Successfully' || response.data.status == '404') {
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
                        text: 'Failed to mark attendacne',
                        backgroundColor: '#ea6f44',
                        actionTextColor: '#fff',
                        duration: 100000,
                    });
                }
            })
            .catch(function(error) {
                console.error(error);
                alert('An error occurred while marking attendance.');
            });
    }

    document.querySelectorAll('.mark-attendance').forEach(function(element) {
        element.addEventListener('click', function() {
            const studentId = this.getAttribute('data-student-id');
            const attendanceDate = this.getAttribute('data-attendance-date');
            markAttendance(studentId, attendanceDate);
        });
    });
</script>



@endsection