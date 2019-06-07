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
    public function testConstruct()
    {
        $profile = new CurrencyProfile(1);
        $this->assertInstanceOf(CurrencyProfile::class, $profile);
    }

    public function testGetId()
    {
        $profile = new CurrencyProfile(1);
        $this->assertSame(1, $profile->getId());
    }

    public function testGetCurrencies()
    {
        Config::set('currencyrate.profile.1.currencies', ['USD' => 'MYR']);
        $profile = new CurrencyProfile(1);
        $this->assertSame(['USD' => 'MYR'], $profile->getCurrencies());
    }

    public function testGetSatisfactoryThreshold()
    {
        Config::set('currencyrate.profile.1.satisfactory_threshold', 2);
        $profile = new CurrencyProfile(1);
        $this->assertSame(2.0, $profile->getSatisfactoryThreshold());
    }

    public function testGetWarningThreshold()
    {
        Config::set('currencyrate.profile.1.warning_threshold', 3);
        $profile = new CurrencyProfile(1);
        $this->assertSame(3.0, $profile->getWarningThreshold());
    }
}
