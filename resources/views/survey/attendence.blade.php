@extends('layouts.app')
@section('title', 'Parent Survey | High5 Daycare')
@section('content')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<style>
    .mainy {
        border-left: 1px solid #F1F1F2;
    }

    th:first-child,
    td:first-child {
        position: -webkit-sticky;
        position: sticky;
        left: -1px;
        z-index: 1;
        background-color: #fff;
        margin-right: -1px;
    }

    .app-toolbar>div {
        gap: 400px !important;
        width: 100%;
    }

    .month-picker{
        padding: 12px 6px;
    }

    

    @media screen and (max-width: 1150px) {
        .app-toolbar>div {
            gap: 100px !important;
        }

        .month-picker{
            padding: 10px 6px;
        }
    }

    @media screen and (max-width: 650px) {
        .app-toolbar>div {
            flex-wrap: wrap;
            gap: 0px !important;
            flex: none;
            width: 80%;
            flex-direction: column;
            align-items: start;
        }

    }


    .app-content {
        padding-top: 20px !important;
    }
</style>

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid gap-12">
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
                            <!-- <span>Attendance @role('Admin') of {{ ucfirst($provider->name) }} (#{{ ($provider->code) }}) @endrole</span> -->
                            <span>Attendance</span>
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Breadcrumb-->
                    <ul style="width: fit-content;" class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
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
                <!--begin::Actions-->
                <div class="d-flex justify-content-2xl-center align-items-center gap-2">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-primary" id="exportButton">Save as CSV</button>
                    </div>

                    <div class="d-flex align-items-center">
                        <form class="m-0" action="{{route('attendance')}}" method="GET" id="monthForm">
                            <input type="text" class="form-control month-picker" id="month-picker" value="{{ $currentMonth->format('Y-M') }}" style="text-align: center;width: 135px;font-size: 14px;" readonly placeholder="Select Month and Year">
                        </form>
                    </div>


                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid card px-8 pt-5">

            <div class='overflow-auto mainy'>
                <table class="table table-bordered w-max">
                    <thead>
                        <tr>
                            <th>Date</th>
                            @foreach ($kids as $student)
                            <th colspan="3" style="text-align:center;white-space: nowrap;width: 500px;border-right: 3px solid #E9E9EA;">{{ $student->full_name ? ucfirst($student->full_name) : '' }}
                            </th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $studentAttendanceTotals = [];
                        @endphp

                        @for ($day = 1; $day <= $currentMonth->daysInMonth; $day++)

                            @php
                            $date = new DateTime("$currentMonth->year-$currentMonth->month-$day");
                            $formattedDate = $date->format('l,F j, Y');
                            $isCurrentDay = $date->format('Y-m-d') === now()->format('Y-m-d');
                            @endphp

                            <tr @if($isCurrentDay) style="font-weight: bold; background-color: #ea6f44;" @endif>

                                <td @if($isCurrentDay) style="white-space: nowrap; color:white;" @else style="white-space: nowrap;height: 50px;" @endif>
                                    <div style='height: 50px;' class="d-flex justify-content-start align-items-center h-full text-dark fw-normal">{{ $formattedDate }}</div>
                                </td>
                                @foreach ($kids as $student)
                                @php
                                $date = $currentMonth->year.'-'.$currentMonth->month.'-'.$day;
                                $isWeekend = in_array(date('N', strtotime($date)), [6, 7]);
                                @endphp
                                @if (!isset($dayStudentCounts[$day]))
                                @php
                                $dayStudentCounts[$day] = 0;
                                @endphp
                                @endif
                                @php
                                $providerId = $provider->id;
                                $isMarked = App\Helper\GlobalHelper::isAttendanceMarked($student->id, $date, $providerId);
                                $studentAttendanceTotals[$student->id] = $studentAttendanceTotals[$student->id] ?? 0;
                                if ($isMarked) {
                                $studentAttendanceTotals[$student->id]++;
                                $dayStudentCounts[$day]++;
                                }
                                $attendanceData = App\Models\Attendance::where('kid_id',$student->id)->where('date',$date)->first();
                                $checkDate = \Carbon\Carbon::parse($date)->format('Y-m-d');
                                $contractDate = \Carbon\Carbon::parse($student->contract_start)->format('Y-m-d');
                                $contractEndDate = \Carbon\Carbon::parse($student->contract_end)->format('Y-m-d');
                                @endphp

                                @if (!$isWeekend)
                                <td style='height: 50px;' class="text-center {{ $isMarked ? 'marked' : '' }}">
                                    <div style='height: 50px;' class="d-flex justify-content-center align-items-center h-full">
                                        <input data-student-id="{{ $student->id }}" @if( $checkDate < $contractDate ||  $checkDate > $contractEndDate) disabled @endif data-attendance-date="{{ $date }}" type="checkbox" @if($isMarked) checked @endif class="form-check-input mx-auto mark-attendance" name="" id="" @role('Parent') disabled @elserole('Franchise') @if(date('n') !=$currentMonth->month) disabled @endif @if($isCurrentDay)
                                        style="border-color: white;" @else disabled @endif @endrole>

                                    </div>

                                </td>
                                <td style='height: 50px;'>
                                    <div style='height: 50px;' class="d-flex justify-content-center align-items-center h-full">
                                        <input style='color:black;font-size: 16px;' @if( $checkDate < $contractDate ||  $checkDate > $contractEndDate) disabled @endif type="time" value="{{ !empty($attendanceData->drop_time)? $attendanceData->drop_time : ''  }}" data-student-id="{{ $student->id }}" data-attendance-date="{{ $date }}" class="form-control timePicker drop_off_time" name="drop_time" id="">
                                    </div>
                                </td>
                                <td style='height: 50px;border-right: 3px solid #E9E9EA;'>
                                    <div style='height: 50px;' class="d-flex justify-content-center align-items-center h-full">
                                        <input style='color:black;font-size: 16px;' @if( $checkDate < $contractDate ||  $checkDate > $contractEndDate) disabled @endif id="pickup_time{{ $student->id }}_{{ $date }}" value="{{ !empty($attendanceData->pickup_time)? $attendanceData->pickup_time : ''  }}" type="time" data-student-id="{{ $student->id }}" data-attendance-date="{{ $date }}" class="form-control timePicker pick_up_time" name="pickup_time">
                                    </div>
                                </td>
                                @else
                                <td colspan="3" class="text-center {{ $isWeekend ? 'bg-danger-subtle' : '' }} ">
                                    <div style='height: 50px;' class="d-flex justify-content-center align-items-center h-full">
                                        <span class="non-markable-day">Weekend</span>
                                    </div>
                                </td>
                                @endif


                                <!-- <input type="hidden" value="{{$student->provider->name}}" id="providerName"> -->

                                @endforeach

                            </tr>
                            @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="font-weight: bold;"></td>

                            <td class="text-center" style="font-weight: bold;"></td>

                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>


        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>



<!-- Include Bootstrap Datepicker JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
    var firstOpen = true;
    var time;

    $('#timePicker').datetimepicker({
        useCurrent: false,
        format: "hh:mm A"
    }).on('dp.show', function() {
        if (firstOpen) {
            time = moment().startOf('day');
            firstOpen = false;
        } else {
            time = "01:00 PM"
        }
        $(this).data('DateTimePicker').date(time);
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
<script>
    function markAttendance(studentId, attendanceDate) {
        // Check if drop_time is inserted before marking attendance
        const dropTimeInput = document.querySelector(`input[data-student-id="${studentId}"][data-attendance-date="${attendanceDate}"].drop_off_time`);
        const dropTimeValue = dropTimeInput ? dropTimeInput.value : null;

        const pickupTimeInput = document.querySelector(`input[data-student-id="${studentId}"][data-attendance-date="${attendanceDate}"].pick_up_time`);
        const pickupTimeValue = pickupTimeInput ? pickupTimeInput.value : null;

        // Make an AJAX request to mark attendance
        axios.post('{{ route("mark-attendance") }}', {
                student_id: studentId,
                attendance_date: attendanceDate,
                drop_time: dropTimeValue,
                pickup_time: pickupTimeValue,
            })
            .then(function(response) {
                // Handle the response from the server
                if (response.data.success) {
                    let backgroundColor = '#556d33';
                    if (response.data.message == 'Attendance Unmarked Successfully') {
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
                        text: 'Failed to mark attendance',
                        backgroundColor: '#ea6f44',
                        actionTextColor: '#fff',
                        duration: 100000,
                    });
                    window.location.reload();
                }
            })
            .catch(function(error) {
                console.error(error);
                alert('An error occurred while marking attendance.');
            });
    }

    document.querySelectorAll('.mark-attendance').forEach(function(element) {
        element.addEventListener('click', function(event) {
            const studentId = this.getAttribute('data-student-id');
            const attendanceDate = this.getAttribute('data-attendance-date');
            const dropTimeInput = document.querySelector(`input[data-student-id="${studentId}"][data-attendance-date="${attendanceDate}"].drop_off_time`);
            const dropTimeValue = dropTimeInput ? dropTimeInput.value : null;

            if (!dropTimeValue && this.checked) {
                // Display a message to insert drop_time first
                Snackbar.show({
                    pos: 'bottom-center',
                    text: 'Please insert drop time first.',
                    backgroundColor: '#ea6f44',
                    actionTextColor: '#fff',
                    duration: 100000,
                });
                // Prevent the checkbox from being checked
                event.preventDefault();
            } else {
                // Call markAttendance function only if drop time is inserted or the checkbox is being unchecked
                markAttendance(studentId, attendanceDate);
            }
        });
    });
</script>

<script>
    function markTime(studentId, attendanceDate) {
        const pickupTimeInput = document.querySelector(`#pickup_time${studentId}_${attendanceDate}`);
        const dropTimeInput = document.querySelector(`input[data-student-id="${studentId}"][data-attendance-date="${attendanceDate}"].drop_off_time`);
        const dropTimeValue = dropTimeInput ? dropTimeInput.value : null;

        if (!dropTimeValue) {
            // Display a message to insert drop time first
            Snackbar.show({
                pos: 'bottom-center',
                text: 'Please insert drop time first.',
                backgroundColor: '#ea6f44',
                actionTextColor: '#fff',
                duration: 100000,
            });
            // Reset the pickup time input
            pickupTimeInput.value = '';
            return;
        }

        const pickupTime = pickupTimeInput.value;

        axios.post('{{ route("mark-pickup-time") }}', {
                kid_id: studentId,
                date: attendanceDate,
                pickup_time: pickupTime,
            })
            .then(function(response) {
                console.log(response);
                // Handle the response from the server
                if (response.data.success) {
                    let backgroundColor = '#556d33';
                    if (response.data.message == 'Pickup Time Updated Successfully') {
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
            })
            .catch(function(error) {
                console.error(error);
                alert('An error occurred while marking attendance.');
            });
    }

    document.querySelectorAll('.pick_up_time').forEach(function(element) {
        element.addEventListener('change', function() {
            const studentId = this.getAttribute('data-student-id');
            const attendanceDate = this.getAttribute('data-attendance-date');
            markTime(studentId, attendanceDate);
        });
    });
</script>


<!-- <script>
    document.getElementById('month-picker').addEventListener('change', function() {
        // Get the selected value from the dropdown
        var selectedMonth = document.getElementById('month-picker').value;

        // // Get the current URL
        var currentURL = window.location.href;

        // Create a URL object to work with the URL
        var url = new URL(currentURL);

        // Check if the "month" parameter already exists in the URL
        if (url.searchParams.has('month')) {
            // If "month" parameter exists, update its value
            url.searchParams.set('month', selectedMonth);
        } else {
            // If "month" parameter doesn't exist, add it
            url.searchParams.append('month', selectedMonth);
        }

        // Get the updated URL
        var updatedURL = url.toString();

        // Update the current URL with the new URL
        window.history.replaceState({}, '', updatedURL);

        // Optionally, you can submit the form
        setTimeout(() => {
            location.reload();
        }, 300);
    });
</script> -->
<script>
    $(document).ready(function() {
        $('.month-picker').datepicker({
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        }).on('changeDate', function(e) {
            // e.date will contain the selected date
            // You can access month and year separately if needed
            var selectedDate = e.date;
            var selectedMonth = selectedDate.getMonth() + 1; // Month is zero-based
            var selectedYear = selectedDate.getFullYear();

            // Update the URL with the selected month and year
            updateUrl(selectedMonth, selectedYear);

            // Log the selected values (you can replace this with your desired logic)
            console.log("Selected Month: " + selectedMonth);
            console.log("Selected Year: " + selectedYear);
        });

        function updateUrl(selectedMonth, selectedYear) {
            // Get the current URL
            var currentURL = window.location.href;

            // Create a URL object to work with the URL
            var url = new URL(currentURL);

            // Check if the "month" parameter already exists in the URL
            if (url.searchParams.has('month')) {
                // If "month" parameter exists, update its value
                url.searchParams.set('month', selectedMonth);
            } else {
                // If "month" parameter doesn't exist, add it
                url.searchParams.append('month', selectedMonth);
            }

            if (url.searchParams.has('year')) {

                url.searchParams.set('year', selectedYear);
            } else {

                url.searchParams.append('year', selectedYear);
            }

            var updatedURL = url.toString();

            window.history.replaceState({}, '', updatedURL);

            // document.getElementById('monthForm').submit();
            setTimeout(() => {
                location.reload();
            }, 300);
        }
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const exportButton = document.getElementById("exportButton");

        exportButton.addEventListener("click", function() {
            // Clone the table and replace checkboxes with "Present" or "Absent" text
            const tableCopy = document.querySelector("table").cloneNode(true);
            const checkboxes = tableCopy.querySelectorAll('input[type="checkbox"]');
            const drop_off_time = tableCopy.querySelectorAll('.drop_off_time');
            const pick_up_time = tableCopy.querySelectorAll('.pick_up_time');
            checkboxes.forEach(checkbox => {
                const textNode = document.createTextNode(checkbox.checked ? "P" : "A");
                checkbox.parentNode.replaceChild(textNode, checkbox);
            });

            drop_off_time.forEach(item => {
                const textNode = document.createTextNode(item.value);
                item.parentNode.replaceChild(textNode, item);
            });

            pick_up_time.forEach(item => {
                const textNode = document.createTextNode(item.value);
                item.parentNode.replaceChild(textNode, item);
            });

            // Create a new Workbook
            const wb = XLSX.utils.book_new();

            // Convert the table copy to a worksheet
            const ws = XLSX.utils.table_to_sheet(tableCopy);

            // Add the modified worksheet to the workbook
            XLSX.utils.book_append_sheet(wb, ws, "Attendance Data");

            // Generate a unique filename
            const filename = "attendance_data_" + new Date().toISOString() + ".xlsx";

            // Save the file
            XLSX.writeFile(wb, filename);
        });
    });
</script>


@endsection