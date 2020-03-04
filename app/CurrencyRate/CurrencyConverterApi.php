<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2019-06-02
 * Time: 17:44
 */

namespace App\CurrencyRate;

use App\CurrencyRate\Interfaces\CurrencyApi;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Response;

/**
 * Class CurrencyCoverterApi
 * @package App\CurrencyRate
 */
final class CurrencyConverterApi implements CurrencyApi
{
    /**
     * @var array
     */
    private $baseParam;

    private const API_URL = 'https://free.currconv.com/api/v7/';

    private const COMPACT_MODE = 'ultra';

    public function __construct()
    {
        $this->baseParam = [
            'compact' => self::COMPACT_MODE,
            'apiKey' => config('currencyrate.api.currency_converter_api.key')
        ];
    }

    /**
     * @param CurrencyProfile $profile
     * @return float
     * @throws Exception
     */
    public function getRate(CurrencyProfile $profile): float
    {
        $params = [];
        foreach ($profile->currencies as $from => $to) {
            $params[] = $from . '_' . $to;
        }
        $result = $this->convert($params);
        $resultJson = \GuzzleHttp\json_decode($result);

        $rate = 1; // base number
        foreach ($resultJson as $curRate) {
            $rate *= floatval($curRate);
        }

        return $rate;
    }

    /**
     * Call currency convert API.
     * GET https://free.currconv.com/api/v7/convert?apiKey=API_KEY&q=USD_CNY,CNY_MYR&compact=ultra
     * @param array $queryCurrencies
     * @return string {"CNY_USD":0.14482,"USD_MYR":4.190504}
     * @throws Exception
     */
    private function convert(array $queryCurrencies): string
    {
        $client = resolve(Client::class);
        $response = $client->get(self::API_URL . 'convert', [
            RequestOptions::QUERY => $this->buildParam([
                'q' => implode(',', $queryCurrencies)
            ])
        ]);
        if ($response->getStatusCode() == Response::HTTP_OK) {
            return $response->getBody()->getContents();
        }
        throw new Exception('Failed to get currency rate.');
    }

    /**
     * Build parameter with default base parameter.
     * @param array $params
     * @return array Merged parameter
     */
    private function buildParam(array $params): array
    {
        return array_merge($this->baseParam, $params);
    }
}
