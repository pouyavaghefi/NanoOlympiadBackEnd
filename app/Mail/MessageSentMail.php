<?php

namespace App\Mail;

use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageSentMail extends Mailable
{
    public $customMessage;
    public $recipient;

    public function __construct(Message $message, $recipient)
    {
        $this->customMessage = $message;
        $this->recipient = $recipient;
    }

    public function build()
    {
        return $this
            ->subject('New Message: ' . $this->customMessage->subject)
            ->view('emails.message_sent')
            ->with([
                'customMessage' => $this->customMessage,
                'user' => $this->recipient,
            ]);
    }

}