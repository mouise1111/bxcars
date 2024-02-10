<!DOCTYPE html>
<html>

<head>
    <title>Confirmation de Réservation</title>
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
            <h2>Confirmation de Réservation</h2>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>Nom complet</th>
                    <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                </tr>
                <tr>
                    <th>Véhicule</th>
                    <td>{{ $reservation->car->model_name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Dates</th>
                    <td>Du {{ \Carbon\Carbon::parse($reservation->start_date)->translatedFormat('j F Y') }} au {{
                        \Carbon\Carbon::parse($reservation->end_date)->translatedFormat('j F Y') }}</td>
                </tr>
                <tr>
                    <th>Lieu de prise</th>
                    <td>
                        @php
                        $locationMap = [
                        'airport' => "Parking de l'Aéroport Ibn Bâtouta",
                        'agency' => 'Agence',
                        'other_city' => 'Autre ville au Maroc',
                        ];
                        $pickupLocationDisplay = $locationMap[$reservation->pickup_location] ??
                        $reservation->pickup_location;
                        @endphp
                        {{ $pickupLocationDisplay }}
                    </td>
                </tr>


                <tr>
                    <th>Prix Total</th>
                    <td>{{ $reservation->total_cost }} DH (Paiement sur place)</td>
                </tr>
            </table>
        </div>
        <div class="total-price">
            Total à payer : <strong>{{ $reservation->total_cost }} DH</strong>
        </div>

        <div class="footer">
            Ceci est une confirmation de réservation. Veuillez présenter ce document lors de votre arrivée.
        </div>

        <div class="instructions">
            <p>Merci de ramener votre passeport ou carte d'identité avec vous.</p>
            <p>Pour toute demande d'annulation, merci de nous informer au moins 3 jours à l'avance.</p>
        </div>

        <div class="safety-tips">
            <h3>Conseils de Sécurité</h3>
            <ul>
                <li>Assurez-vous de connaître les règles de conduite locales avant de prendre le volant.</li>
            </ul>
        </div>

        <div class="conditions">
            <h3>Conditions Générales de Location</h3>
            <p>Votre réservation est soumise à nos conditions générales de location. Nous vous invitons à les consulter
                sur notre site web ou à nous contacter directement pour plus d'informations.</p>
        </div>

        <div class="contact-info">
            <h3>Contact et Assistance</h3>
            <p>En cas de besoin, n'hésitez pas à nous contacter :</p>
            <p>Téléphone : +32 491 76 89 74</p>
            <p>Email : info@bxcars.be</p>
        </div>

    </div>
</body>

</html>