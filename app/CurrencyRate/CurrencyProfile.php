<?php

namespace App\CurrencyRate;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CurrencyRate\CurrencyProfile
 *
 * @property int $id
 * @property array $currencies
 * @property float $satisfactory_threshold
 * @property float $warning_threshold
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate\CurrencyProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate\CurrencyProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate\CurrencyProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate\CurrencyProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate\CurrencyProfile whereCurrencies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate\CurrencyProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate\CurrencyProfile whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate\CurrencyProfile whereSatisfactoryThreshold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate\CurrencyProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate\CurrencyProfile whereWarningThreshold($value)
 * @mixin \Eloquent
 */
class CurrencyProfile extends Model
{
    private const CURRENCY_SEPARATOR = '->';

    public function getCurrenciesAttribute(string $value): array
    {
        $currencyMap = [];
        $currencies = explode(self::CURRENCY_SEPARATOR, $value);
        foreach ($currencies as $index => $currency) {
            if ($index === 0) {
                continue;
            }

            $currencyMap[$currencies[$index-1]] = $currencies[$index];
        }

        return $currencyMap;
    }

    public function getFromCurrency(): string
    {
        return key($this->currencies);
    }

    public function getToCurrency(): string
    {
        return last($this->currencies);
    }
}
