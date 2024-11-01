<!DOCTYPE html>
<html>

<head>
    <style>
        /* Add some basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background-color: #feeede;
            color: #557b43;
            padding: 20px 0;
        }

        .header img {
            max-width: 150px;
            width: 100%;
        }

        .button {
            display: inline-block;
            background-color: #eb5322;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 0;
            font-family: 'Arial', sans-serif; /* Use a web-safe font */
        }

        .table-container {
            width: 100%;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #f1f1f1;
            padding: 10px;
            text-align: center;
        }

        .table th {
            background-color: #eb5322;
            color: #ffffff;
        }

        .table td {
            background-color: #f1f1f1;
        }

        .footer {
            background-color: #feeede;
            text-align: center;
            color: #ffffff;
            padding: 20px 0;
        }

        .footer-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .footer .theme-color-1 {
            color: #557b43;
        }
    </style>
    <style>
        /* Add responsive CSS */
        @media screen and (max-width: 600px) {
            .container {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/media/logos/High5_Daycare_Logo.png') }}" alt="High5 Daycare Logo">
            <h1 style="font-family: 'Arial', sans-serif;">Welcome to High5 Daycare</h1>
        </div>
        <p style="font-family: 'Arial', sans-serif;"><b>Dear {{ $name }},</b></p>
        <p style="font-family: 'Arial', sans-serif;">Welcome to High5 Daycare! We are thrilled to have you as a part of our community.</p>
        <div class="table-container">
            <table class="table">
                <tr>
                    <th>Information</th>
                    <th>Details</th>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $email }}</td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>{{ $password }}</td>
                </tr>
            </table>
        </div>
        <p style="font-family: 'Arial', sans-serif;">To access your account and get started, click the button below:</p>
        <p><a class="button" href="https://portal.high5daycare.ca" target="_blank">Login to your Portal</a></p>
        <p style="font-family: 'Arial', sans-serif;"><b>About High5:</b></p>
        <p style="font-family: 'Arial', sans-serif;">We Provide Special Care For Your Children</p>
        <p style="font-family: 'Arial', sans-serif;">High5 Day Care Inc. is a licensed home childcare agency operating in the Halton region, Ontario. We make an impact on young minds and help to build a better tomorrow for the next generation.</p>
        <p style="font-family: 'Arial', sans-serif;">We look for like-minded individuals having a passion to transform children’s lives through learning.</p>
        <p style="font-family: 'Arial', sans-serif;">We believe that early learning experiences, including careful nurturing, monitoring, and stimulation are the foundation of a child’s growth and development.</p>
        <p style="font-family: 'Arial', sans-serif;">Thank you for choosing High5 Daycare. We look forward to serving you!</p>
        <div class="footer">
            <div class="footer-content">
           <p class="theme-color-1"><b>If you have any questions or need assistance, please don't hesitate to contact us at info@high5daycare.ca</b></p>
            </div>
        </div>
    </div>
</body>

</html>


