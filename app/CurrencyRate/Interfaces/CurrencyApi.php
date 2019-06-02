<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2019-06-02
 * Time: 17:44
 */

namespace App\CurrencyRate\Interfaces;

use Exception;

/**
 * Interface CurrencyApi
 * @package App\CurrencyRate\Interfaces
 */
interface CurrencyApi
{
    /**
     * Get currency rate from profile.
     * @param int $profileId
     * @return float
     * @throws Exception
     */
    public function getRate(int $profileId): float;
}
