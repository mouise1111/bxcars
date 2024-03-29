<?php

namespace App\Http\Controllers;

use PDF;
use Mail;

class PDFController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $data["email"] = "info@bxcars.be";
        $data["title"] = "Confirmation réservation - BX Cars";
        $data["body"] = "Merci pour votre réservation. Retrouvez ci-joint la confirmation officielle de votre réservation entre le ... et le ...";

        $pdf = PDF::loadView('emails.myTestMail', $data);
        $pdf2 = PDF::loadView('emails.mySecondTestMail', $data);

        Mail::send('emails.myTestMail', $data, function ($message) use ($data, $pdf, $pdf2) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "confirmation.pdf")
                ->attachData($pdf2->output(), "confirmation2.pdf");
        });

        dd('Mail sent successfully');
    }

}