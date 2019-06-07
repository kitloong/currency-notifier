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

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->currencies = config('currencyrate.profile.' . $id . '.currencies');
        $this->satisfactoryThreshold = (float) config('currencyrate.profile.' . $id . '.satisfactory_threshold');
        $this->warningThreshold = (float) config('currencyrate.profile.' . $id . '.warning_threshold');
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
}
