<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2019-06-02
 * Time: 17:47
 */

namespace App\CurrencyRate;

/**
 * Class CurrencyProfile
 * @package App\CurrencyRate
 */
final class CurrencyProfile
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $rates;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->rates = config('currencyrate.profile.' . $id . '.rates');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getRates(): array
    {
        return $this->rates;
    }
}
