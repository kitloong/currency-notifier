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
use Illuminate\Database\Eloquent\Collection;

final class CurrencyRateRepositoryImpl implements CurrencyRateRepository
{
    private $model;

    public function __construct()
    {
        $this->model = CurrencyRate::class;
    }

    public function findFirst(int $id): ?CurrencyRate
    {
        return CurrencyRate::find($id);
    }

    public function all(): Collection
    {
        return CurrencyRate::all();
    }
}
