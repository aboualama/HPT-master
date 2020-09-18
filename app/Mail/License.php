<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class License extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $License;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($License, $user)
    {
      $this->user = $user;
      $this->License = $License;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.license')
        ->with([
            'username' => $this->user['name'],
            'licensecode' => $this->License,
        ]);
    }
}
