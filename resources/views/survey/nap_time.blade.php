@extends('layouts.app')
@section('title', 'Nap Logs | High5 Daycare')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<style>
    .mainy {
        border-left: 1px solid #F1F1F2;
    }

    .month-picker {
        padding: 12px 6px;
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

    .mainy {
        padding-top: 20px;
    }

    .app-toolbar>div {
        width: 90%;
        flex: none;
        gap: 290px;
    }

    @media screen and (max-width: 1500px) {
        .app-toolbar>div {
            gap: 200px;
        }
    }

    @media screen and (max-width: 1450px) {
        .app-toolbar>div {
            gap: 0px;
        }
    }

    @media screen and (max-width: 1295px) {
        .app-toolbar>div>div:first-child {
            width: 60% !important;
        }

    }

    @media screen and (max-width: 1250px) {
        .app-toolbar>div>div:first-child {
            width: 40% !important;
        }

        .app-toolbar h1 {
            width: 100% !important;
        }

    }

    @media screen and (max-width: 1150px) {
        .app-toolbar>div>div:first-child {
            width: 30% !important;
        }

        .app-toolbar h1 {
            width: 100% !important;
        }

        .app-toolbar>div>div:last-child {
            justify-content: flex-start !important;
        }

    }

    @media screen and (max-width: 992px) {
        .app-toolbar>div>div:first-child {
            width: 80% !important;
        }

    }

    @media screen and (max-width: 800px) {

        .app-toolbar {
            top: 70px;
        }

        .app-toolbar>div {
            display: block !important;
        }

        .app-toolbar>div>div:first-child {
            width: 70% !important;
        }

        .app-toolbar h1 {}

    }

    .app-toolbar h1 {
        width: 70%;
    }

    @media screen and (max-width: 550px) {
        .app-toolbar>div>div {
            flex: 1 auto;
        }

        .app-toolbar>div {
            flex-wrap: wrap;
        }
    }

    @media screen and (max-width: 490px) {
        .app-toolbar>div>div {
            flex: none;
            flex-wrap: wrap;
        }

        .app-toolbar>div {
            flex: none;
            flex-wrap: wrap;
            gap: 30px;
        }
    }

    .w-full {
        width: 100% !important;
    }

    .flex-1 {
        flex: 1 !important;
    }

    .top-120 {
        top: 120px !important;
    }
</style>

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid gap-12">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar d-flex pb-3 pb-lg-5 @role('Parent') top-120 @elserole('Franchise') top-120  @endrole">
            <!--begin::Toolbar container-->
            <div class="@role('Parent') flex-1 @elserole('Franchise') flex-1  @endrole d-flex flex-stack flex-row-fluid">
                <!--begin::Toolbar container-->
                <div class="d-flex flex-column flex-row-fluid">
                    <!--begin::Toolbar wrapper-->
                    <!--begin::Page title-->
                    <div class="page-title d-flex align-items-center me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading @role('Parent') w-full @elserole('Franchise') w-full  @endrole  d-flex flex-column justify-content-center text-white fw-bold fs-lg-3x gap-2">
                            <span>Nap Log @role('Admin') of {{ ucfirst($provider->name) }} (#{{ ($provider->code) }}) @endrole</span>
                            <!-- <span>Nap Time</span> -->
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
                        <li class="breadcrumb-item text-white">Nap Log</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center justify-content-md-center gap-2">

                    <div class="d-flex align-items-center">
                        <button class="btn btn-primary" id="exportButton" style="width: 135px;
    padding: 12px 6px;
    font-size: 14px;">Save as CSV</button>
                    </div>

                    <div class="d-flex align-items-center">
                        <form class="m-0" action="{{ route('all.nap.pd') }}" method="GET" id="monthForm">
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
                            <th>
                                <div>Date</div>
                            </th>
                            @foreach ($kids as $student)
                            <th colspan="4" style="text-align:center;white-space: nowrap;width: 500px;">{{ $student->full_name ? ucfirst($student->full_name) : '' }}
                            </th>
                            @endforeach
                        </tr>
                        <tr>
                            <td></td>
                            @foreach ($kids as $student)
                            <td>Sleeping</td>
                            <td>Awaking</td>
                            <td>Checking</td>
                            <td>Note</td>

                            @endforeach
                        </tr>
                    </thead>
                    <tbody>

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
                                $nap = App\Models\NapTime::where('kid_id',$student->id)->where('date',$date)->first();
                                $attendance = App\Models\Attendance::where('kid_id',$student->id)->where('date',$date)->first();

                                @endphp

                                @if (!$isWeekend)
                                <input type="hidden" name="" id="">

                                <td style='height: 50px;'>
                                    <div style='height: 50px;' class="d-flex justify-content-center align-items-center h-full">
                                        <input style='color:black;font-size: 16px;' data-student-id="{{ $student->id }}" data-time-date="{{ $date }}" type="time" class="form-control timePicker drop_off_time sleeping_time" id="sleeping_time{{ $student->id }}_{{ $date }}" value="{{ !empty($nap->sleeping_time)? $nap->sleeping_time : ''  }}"
                                        name="" {{ $attendance ? 'disabled' : '' }}>
                                    </div>
                                </td>
                                <td style='height: 50px;'>
                                    <div style='height: 50px;' class="d-flex justify-content-center align-items-center h-full">
                                        <input style='color:black;font-size: 16px;' data-student-id="{{ $student->id }}" data-time-date="{{ $date }}" type="time" class="form-control timePicker pick_up_time awaking_time" id="awaking_time{{ $student->id }}_{{ $date }}" value="{{ !empty($nap->awaking_time)? $nap->awaking_time : ''  }}"
                                        name="" {{ $attendance ? 'disabled' : '' }}>
                                    </div>
                                </td>
                                <td style='height: 50px;' class="text-center">
                                    <div style='height: 50px;' class="d-flex justify-content-center align-items-center h-full">
                                        <input style='color:black;font-size: 16px;' data-student-id="{{ $student->id }}" data-time-date="{{ $date }}" type="time" class="form-control timePicker pick_up_time checking_time" id="checking_time{{ $student->id }}_{{ $date }}" value="{{ !empty($nap->checking_time)? $nap->checking_time : ''  }}"
                                        name="" {{ $attendance ? 'disabled' : '' }}>
                                    </div>

                                </td>
                                <td style='height: 50px;' class="text-center">


                                    <div style='height: 50px;' class="d-flex justify-content-center align-items-center h-full">
                                        <input style='color:black;font-size: 16px; width: 133px;' data-student-id="{{ $student->id }}" data-time-date="{{ $date }}" type="text" value="{{ !empty($nap->note)? $nap->note : ''  }}" class="form-control timePicker pick_up_time noteInp" id="note{{ $student->id }}_{{ $date }}"
                                        name="" {{ $attendance ? 'disabled' : '' }}>
                                    </div>
                                    <button class="btn btn-primary mt-1 note-btn" type="button" data-student-id="{{ $student->id }}" data-time-date="{{ $date }}" {{ $attendance ? 'disabled' : '' }}>Add</button>

                                </td>

                                @else
                                <td style="border-right: 3px solid #E9E9EA" colspan="3" class="text-center {{ $isWeekend ? 'bg-danger-subtle' : '' }} ">
                                    <div style='height: 50px;' class="d-flex justify-content-center align-items-center h-full ">
                                        <span class="non-markable-day">Weekend</span>
                                    </div>
                                </td>
                                @endif

                                @endforeach

                            </tr>
                            @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>

                            <td class="text-center"></td>

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
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>


<script>
    function markTime(studentId, attendanceDate) {
        const sleepingTime = document.querySelector(`#sleeping_time${studentId}_${attendanceDate}`).value;
        const awakingTime = document.querySelector(`#awaking_time${studentId}_${attendanceDate}`).value;
        const checkingTime = document.querySelector(`#checking_time${studentId}_${attendanceDate}`).value;

        console.log(checkingTime);

        axios.post('api/mark-timing', {
                kid_id: studentId,
                date: attendanceDate,
                sleeping_time: sleepingTime,
                awaking_time: awakingTime,
                checking_time: checkingTime,
            })
            .then(function(response) {
                console.log(response);
                // Handle the response from the server
                if (response.success) {
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
                        text: 'Nap Time Updated Successfully',
                        backgroundColor: '#556d33',
                        actionTextColor: '#fff',
                        duration: 100000,
                    });
                    // window.location.reload();
                }
            })
            .catch(function(error) {
                console.error(error);
                alert('An error occurred while marking attendance.');
            });

    }

    function addNote(studentId, attendanceDate) {
        const note = document.querySelector(`#note${studentId}_${attendanceDate}`).value;


        console.log(note);

        axios.post('api/add-note', {
                kid_id: studentId,
                date: attendanceDate,
                note: note,

            })
            .then(function(response) {
                console.log(response);
                // Handle the response from the server
                if (response.success) {
                    let backgroundColor = '#556d33';
                    if (response.data.message == 'Note Added Successfully') {
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
                    // window.location.reload();
                }
            })
            .catch(function(error) {
                console.error(error);
                alert('An error occurred while marking attendance.');
            });

    }

    document.querySelectorAll('.sleeping_time').forEach(function(element) {
        element.addEventListener('change', function() {
            const studentId = this.getAttribute('data-student-id');
            const attendanceDate = this.getAttribute('data-time-date');
            markTime(studentId, attendanceDate);
        });
    });

    document.querySelectorAll('.awaking_time').forEach(function(element) {
        element.addEventListener('change', function() {
            const studentId = this.getAttribute('data-student-id');
            const attendanceDate = this.getAttribute('data-time-date');
            markTime(studentId, attendanceDate);
        });
    });

    document.querySelectorAll('.checking_time').forEach(function(element) {
        element.addEventListener('change', function() {
            const studentId = this.getAttribute('data-student-id');
            const attendanceDate = this.getAttribute('data-time-date');
            markTime(studentId, attendanceDate);
        });
    });

    document.querySelectorAll('.note-btn').forEach(function(element) {
        element.addEventListener('click', function() {
            const studentId = this.getAttribute('data-student-id');
            const attendanceDate = this.getAttribute('data-time-date');
            const awaking_time = document.querySelector(`input[data-student-id="${studentId}"][data-time-date="${attendanceDate}"].awaking_time`);
            const checking_time = document.querySelector(`input[data-student-id="${studentId}"][data-time-date="${attendanceDate}"].checking_time`);
            const sleeping_time = document.querySelector(`input[data-student-id="${studentId}"][data-time-date="${attendanceDate}"].sleeping_time`);
            const note = document.querySelector(`input[data-student-id="${studentId}"][data-time-date="${attendanceDate}"].noteInp`);
            const noteValue = note ? note.value : null;
            if (sleeping_time.value !== "" || awaking_time.value !== "" || checking_time.value !== "") {
                if (!noteValue) {
                    // Display a message to insert drop_time first
                    Snackbar.show({
                        pos: 'bottom-center',
                        text: 'Please insert Note first.',
                        backgroundColor: '#ea6f44',
                        actionTextColor: '#fff',
                        duration: 100000,
                    });
                    event.preventDefault();
                } else {

                    addNote(studentId, attendanceDate);

                }
            } else {
                Snackbar.show({
                    pos: 'bottom-center',
                    text: 'Please Insert Timings first',
                    backgroundColor: '#ea6f44',
                    actionTextColor: '#fff',
                    duration: 100000,
                });
                event.preventDefault();

            }



        });
    });
</script>


<script>
    document.getElementById('monthDropdown').addEventListener('change', function() {
        // Get the selected value from the dropdown
        var selectedMonth = document.getElementById('monthDropdown').value;

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

        // Get the updated URL
        var updatedURL = url.toString();

        // Update the current URL with the new URL
        window.history.replaceState({}, '', updatedURL);

        // Optionally, you can submit the form
        setTimeout(() => {
            location.reload();
        }, 300);
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("exportButton").addEventListener("click", function() {
            exportToExcel();
        });

        function exportToExcel() {
            const wb = XLSX.utils.book_new();
            const ws_data = [];

            // Collect table header (kid names)
            const kids = document.querySelectorAll(".table thead th");
            const headerRow = ['Date'];
            kids.forEach((kid, index) => {
                if (index > 0) {
                    headerRow.push(`${kid.textContent.trim()} - Sleeping`);
                    headerRow.push(`${kid.textContent.trim()} - Awaking`);
                    headerRow.push(`${kid.textContent.trim()} - Checking`);
                    headerRow.push(`${kid.textContent.trim()} - Note`);
                }
            });
            ws_data.push(headerRow);

            // Collect table data
            const rows = document.querySelectorAll(".table tbody tr");
            rows.forEach(row => {
                const rowData = [];

                // Collect date from the first cell
                const dateCell = row.querySelector("td:first-child");
                rowData.push(dateCell.textContent.trim());

                // Collect sleeping, awaking, and checking times for each kid
                const cells = row.querySelectorAll("td input[type='time'], td input.noteInp");
                const kidData = [];
                cells.forEach((cell, index) => {
                    if (index % 4 === 0 && index !== 0) {
                        // Push collected kid data into the row data
                        rowData.push(...kidData);
                        // Reset kid data for the next kid
                        kidData.length = 0;
                    }
                    kidData.push(cell.value);
                });

                // Push the last collected kid data into the row data
                rowData.push(...kidData);

                ws_data.push(rowData);
            });

            const ws = XLSX.utils.aoa_to_sheet(ws_data);
            XLSX.utils.book_append_sheet(wb, ws, "NapTimeData");

            // Save Excel file
            XLSX.writeFile(wb, "NapTimeData.xlsx");
        }

    });
</script>

<!-- Include Bootstrap Datepicker JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
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

@endsection
