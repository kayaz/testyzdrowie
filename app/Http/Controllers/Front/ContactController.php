<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;

use App\Mail\ChatSend;
use Illuminate\Support\Facades\Mail;

use App\Models\Recipient;

use App\Notifications\ContactNotification;

class ContactController extends Controller
{
    function index(){
        return view("front.contact.index");
    }

    function form(ContactFormRequest $request, Recipient $recipient)
    {
        $recipient->notify(new ContactNotification($request));
        Mail::to(settings()->get("page_email"))->send(new ChatSend($request));
        return redirect()->back()->with(
            'success',
            'Twoja wiadomość została wysłana. W najbliższym czasie skontaktujemy się z Państwem celem omówienia szczegółów!'
        );
    }
}
