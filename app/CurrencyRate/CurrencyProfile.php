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
    private $currencies;

    /**
     * @var float
     */
    private $satisfactoryThreshold;

    /**
     * @var float
     */
    private $warningThreshold;

    /**
     * @var string
     */
    private $fromCurrency;

    /**
     * @var string
     */
    private $toCurrency;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->currencies = config('currencyrate.profile.' . $id . '.currencies');
        $this->satisfactoryThreshold = (float) config('currencyrate.profile.' . $id . '.satisfactory_threshold');
        $this->warningThreshold = (float) config('currencyrate.profile.' . $id . '.warning_threshold');

        $this->fromCurrency = key($this->currencies);
        $this->toCurrency = end($this->currencies);
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
    public function getCurrencies(): array
    {
        return $this->currencies;
    }

    /**
     * @return float
     */
    public function getSatisfactoryThreshold(): float
    {
        return $this->satisfactoryThreshold;
    }

    /**
     * @return float
     */
    public function getWarningThreshold(): float
    {
        return $this->warningThreshold;
    }

    /**
     * @return string
     */
    public function getFromCurrency(): string
    {
        return $this->fromCurrency;
    }

    /**
     * @return string
     */
    public function getToCurrency(): string
    {
        return $this->toCurrency;
    }
}
