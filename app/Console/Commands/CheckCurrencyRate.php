<?php

namespace App\Console\Commands;

use App\CurrencyRate;
use App\CurrencyRate\CurrencyProfile;
use App\CurrencyRate\Interfaces\CurrencyApi;
use App\Notifications\CurrencyRateChecked;
use Exception;
use Illuminate\Console\Command;
use Notification;

class CheckCurrencyRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:currencyrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get defined currency rates';

    private $currencyApi;

    private const NUM_OF_ATTEMPTS = 5;

    /**
     * Create a new command instance.
     *
     * @param CurrencyApi $currencyApi
     */
    public function __construct(CurrencyApi $currencyApi)
    {
        parent::__construct();

        $this->currencyApi = $currencyApi;
    }

    /**
     * Execute the console command.
     *
     * @throws Exception
     */
    public function handle()
    {
        foreach (config('currencyrate.profile') as $profileId => $profile) {
            $profile = new CurrencyProfile($profileId);

            $attempts = 0;
            do {
                try {
                    $rate = $this->currencyApi->getRate($profile);
                } catch (Exception $exception) {
                    // Retry
                    $attempts++;
                    continue;
                }

                // Exit
                break;
            } while ($attempts < self::NUM_OF_ATTEMPTS);

            if (isset($rate)) {
                $currencyRate = new CurrencyRate();
                $currencyRate->profile_id = $profileId;
                $currencyRate->currency_rate = $rate;
                $currencyRate->save();

                $recipients = explode(',', config('currencyrate.recipients'));

                foreach ($recipients as $recipient) {
                    Notification::route('mail', $recipient)
                        ->notify(new CurrencyRateChecked($profile, $rate));
                }
            } else {
                throw new Exception('Failed to get currency rate after retried ' . $attempts . ' times.');
            }
        }
    }
}
