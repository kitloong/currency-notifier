<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CurrencyRate
 *
 * @property int $id
 * @property int $profile_id
 * @property float $currency_rate
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereCurrencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereProfileId($value)
 * @mixin \Eloquent
 */
class CurrencyRate extends Model
{
    public $timestamps = false;
}
