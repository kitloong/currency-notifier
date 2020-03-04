<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2019-06-07
 * Time: 15:16
 */

namespace Tests\Unit\CurrencyRate;

use App\CurrencyRate\CurrencyProfile;
use Config;
use Tests\TestCase;

/**
 * Class CurrencyProfileTest
 * @package Tests\Unit\CurrencyRate
 */
class CurrencyProfileTest extends TestCase
{
    public function testGetCurrenciesAttribute()
    {
        $profile = new CurrencyProfile();
        $profile->currencies = 'CNY->USD->MYR';
        $this->assertSame([
            'CNY' => 'USD',
            'USD' => 'MYR'
        ], $profile->currencies);
    }

    public function testGetFromCurrency()
    {
        $profile = new CurrencyProfile();
        $profile->currencies = 'CNY->USD->MYR';
        $this->assertSame('CNY', $profile->getFromCurrency());
    }

    public function testGetToCurrency()
    {
        $profile = new CurrencyProfile();
        $profile->currencies = 'CNY->USD->MYR';
        $this->assertSame('MYR', $profile->getToCurrency());
    }
}
