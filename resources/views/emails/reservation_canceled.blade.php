<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            background-color: #ffffff;
            width: 600px;
            margin: 20px auto;
            padding: 20px;
        }

        .header {
            background-color: #EDCD27;
            color: #ffffff;
            padding: 10px;
            text-align: center;
        }

        .content {
            padding: 20px;
            text-align: left;
        }

        .footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Annulation de Votre Réservation</h1>
        </div>
        <div class="content">
            <p>Bonjour {{ $firstName }},</p>
            <p>Nous sommes au regret de vous informer que votre réservation pour la {{ $reservation->car->model_name ??
                'N/A' }} (du {{ \Carbon\Carbon::parse($reservation->start_date)->translatedFormat('j F Y') }} au
                {{\Carbon\Carbon::parse($reservation->end_date)->translatedFormat('j F Y') }}) chez BX Cars a été
                annulée. Nous comprenons
                que cela puisse être décevant et nous sommes sincèrement désolés pour tout inconvénient que cela
                pourrait causer.</p>
            <p>Si vous avez des questions ou si vous souhaitez reprogrammer votre réservation à une autre date,
                n'hésitez pas à nous contacter. Nous sommes là pour vous aider à trouver la meilleure solution possible.
            </p>
            <p>Merci de votre compréhension et de votre confiance.</p>
            <p>Cordialement,</p>
            <p>L'équipe de BX Cars</p>
        </div>
        <div class="footer">
            BX Cars<br>
            info@bxcars.be | +32 491 76 89 74<br>
            <a href="https://www.bxcars.be" target="_blank">www.bxcars.be</a>
        </div>
    </div>
</body>

</html>