<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2019-06-07
 * Time: 15:31
 */

namespace Tests\Unit\Notifications;

use App\CurrencyRate\CurrencyProfile;
use App\Notifications\CurrencyRateChecked;
use Config;
use Illuminate\Notifications\Messages\MailMessage;
use Tests\TestCase;

/**
 * Class CurrencyRateCheckedTest
 * @package Tests\Unit\Notifications
 */
class CurrencyRateCheckedTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Define currency profile to test
        $profile = [
            1 => [
                'currencies' => [
                    'CNY' => 'USD',
                    'USD' => 'MYR'
                ],
                'satisfactory_threshold' => 0.62,
                'warning_threshold' => 0.60
            ]
        ];
        Config::set('currencyrate.profile', $profile);
    }

    public function testConstruct()
    {
        $profile = new CurrencyProfile(1);
        $notification = new CurrencyRateChecked($profile, 0.61);
        $this->assertInstanceOf(CurrencyRateChecked::class, $notification);
    }

    public function testToMailNormalRate()
    {
        $profile = new CurrencyProfile(1);
        $notification = new CurrencyRateChecked($profile, 0.61);
        $message = $notification->toMail(null);
        $this->assertInstanceOf(MailMessage::class, $message);
        $this->assertSame(
            __('mail/currency_rate_checked.body.normal', [
                'from' => $profile->getFromCurrency(),
                'to' => $profile->getToCurrency(),
                'rate' => 0.61
            ]),
            $message->viewData['text']
        );
    }

    public function testToMailGoodRate()
    {
        $profile = new CurrencyProfile(1);
        $notification = new CurrencyRateChecked($profile, 0.62);
        $message = $notification->toMail(null);
        $this->assertInstanceOf(MailMessage::class, $message);
        $this->assertSame(
            __('mail/currency_rate_checked.body.good', [
                'from' => $profile->getFromCurrency(),
                'to' => $profile->getToCurrency(),
                'rate' => 0.62
            ]),
            $message->viewData['text']
        );
    }

    public function testToMailBadRate()
    {
        $profile = new CurrencyProfile(1);
        $notification = new CurrencyRateChecked($profile, 0.60);
        $message = $notification->toMail(null);
        $this->assertInstanceOf(MailMessage::class, $message);
        $this->assertSame(
            __('mail/currency_rate_checked.body.bad', [
                'from' => $profile->getFromCurrency(),
                'to' => $profile->getToCurrency(),
                'rate' => 0.60
            ]),
            $message->viewData['text']
        );
    }
}
