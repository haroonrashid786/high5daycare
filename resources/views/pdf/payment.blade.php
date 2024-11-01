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
            border-bottom: 1px solid #66b7b7;
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
            border-bottom: 1px solid #66b7b7;
            padding-bottom: 10px;
        }

        .table_header_row1 h1 {
            color: #333;
            font-weight: 400;
            text-align: right;
            font-size: 18px;

        }

        .table_header_row1>tr>.table_header_heading {
            text-align: right;
            color: rgb(4, 88, 67);
        }

        .table_header_logo img.logo {
            margin: 0 auto;
            max-width: 150px;
        }

        .table_header_row2 {
            width: 100%;
            padding: 10px 0;
        }

        .table_header_row2>tr {
            width: 100%;
        }

        .company_info h3 {
            line-height: 0.1;
            font-weight: 400;
        }

        .company_info_para {
            font-size: 12px;
            color: #575555;
        }

        .invoice-info {
            text-align: right;
            font-size: 12px;
            width: 100%;
            line-height: 0.5;
            color: #575555;
        }

        .invoice-info-detail {
            font-weight: 400;
            color: #575555;
        }

        .invoice-info p {
            padding: 6px 0;
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

        .Payment__month {
            padding: 0 20px;
        }

        .Payment__month>p {
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #575555;
        }

        .table__detail__row>td {
            height: 40px;
            font-size: 14px;
            color: #333232;
        }

        .table__heading__row {
            color: #333232;
            font-size: 14px;
        }

        .name_font {
            font-size: 16px;
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
                    <h1>Vendor Payment Detail</h1>
                </td>
            </tr>
        </table>

        <table class="table_header_row2">
            <tr class="">
                <!-- <td class="company_info">
                    <h3>High5 Daycare Inc </h3>
                    <p class="company_info_para">Licensed Home Childcare Agency<br>1434 Orr Terrace, Milton</p>
                </td> -->
                <!-- <td></td> -->
                <td class="">
                    <table class="invoice-info">
                        <tr>
                            <td style='text-align: left;'>
                                <h2 class='name_font' style='font-weight: 800;'>{{ optional($payment->provider)->name }}</h2>

                                <p style='opacity: 0;'>Address</p>
                                <p style='opacity: 0;'>Address</p>
                            </td>
                            <td>
                                <p>DATE:</p>
                                <p>INVOICE #:</p>
                                <p>Service Provider ID:</p>
                            </td>
                            <td class="invoice-info-detail">
                                <p>{{ isset($payment->date) ? \Carbon\Carbon::parse($payment->date)->format('F j, Y') : \Carbon\Carbon::parse($payment->created_at)->format('F j, Y')  }}</p>
                                <p>{{ $payment->payment_number }}</p>
                                <p>{{ optional($payment->provider)->code }}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div class="Payment__month">
            <p class="">Vendor Payment detail for {{ \Carbon\Carbon::parse($payment->created_at)->format('M, Y') }}</p>
        </div>
        <div class="section">
            <table class="table">
                <thead>
                    <tr class="table__heading__row">
                        <th>Kid Name</th>
                        <th>No of day</th>
                        <th>Rate</th>
                        <th>Amount CAD</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($payment) && !empty($payment) && isset($payment->paymentItems) && !empty($payment->paymentItems))
                    @foreach ($payment->paymentItems as $item)
                    <tr class="table__detail__row">
                        <td>{{ ucfirst(optional($item->kid)->full_name) }} @if($item->first_fortnight == 1) (First Fortnight) @elseif($item->second_fortnight == 1) (Second Fortnight) @endif</td>
                        <td>{{ $item->no_of_days }}</td>
                        <td>{{ $item->rate }}</td>
                        <td>{{ $item->amount }}</td>
                    </tr>
                    @endforeach
                    @endif

                    @if(isset($payment) && !empty($payment->hceg_fund))
                    <tr class="table__detail__row">
                        <td>HCEG Fund</td>
                        <td>{{ $payment->provider_presence }}</td>
                        <td>{{ optional($payment->provider)->hceg_funding }}</td>
                        <td>{{ $payment->hceg_fund }}</td>
                    </tr>
                    @endif

                    @if(isset($payment) && !empty($payment->gog_fund))
                    <tr class="table__detail__row">
                        <td>GOG Fund</td>
                        <td>{{ $payment->provider_presence }}</td>
                        <td>{{ optional($payment->provider)->ministry_funding }}</td>
                        <td>{{ $payment->gog_fund }}</td>
                    </tr>
                    @endif

                    @if(isset($payment->funds) && !empty($payment->funds) && count($payment->funds) > 0)
                    @foreach($payment->funds as $fund)
                    <tr class="table__detail__row">
                        <td>{{ $fund->name }}</td>
                        <td></td>
                        <td></td>
                        <td>{{ $fund->amount }}</td>
                    </tr>
                    @endforeach
                    @endif

                    <tr class="empty_row">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <table class="invoice_footer">

            <tr class="">
                <td class="left">Sub Totals</td>
                <td class="right border">{{ $payment->total }}</td>
            </tr>

            @if(isset($payment->previous_balance) && !empty($payment->previous_balance))
            <tr class="">
                <td class="left">Previous Balance (Carry Forward)</td>
                <td class="right border">{{ $payment->previous_balance }}</td>
            </tr>
            @endif
            <!-- <tr class="">
                <td class="left"><b> Less:</b> Advance Payment</td>
                <td class="right"></td>
            </tr> -->
            <!-- <tr class="">
                <td class="left padding_left">Deposit Adjustment</td>
                <td class="right"></td>
            </tr> -->

            @if(!empty($payment->modified_amount) && !empty($payment->modified_description))
            <tr class="">
                <td class="left padding_left">{{ $payment->modified_description }}</td>
                <td class="right border">{{ $payment->modified_amount }}</td>
            </tr>
            @endif

            @if(!empty($payment->added_ministry_fund_type) && !empty($payment->added_ministry_fund_amount))
            <tr class="">
                <td class="left padding_left">{{ $payment->added_ministry_fund_type }}</td>
                <td class="right border">{{ $payment->added_ministry_fund_amount }}</td>
            </tr>
            @endif

            @if(isset($payment->previous_balance) && !empty($payment->previous_balance))
            <tr class="">
                <td class="left"><b>Previous Balance</b></td>
                <td class="right border "><b>- {{ $payment->previous_balance }}</b></td>
            </tr>
            @endif

            @if(isset($alreadyPaid) && !empty($alreadyPaid))
            <tr class="">
                <td class="left"><b>Already Paid</b></td>
                <td class="right border "><b>{{ $alreadyPaid }}</b></td>
            </tr>
            @endif

            @if(isset($payment->balance) && !empty($payment->balance))
            <tr class="">
                <td class="left"><b>Excess Paid</b></td>
                <td class="right border "><b>- {{ $payment->balance }}</b></td>
            </tr>
            @endif

            @php
            if(isset($alreadyPaid) && $alreadyPaid > 0){
            if($alreadyPaid >= $payment->net_amount)
            {
            $netAmount = 0;
            }else{
            $netAmount = round($payment->net_amount - $alreadyPaid,2);
            }
            }else{
            $netAmount = round($payment->net_amount,2);
            }
            @endphp


            <tr class="">
                <td class="left"><b>Net Payment</b></td>
                <td class="right border "><b>{{ $netAmount }}</b></td>
            </tr>
        </table>

    </div>
</body>

</html>