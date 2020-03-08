<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2020/03/03
 * Time: 23:48
 */

namespace App\Repositories\Interfaces;

use App\CurrencyRate\CurrencyProfile;
use Illuminate\Database\Eloquent\Collection;

interface CurrencyProfileRepository
{
    /**
     * @return CurrencyProfile[]|Collection
     */
    public function findAll(): Collection;

    /**
     * @return CurrencyProfile[]|Collection
     */
    public function findAllByIsActive(): Collection;
}
