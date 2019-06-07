<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2019-06-02
 * Time: 01:13
 */

namespace App\Repositories\Interfaces;

use App\CurrencyRate;

interface CurrencyRateRepository
{
    /**
     * @param int $id
     * @return CurrencyRate|CurrencyRate[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id): ?CurrencyRate;

    /**
     * @return CurrencyRate[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(): \Illuminate\Database\Eloquent\Collection;
}
