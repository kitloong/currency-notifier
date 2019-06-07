<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2019-06-02
 * Time: 01:33
 */

namespace App\Repositories\Implementations;

use App\CurrencyRate;
use App\Repositories\Interfaces\CurrencyRateRepository;

final class CurrencyRateRepositoryImpl implements CurrencyRateRepository
{
    private $model;

    public function __construct()
    {
        $this->model = CurrencyRate::class;
    }

    public function find(int $id): ?CurrencyRate
    {
        return CurrencyRate::find($id);
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return CurrencyRate::all();
    }
}
