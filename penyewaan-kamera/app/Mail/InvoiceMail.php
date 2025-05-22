<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pemesanan;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pemesanan;

    public function __construct(Pemesanan $pemesanan)
    {
        $this->pemesanan = $pemesanan;
    }

    public function build()
    {
        // Generate PDF dari view `pdf.invoice`
        $pdf = Pdf::loadView('pdf.invoice', ['pemesanan' => $this->pemesanan]);

        return $this->subject('Invoice Pembayaran - Pemesanan #' . $this->pemesanan->id)
                    ->markdown('emails.invoice') // tampilan email (opsional, bisa HTML biasa)
                    ->attachData($pdf->output(), 'invoice-pemesanan-'.$this->pemesanan->id.'.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
