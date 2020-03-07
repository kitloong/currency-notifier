<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2020/03/03
 * Time: 23:48
 */

namespace App\Repositories\Implementations;

use App\CurrencyRate\CurrencyProfile;
use App\Repositories\Interfaces\CurrencyProfileRepository;
use Illuminate\Database\Eloquent\Collection;

class CurrencyProfileRepositoryImpl implements CurrencyProfileRepository
{
    /**
     * @inheritDoc
     */
    public function findAllByIsActive(): Collection
    {
        return CurrencyProfile::where('is_active', '=', true)
            ->get();
    }
}
