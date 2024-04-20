<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Models\Empleado;

class PDFController extends Controller
{
    public function index(Empleado $empleado)
    {
        // Prepare data for email and PDF
        $data["email"] = "fabiancava22@gmail.com";
        $data["title"] = "De Soporte Patitos S.A";
        $data["body"] = "This is Demo";

        // Load the view and generate PDF
        $pdf = Pdf::loadView('emails.myTestMail', $data);

        // Get the PDF content as a string
        $pdfContent = $pdf->output();

        // Send email with PDF attachment
        // Mail::send('emails.myTestMail', $data, function($message) use ($data, $pdfContent) {
        //     $message->to($data["email"], $data["email"])
        //             ->subject($data["title"])
        //             ->attachData($pdfContent, "text.pdf");
        // });

        // Return the PDF content as a string
        return $pdfContent;
    }
}
