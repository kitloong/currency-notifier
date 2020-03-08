# Currency Rate Notifier

[![CircleCI](https://circleci.com/gh/kitloong/currency-notifier.svg?style=svg)](https://circleci.com/gh/kitloong/currency-notifier)

It is troublesome to check currency rate everyday in order to make oversea transfer at desired rate.  

This is a simple scheduler script to notify users when currency rate increased/dropped to preset rate.

## Setup

    composer install
    
    # Create tables
    php artisan migrate
    
    # Swagger
    php artisan l5-swagger:generate
    
    # Create your own currency_profile via Swagger UI
    http://localhost/api/documentation
    
    # Add following to your crontab
    * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
    
Notifier is working now!

### Set your schedule time

Feel free to update your preferred receive notification time at `app\Console\Kernel.php`

    $schedule->command('currencyrate:notify')
        ->dailyAt('09:30');
    
    $schedule->command('currencyrate:notify')
        ->dailyAt('13:00');

    $schedule->command('currencyrate:notify')
        ->dailyAt('16:00');
    
## Manual run

    php artisan currencyrate:notify
    
## currency_profile

|Name|Comment|
|---|---|
|currencies|Currency rate you wish to check with|
|satisfactory_threshold|Rate that you are happy with|
|warning_threshold|Rate at dangerous parameter|

### `currencies` format

`CNY->USD` => Check currency rate from `CNY` to `USD`

`CNY->USD->MYR` => Check currency rate from `CNY` to `USD` and `USD` to `MYR` in single calculation. 
    
### Email notification

Above `satisfactory_threshold`

    Good news!
    CNY => MYR is now 0.633797598743. Go to bank asap!

Between `satisfactory_threshold` and `warning_threshold`

    Hello, 
    CNY => USD is now 0.143252. Have a nice day!

Below `warning_threshold`

    Bad news! 
    CNY => MYR is now 0.593797598743. Please judge!

## Configure pre-commit

    cp .githooks/pre-commit .git/hooks/pre-commit
    chmod +x .git/hooks/pre-commit

## Test

    ./vendor/bin/phpunit --coverage-html ./build/test-coverage
    
## Code sniffer

    ./vendor/bin/phpcs --standard=phpcs.xml --report=checkstyle --report-file=./build/checkstyle.xml
