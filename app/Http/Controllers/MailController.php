<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendConfirmationLink($emailData)
    {
        Mail::to($emailData['user_email'])->send(new ConfirmationMail($emailData));
    }
}
