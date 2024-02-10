<!DOCTYPE html>
<html>

<head>
    <title>Reservation Confirmation</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        .header,
        .footer {
            text-align: center;
            color: #444;
        }

        .header h2 {
            margin: 0;
        }

        .content {
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-price {
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature img {
            width: 100px;
            /* Adjust based on your actual image size */
        }

        .footer {
            margin-top: 50px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Reservation Confirmation</h2>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>Full Name</th>
                    <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                </tr>
                <tr>
                    <th>Vehicle</th>
                    <td>{{ $reservation->car->model_name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Dates</th>
                    <td>From {{ \Carbon\Carbon::parse($reservation->start_date)->format('jS F Y') }} to {{
                        \Carbon\Carbon::parse($reservation->end_date)->format('jS F Y') }}</td>
                </tr>
                <tr>
                    <th>Pick-up Location</th>
                    <td>
                        @php
                        $locationMap = [
                        'airport' => "Airport Parking Ibn Battuta",
                        'agency' => 'Agency',
                        'other_city' => 'Another city in Morocco',
                        ];
                        $pickupLocationDisplay = $locationMap[$reservation->pickup_location] ??
                        $reservation->pickup_location;
                        @endphp
                        {{ $pickupLocationDisplay }}
                    </td>
                </tr>
                <tr>
                    <th>Total Price</th>
                    <td>{{ $reservation->total_cost }} DH (Payment on site)</td>
                </tr>
            </table>
        </div>
        <div class="total-price">
            Total to Pay: <strong>{{ $reservation->total_cost }} DH</strong>
        </div>

        <div class="footer">
            This is a reservation confirmation. Please present this document upon arrival.
        </div>

        <div class="instructions">
            <p>Please bring your passport or identity card with you.</p>
            <p>For any cancellation requests, please inform us at least 3 days in advance.</p>
        </div>

        <div class="safety-tips">
            <h3>Safety Tips</h3>
            <ul>
                <li>Make sure to know the local driving rules before taking the wheel.</li>
            </ul>
        </div>

        <div class="conditions">
            <h3>General Rental Conditions</h3>
            <p>Your reservation is subject to our general rental conditions. We invite you to consult them on our
                website or to contact us directly for more information.</p>
        </div>

        <div class="contact-info">
            <h3>Contact and Assistance</h3>
            <p>If you need any help, please don't hesitate to contact us:</p>
            <p>Phone: +32 491 76 89 74</p>
            <p>Email: info@bxcars.be</p>
        </div>

    </div>
</body>

</html>