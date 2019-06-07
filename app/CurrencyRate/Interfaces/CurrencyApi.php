<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2019-06-02
 * Time: 17:44
 */

namespace App\CurrencyRate\Interfaces;

use App\CurrencyRate\CurrencyProfile;
use Exception;

/**
 * Interface CurrencyApi
 * @package App\CurrencyRate\Interfaces
 */
interface CurrencyApi
{
    /**
     * Get currency rate from profile.
     * @param CurrencyProfile $profile
     * @return float
     * @throws Exception
     */
    public function getRate(CurrencyProfile $profile): float;
}
