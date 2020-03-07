<?php

namespace App\Console\Commands;

use App\CurrencyRate;
use App\CurrencyRate\Interfaces\CurrencyApi;
use App\Notifications\CurrencyRateChecked;
use App\Repositories\Interfaces\CurrencyProfileRepository;
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
    protected $signature = 'currencyrate:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify use with latest currency rate get from API';

    private $currencyApi;

    private $currencyProfileRepository;

    private const NUM_OF_ATTEMPTS = 5;

    /**
     * Create a new command instance.
     *
     * @param CurrencyApi $currencyApi
     * @param CurrencyProfileRepository $currencyProfileRepository
     */
    public function __construct(CurrencyApi $currencyApi, CurrencyProfileRepository $currencyProfileRepository)
    {
        parent::__construct();

        $this->currencyApi = $currencyApi;
        $this->currencyProfileRepository = $currencyProfileRepository;
    }

    /**
     * Execute the console command.
     *
     * @throws Exception
     */
    public function handle()
    {
        $currencyProfiles = $this->currencyProfileRepository->findAllByIsActive();

        foreach ($currencyProfiles as $profile) {
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
                $currencyRate->profile_id = $profile->id;
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
