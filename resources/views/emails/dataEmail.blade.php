<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
        }

        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }

        .content {
            padding: 20px;
        }

        .content p {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h2>Vous avez reçu un nouveau message via le formulaire de contact</h2>
        </div>
        <div class="content">
            <p><strong>Email :</strong> {{ $data['email'] }}</p>
            <p><strong>En rapport avec :</strong> 
    @switch($data['subject'])
        @case('service_client')
            Service client
            @break
        @case('support_technique')
            Support technique - Réservation
            @break
        @case('support_vehicule')
            Support - Véhicule
            @break
        @case('recrutement')
            Recrutement
            @break
        @case('autre')
            Autre
            @break
        @default
            Sujet non spécifié
    @endswitch
</p>
            <p><strong>Message :</strong><br>{!! nl2br($data['message']) !!}</p>
        </div>
        <div class="footer">
            Ce message vous est envoyé automatiquement. Pour répondre, cliquez simplement sur répondre à cet email.<br>
            © {{ date('Y') }} Votre Entreprise | <a href="https://bxcars.be">bxcars.be</a>
        </div>
    </div>
</body>

</html>