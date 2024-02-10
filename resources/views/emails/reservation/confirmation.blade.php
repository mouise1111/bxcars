<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Confirmation de votre réservation chez BX Cars</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .header {
            background-color: #EDCD27;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            padding: 20px;
            line-height: 1.6;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
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

        <div class="header">
            <h2>Confirmation de votre réservation</h2>
        </div>
        <div class="content">
            <p>Bonjour {{ $reservation->first_name }},</p>
            <p>Nous sommes ravis de vous informer que votre réservation chez BX Cars a été <strong>acceptée</strong>.
                Votre aventure commence ici !</p>
            <p>Veuillez trouver ci-joint le document de confirmation de votre réservation. Il contient tous les détails
                nécessaires concernant votre location, y compris les informations sur le véhicule, les dates de
                réservation, et les instructions pour la prise en charge.</p>
            <p>Nous vous rappelons de vous présenter avec une pièce d'identité valide et votre permis de conduire au
                moment de récupérer le véhicule.</p>
            <p>Si vous avez des questions ou avez besoin de modifications sur votre réservation, n'hésitez pas à nous
                contacter. Nous sommes là pour vous assurer un voyage agréable et sans tracas.</p>
            <p>Merci de choisir BX Cars pour vos besoins de location de voiture. Nous avons hâte de vous servir !</p>
        </div>

        <hr>

        <!-- English Section -->
        <div class="header">
            <h2>Your Reservation Confirmation</h2>
        </div>
        <div class="content">
            <p>Hello {{ $reservation->first_name }},</p>
            <p>We are pleased to inform you that your reservation at BX Cars has been <strong>accepted</strong>. Your
                adventure starts here!</p>
            <p>Please find attached the confirmation document of your reservation. It contains all the necessary details
                regarding your rental, including vehicle information, reservation dates, and pickup instructions.</p>
            <p>We remind you to present a valid ID and your driver's license when picking up the vehicle.</p>
            <p>If you have any questions or need any modifications to your reservation, please do not hesitate to
                contact us. We are here to ensure a pleasant and hassle-free journey.</p>
            <p>Thank you for choosing BX Cars for your car rental needs. We look forward to serving you!</p>
        </div>

        <hr>

        <!-- Arabic Section -->
        <div class="header">
            <h2>تأكيد حجزك</h2>
        </div>
        <div class="content" dir="rtl">
            <p>مرحباً {{ $reservation->first_name }},</p>
            <p>يسرنا إبلاغك بأن حجزك في BX Cars قد <strong>تم قبوله</strong>. مغامرتك تبدأ هنا!</p>
            <p>يرجى إيجاد مرفق تأكيد الحجز الخاص بك. يحتوي على جميع التفاصيل اللازمة بخصوص إيجارك، بما في ذلك معلومات
                السيارة، تواريخ الحجز، وتعليمات الاستلام.</p>
            <p>نذكرك بضرورة تقديم هوية صالحة ورخصة قيادتك عند استلام السيارة.</p>
            <p>إذا كان لديك أي أسئلة أو تحتاج إلى أي تعديلات على حجزك، لا تتردد في التواصل معنا. نحن هنا لضمان رحلة
                ممتعة وخالية من الهموم.</p>
            <p>شكرًا لاختيارك BX Cars لاحتياجاتك من تأجير السيارات. نتطلع إلى خدمتك!</p>
        </div>

        <div class="footer">
            <p>Vous recevez cet email car vous avez effectué une réservation chez BX Cars. Si vous n'avez pas effectué
                cette réservation, veuillez nous contacter.</p>
        </div>
    </div>
</body>

</html>