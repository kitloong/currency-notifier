<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2019-06-02
 * Time: 01:36
 */

namespace App\Services;

use App\Repositories\Interfaces\CurrencyRateRepository;

/**
 * Class CurrencyRateService
 * @package App\Services
 */
class CurrencyRateService
{
    private $currencyRateRepository;

    public function __construct(CurrencyRateRepository $currencyRateRepository)
    {
        $this->currencyRateRepository = $currencyRateRepository;
    }

    public function getCurrency()
    {
        $this->currencyRateRepository->all();
    }
}
