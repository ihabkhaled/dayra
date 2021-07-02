<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice;
use App\Models\User;

class InvoiceCreated extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice, User $user)
    {
        $this->invoice = $invoice;
        $this->user = $user;
        $this->subject = "Invoice Created";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invoice.created');
    }
}
