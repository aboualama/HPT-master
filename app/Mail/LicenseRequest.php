<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LicenseRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject = "Richiesta licenze da nuovo utente";
    public function __construct($data)
    {
      $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->markdown('emails.request-license')
        ->with([
          'username' => $this->data['displayName'],
          'email' => $this->data['email'],
          'number' => $this->data['number'],
          'date' => $this->data['date'],
          'cell' => $this->data['cell'],
        ]);
    }
}
