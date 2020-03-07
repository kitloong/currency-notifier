<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2019-06-02
 * Time: 01:13
 */

namespace App\Repositories\Interfaces;

use App\CurrencyRate;
use Illuminate\Database\Eloquent\Collection;

interface CurrencyRateRepository
{
    /**
     * @param int $id
     * @return CurrencyRate|null
     */
    public function findFirst(int $id): ?CurrencyRate;

    /**
     * @return CurrencyRate[]|Collection
     */
    public function all(): Collection;
}
