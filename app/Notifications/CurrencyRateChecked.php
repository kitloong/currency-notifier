<?php

namespace App\Notifications;

use App\CurrencyRate\CurrencyProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CurrencyRateChecked extends Notification
{
    use Queueable;

    private $profile;

    private $rate;

    /**
     * Create a new notification instance.
     *
     * @param CurrencyProfile $profile
     * @param float $rate
     */
    public function __construct(CurrencyProfile $profile, float $rate)
    {
        $this->profile = $profile;
        $this->rate = $rate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $messageArgs = [
            'from' => $this->profile->getFromCurrency(),
            'to' => $this->profile->getToCurrency(),
            'rate' => $this->rate
        ];
        if ($this->rate >= $this->profile->satisfactory_threshold) {
            $message = __('mail/currency_rate_checked.body.good', $messageArgs);
        } elseif ($this->rate <= $this->profile->warning_threshold) {
            $message = __('mail/currency_rate_checked.body.bad', $messageArgs);
        } else {
            $message = __('mail/currency_rate_checked.body.normal', $messageArgs);
        }

        return (new MailMessage)
            ->view('mail.raw', ['text' => $message]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
