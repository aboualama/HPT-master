<?php
namespace App\Notifications;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;


class VerifyApiEmail extends VerifyEmailBase
{

  protected function verificationUrl($notifiable)
  {
      return URL::temporarySignedRoute(
        'verificationapi.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
      );
  }
}
