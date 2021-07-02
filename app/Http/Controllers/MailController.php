<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Mail\InvoiceCreated;
use App\Models\User;
use App\Models\Invoice;

class MailController extends Controller
{
    public function send_invoice(Invoice $invoice, User $user)
    {
        // Mail::to($user->email)->send(new InvoiceCreated($invoice, $user));
    }
}
