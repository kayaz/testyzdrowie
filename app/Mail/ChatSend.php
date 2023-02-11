<?php

namespace App\Mail;

use App\Models\Client;
use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChatSend extends Mailable
{
    use Queueable, SerializesModels;

    private $request;
    /**
     * @var Client
     */
    private $client;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Podkarpacki Oddział PTMSiZP - masz nową wiadomość')->view('front.contact.mail-template',
            [
                'request' => $this->request
            ]);
    }
}
