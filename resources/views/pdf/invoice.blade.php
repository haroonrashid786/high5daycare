<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #333;
            background-color: #f7f7f7;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
        }

        .section {
            margin-top: 20px;
            margin: 0 20px;
            /* background-color: #333; */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table tr {
            border-bottom: 1px solid #000;
            width: 100%;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
        }

        .totals {
            margin-top: 20px;
        }

        .table_header_row1 {
            width: 100%;
            border-bottom: 1px solid #333;
        }

        .table_header_row1 h1 {
            color: rgb(4, 88, 67);
        }

        .table_header_row1>tr>table_header_heading {
            text-align: right;
            color: rgb(4, 88, 67);
        }

        .table_header_logo img.logo {
            margin: 0 auto;
            max-width: 150px;
        }

        .table_header_row2 {
            width: 100%;
        }

        .table_header_row2>tr {
            width: 100%;
        }

        .company_info h3 {
            line-height: 0.1;
        }

        .company_info_para {
            font-size: 14px;
        }

        .invoice-info {
            text-align: right;
            font-size: 14px;
            width: 100%;
            line-height: 0.5;
            color: rgb(4, 88, 67);
        }

        .invoice-info-detail {
            font-weight: 400;
            color: black;
            text-align: right;
        }

        .invoice-info-heading {
            text-align: right;
            color: rgb(4, 88, 67);

        }


        .table_header_row3 {
            width: 100%;
            margin-top: 20px;
            border-bottom: 1px solid #333;
        }

        .table_header_row3>tr {
            width: 100%;
        }

        .parent-info {
            width: 40%;
            line-height: 0.5;
            font-weight: 700;
        }

        .parent-info>p:nth-child(2) {
            font-family: Arial, sans-serif;
            line-height: normal;
            font-weight: 400;
        }

        .child-info {
            text-align: right;
        }

        .child-info {
            width: 100%;
            line-height: 0.5;
        }

        .child-info .left {
            text-align: left;
            color: rgb(4, 88, 67);
        }

        .child-info .right {
            text-align: center;
        }

        .invoice_footer {
            width: 100%;
            margin-top: 30px;
            font-size: 14px;
        }

        .invoice_footer .right {
            text-align: center;
        }

        .invoice_footer .padding_left {
            padding-left: 40px;
        }

        .invoice_footer .border {
            border-bottom: 1px solid #333;
        }

        empty_row {
            height: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="table_header_row1">
            <tr class="">
                <td class="table_header_logo">
                    <img src="{{ public_path('assets/media/logos/High5_Daycare_Logo.png') }}" alt="High5 Daycare Logo" class="logo">
                </td>
                <td class="table_header_heading">
                    <h1>Invoice</h1>
                </td>
            </tr>
        </table>

        <table class="table_header_row2">
            <tr class="">
                <td class="parent-info">
                    <p>{{ optional($invoice->parent)->name }}</p>
                    <p>{{ optional($invoice->parent)->address }}</p>

                    <p style="opacity:0;">W</p>

                </td>
                <td></td>

                <!-- <tr> -->
                <td class='invoice-info-heading'>
                    <p>DATE:</p>
                    <p>INVOICE #:</p>
                    <p>KID ID:</p>
                </td>
                <td class="invoice-info-detail">
                    <p>{{ isset($invoice->date) ? \Carbon\Carbon::parse($invoice->date)->format('F j, Y') : \Carbon\Carbon::parse($invoice->created_at)->format('F j, Y')  }}</p>
                    <p>{{ $invoice->invoice_number }}</p>
                    <p>{{ optional($invoice->kid)->code }}</p>
                </td>
                <!-- </tr> -->

            </tr>
        </table>
        <table class="table_header_row3">
            <tr class="">

                <td class="">
                    <table class="child-info">

                        <tr>
                            <td class="left">
                                <p>Kid Name</p>
                                <p>DOB</p>
                                <p>DOJ</p>

                            </td>
                            @if(isset($invoice) && !empty($invoice->invoiceItems))
                            <td class="right">
                                <p>{{ ucfirst(optional($invoice->kid)->full_name) }}</p>
                                <p>{{ \Carbon\Carbon::parse(optional($invoice->kid)->dob)->format('F j,Y') }}</p>
                                <p>{{ \Carbon\Carbon::parse(optional($invoice->kid)->contract_start)->format('F j,Y') }}</p>

                            </td>
                            @endif


                            <td class="left">

                                <p>Service Provider</p>
                                <p>Age</p>
                                <p style="opacity:0;">W</p>

                            </td>
                            @if(isset($invoice) && !empty($invoice->invoiceItems))

                            <td class="right">
                                <?php
                                $age = $invoice->invoiceItems->kid_age;
                                $years = floor($age);
                                $months = round(($age - $years) * 10); // Convert decimal part to months

                                // If months exceed 12, adjust years and months accordingly
                                if ($months >= 12) {
                                    $years++;
                                    $months -= 12;
                                }
                                ?>
                                <p>{{ ucFirst(optional($invoice->provider)->name) }}</p>
                                <p>{{ $years }} year{{ $years != 1 ? 's' : '' }} @if ($months > 0){{ $months }} month{{ $months != 1 ? 's' : '' }}@endif</p>
                                <p style="opacity:0;">W</p>
                            </td>
                            @endif
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="section">
            <table class="table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>No of day</th>
                        <th>Rate</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>

                    @if(isset($invoice) && !empty($invoice->invoiceData) && count($invoice->invoiceData) > 0)
                    @foreach ($invoice->invoiceData as $item)

                    @if($item->isSubsidized)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($invoice->created_at)->format('F,Y') }} Fee</td>
                        <td>{{ $item->presence_count }}</td>
                        <td>{{ $item->kid_rate_for_non_subsidized_days }}</td>
                        <td>{{ $item->presence_count * $item->kid_rate_for_non_subsidized_days }}</td>
                    </tr>

                    <tr>
                        <td>Less: Subsidized Amount</td>
                        <td>{{ $item->subsidized_days }}</td>
                        <td>{{ $item->kid_rate_for_subsidized_days }}</td>
                        <td>{{ $item->kid_rate_for_subsidized_days * $item->subsidized_days }}</td>
                    </tr>
                    @else
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($invoice->created_at)->format('F,Y') }} Fee</td>
                        <td>{{ $item->presence_count }}</td>
                        <td>{{ $item->kid_rate }}</td>
                        <td>{{ $item->kid_total }}</td>
                    </tr>
                    @endif

                    @endforeach
                    @endif

                    @if(isset($invoice->funds) && !empty($invoice->funds) && count($invoice->funds) > 0)
                    @foreach($invoice->funds as $fund)
                    <tr class="table__detail__row">
                        <td>{{ $fund->name }}</td>
                        <td></td>
                        <td></td>
                        <td>{{ $fund->amount }}</td>
                    </tr>
                    @endforeach
                    @endif

                    @if(isset($invoice->registeration_fee) && !empty($invoice->registeration_fee))
                    <tr class="empty_row">
                        <td>Kid Registration Fee</td>
                        <td></td>
                        <td></td>
                        <td>{{$invoice->registeration_fee}}</td>
                    </tr>
                    @endif

                    @if(isset($invoice->security_deposit) && !empty($invoice->security_deposit))
                    <tr class="empty_row">
                        <td>Kid Security Deposit</td>
                        <td></td>
                        <td></td>
                        <td>{{$invoice->security_deposit}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <table class="invoice_footer">


            @if(isset($invoice->subsidary_amount) && !empty($invoice->subsidary_amount))
            <!-- <tr class="">
                <td class="left">Subsidary Amount</td>
                <td class="right border">{{ $invoice->subsidary_amount }}</td>
            </tr> -->
            @endif





            <tr class="">
                <td class="left">Sub Total</td>
                <td class="right border">{{ $invoice->grand_total }}</td>
            </tr>
            <!-- <tr class="">
                <td class="left"><b> Less:</b> Subsidy Adjustment</td>
                <td class="right">{{ $invoice->ministry_amount }}</td>
            </tr> -->
            <!-- <tr class="">
                <td class="left padding_left">Deposit Adjustment</td>
                <td class="right"></td>
            </tr> -->

            @if(isset($invoice->advance_payment) && !empty($invoice->advance_payment))
            <tr class="">
                <td class="left"><b> Less:</b> Security Deposit</td>
                <td class="right">{{ $invoice->advance_payment }}</td>
            </tr>
            @endif


            @if(!empty($invoice->modified_amount) && !empty($invoice->modified_description))
            <tr class="">
                <td class="left padding_left">{{ $invoice->modified_description }}</td>
                <td class="right border">{{ $invoice->modified_amount }}</td>
            </tr>
            @endif

            @if(!empty($invoice->added_ministry_fund_amount) && !empty($invoice->added_ministry_fund_type))
            <tr class="">
                <td class="left padding_left">{{ $invoice->added_ministry_fund_type }}</td>
                <td class="right border">{{ $invoice->added_ministry_fund_amount }}</td>
            </tr>
            @endif

            @if(!empty($invoice->previous_balance) && !empty($invoice->previous_balance))
            <tr class="">
                <td class="left padding_left">Previous Balance</td>
                <td class="right border">-{{ $invoice->previous_balance }}</td>
            </tr>
            @endif

            @if(isset($alreadyPaid) && !empty($alreadyPaid))
            <tr class="">
                <td class="left"><b>Already Paid</b></td>
                <td class="right border "><b>{{ $alreadyPaid }}</b></td>
            </tr>
            @endif

            @if(isset($invoice->balance) && !empty($invoice->balance))
            <!-- <tr class="">
                <td class="left"><b>Balance</b></td>
                <td class="right border "><b>{{ $invoice->balance }}</b></td>
            </tr> -->
            @endif

            @php
            $netAmount = round($invoice->net_amount,2);
            @endphp


            <tr class="">
                <td class="left"><b>Net Payment/(Excess)</b></td>
                <td class="right border "><b> @if(isset($invoice->balance) && !empty($invoice->balance)) - {{ $invoice->balance }} @else {{ $netAmount }} @endif</b></td>
            </tr>

        </table>

    </div>
</body>

</html>