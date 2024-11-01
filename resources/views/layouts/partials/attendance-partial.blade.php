
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
                        <h1
                            class="page-heading d-flex flex-column justify-content-center text-white fw-bold fs-lg-3x gap-2">
                            <span>Attendance @role('Admin') of {{ ucfirst($provider->name) }} (#{{ ($provider->code) }}) @endrole</span>
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-[#fff] fw-bold lh-1">
                            <a @role('Admin') href="{{ route('admin.home') }}" @elserole('Franchise')
                                href="{{ route('provider.home') }}" @else href="{{ route('parent.home') }}" @endrole
                                class="text-white text-hover-primary">
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
                <div class="d-flex align-items-center gap-2">

                    <div class="d-flex align-items-center">
                        <button class="btn btn-primary" id="exportButton">Save as CSV</button>
                    </div>

                    <div class="d-flex align-items-center">
                        <form class="m-0" action="{{route('attendance')}}" method="GET" id="monthForm">
                            <select class="form-select" name="month" id="monthDropdown">
                                @php
                                $currentYear = date('Y');
                                $currentMonthNumber = date('n');
                                $selectedMonth = request()->input('month', $currentMonthNumber);
                                @endphp

                                @for ($month = 1; $month <= $currentMonthNumber; $month++) <option value="{{ $month }}"
                                    {{ $month==$selectedMonth ? 'selected' : '' }}>
                                    {{ date("F", strtotime("$currentYear-$month-01")) }}
                                    </option>
                                    @endfor
                            </select>
                            <input type="submit" style="display: none;">
                        </form>
                    </div>


                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid overflow-auto card px-8 pt-5">


            <table class="table table-bordered w-max">
                <thead>
                    <tr>
                        <th>Date</th>
                        @foreach ($kids as $student)
                        <th style="white-space: nowrap;">{{ $student->full_name ? ucfirst($student->full_name) : '' }}
                        </th>
                        @endforeach
                        <th>Total</th>
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

                            <td @if($isCurrentDay) style="white-space: nowrap; color:white;" @else
                                style="white-space: nowrap;" @endif>{{ $formattedDate }}</td>
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
                            $isMarked = App\Helper\GlobalHelper::isAttendanceMarked($student->id, $date,$providerId);
                            $studentAttendanceTotals[$student->id] = $studentAttendanceTotals[$student->id] ?? 0;
                            if ($isMarked) {
                            $studentAttendanceTotals[$student->id]++;
                            $dayStudentCounts[$day]++;
                            }
                            @endphp

                            <td
                                class="text-center {{ $isWeekend ? 'bg-danger-subtle' : '' }} {{ $isMarked ? 'marked' : '' }}">
                                @if (!$isWeekend)
                                <input data-student-id="{{ $student->id }}" data-attendance-date="{{ $date }}"
                                    type="checkbox" @if($isMarked) checked @endif
                                    class="form-check-input mx-auto mark-attendance" name="" id=""
                                    @role('Parent') disabled @elserole('Franchise') @if(date('n')
                                    !=$currentMonth->month) disabled @endif  @if($isCurrentDay)
                                style="border-color: white;" @else disabled @endif @endrole>
                                @else
                                <span class="non-markable-day">Weekend</span>
                                @endif

                            </td>

                            <!-- <input type="hidden" value="{{$student->provider->name}}" id="providerName"> -->

                            @endforeach
                            <td class="text-center" @if($isCurrentDay) style="color: white;" @endif>
                                {{ $dayStudentCounts[$day] ?? 0}}
                            </td>
                        </tr>
                        @endfor
                </tbody>
                <tfoot>
                    <tr>
                        <td style="font-weight: bold;">Total</td>
                        @foreach ($kids as $student)
                        <td class="text-center" style="font-weight: bold;">{{ $studentAttendanceTotals[$student->id] ??
                            0 }}</td>
                        @endforeach
                        <td></td>
                    </tr>
                </tfoot>
            </table>


            </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>

<script>
    function markAttendance(studentId, attendanceDate) {
        // Make an AJAX request to mark attendance
        // Example using Axios:
        axios.post('api/mark-attendance', {
            student_id: studentId,
            attendance_date: attendanceDate,
        })
            .then(function (response) {
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
            .catch(function (error) {
                console.error(error);
                alert('An error occurred while marking attendance.');
            });
    }

    document.querySelectorAll('.mark-attendance').forEach(function (element) {
        element.addEventListener('click', function () {
            const studentId = this.getAttribute('data-student-id');
            const attendanceDate = this.getAttribute('data-attendance-date');
            markAttendance(studentId, attendanceDate);
        });
    });
</script>


<script>
    document.getElementById('monthDropdown').addEventListener('change', function () {
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
       document.addEventListener("DOMContentLoaded", function () {
        const exportButton = document.getElementById("exportButton");

        exportButton.addEventListener("click", function () {
            // Clone the table and replace checkboxes with "Present" or "Absent" text
            const tableCopy = document.querySelector("table").cloneNode(true);
            const checkboxes = tableCopy.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                const textNode = document.createTextNode(checkbox.checked ? "P" : "A");
                checkbox.parentNode.replaceChild(textNode, checkbox);
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