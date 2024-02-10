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

        .language-notice {
            font-size: 0.9em;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">

        <p class="language-notice">
            Pour lire cet email en français, déroulez vers le bas.<br>
            لقراءة هذا البريد الإلكتروني باللغة العربية، انزل للأسفل.<br>
            To read this email in English, please scroll down.
        </p>

        <div class="content">
            <div class="header">
                <h1>Annulation de Votre Réservation</h1>
            </div>
            <p>Bonjour {{ $firstName }},</p>
            <p>Nous sommes au regret de vous informer que votre réservation pour la {{ $reservation->car->model_name ??
                'N/A' }} (du {{ \Carbon\Carbon::parse($reservation->start_date)->translatedFormat('j F Y') }} au
                {{\Carbon\Carbon::parse($reservation->end_date)->translatedFormat('j F Y') }}) chez BX Cars a été
                annulée. Nous comprenons que cela puisse être décevant et nous sommes sincèrement désolés pour tout
                inconvénient que cela pourrait causer.</p>
            <p>Si vous avez des questions ou si vous souhaitez reprogrammer votre réservation à une autre date,
                n'hésitez pas à nous contacter. Nous sommes là pour vous aider à trouver la meilleure solution possible.
            </p>
            <p>Merci de votre compréhension et de votre confiance.</p>
            <p>Cordialement,</p>
            <p>L'équipe de BX Cars</p>

            <hr>
            <div class="header">
                <h1>Cancellation of Your Reservation</h1>
            </div>
            <p>Hello {{ $firstName }},</p>
            <p>We regret to inform you that your reservation for the {{ $reservation->car->model_name ?? 'N/A' }} (from
                {{ \Carbon\Carbon::parse($reservation->start_date)->format('F j, Y') }} to
                {{\Carbon\Carbon::parse($reservation->end_date)->format('F j, Y') }}) at BX Cars has been cancelled. We
                understand this may be disappointing, and we sincerely apologize for any inconvenience this may cause.
            </p>
            <p>If you have any questions or would like to reschedule your reservation for another date, please do not
                hesitate to contact us. We are here to help you find the best possible solution.</p>
            <p>Thank you for your understanding and trust.</p>
            <p>Sincerely,</p>
            <p>The BX Cars Team</p>

            <hr>
            <div class="header">
                <h1>إلغاء حجزك</h1>
            </div>
            <p dir="rtl">مرحباً {{ $firstName }},</p>
            <p dir="rtl">نأسف لإبلاغك بأن حجزك للسيارة {{ $reservation->car->model_name ?? 'غير متوفر' }} (من {{
                \Carbon\Carbon::parse($reservation->start_date)->format('j F Y') }} إلى
                {{\Carbon\Carbon::parse($reservation->end_date)->format('j F Y') }}) في BX Cars قد تم إلغاؤه. نحن ندرك
                أن هذا قد يكون مخيبًا للآمال ونعتذر بصدق عن أي إزعاج قد يسببه هذا.</p>
            <p dir="rtl">إذا كانت لديك أي أسئلة أو كنت ترغب في إعادة جدولة حجزك لتاريخ آخر، فلا تتردد في الاتصال بنا.
                نحن هنا لمساعدتك في إيجاد أفضل حل ممكن.</p>
            <p dir="rtl">شكراً لتفهمك وثقتك.</p>
            <p dir="rtl">مع أطيب التحيات،</p>
            <p dir="rtl">فريق BX Cars</p>
        </div>
        <div class="footer">
            BX Cars<br>
            info@bxcars.be | +32 491 76 89 74<br>
            <a href="https://www.bxcars.be" target="_blank">www.bxcars.be</a>
        </div>
    </div>
</body>

</html>