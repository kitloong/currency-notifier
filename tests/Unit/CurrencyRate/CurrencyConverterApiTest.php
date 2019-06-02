<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2019-06-02
 * Time: 18:02
 */

namespace Tests\Unit\CurrencyRate;

use App\CurrencyRate\CurrencyConverterApi;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Mockery;
use Psr\Http\Message\ResponseInterface;
use Tests\TestCase;

/**
 * Class CurrencyConverterApiTest
 * @package Tests\Unit\CurrencyRate
 */
class CurrencyConverterApiTest extends TestCase
{
    /**
     * @var CurrencyConverterApi
     */
    private $api;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->api = $this->app->make(CurrencyConverterApi::class);
    }

    /**
     * @throws Exception
     */
    public function testGetRate()
    {
        $mock = new MockHandler([
            new Response(200, [], '{"CNY_USD":0.14482,"USD_MYR":4.190504}')
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $this->app->instance(Client::class, $client);
        $rate = $this->api->getRate(1);
        $this->assertSame(0.60686878928, $rate);
    }

    /**
     * @throws Exception
     */
    public function testGetRateMethodArguments()
    {
        $mockClient = Mockery::mock(Client::class);
        $mockResponse = Mockery::mock(ResponseInterface::class);
        $mockResponse->shouldReceive('getStatusCode')
            ->once()
            ->andReturn(\Illuminate\Http\Response::HTTP_OK);
        $mockResponse->shouldReceive('getBody->getContents')
            ->once()
            ->andReturn('{"CNY_USD":0.14482,"USD_MYR":4.190504}');
        $mockClient->shouldReceive('get')
            ->withAnyArgs()
            ->with(
                'https://free.currconv.com/api/v7/convert',
                [RequestOptions::QUERY => [
                    'compact' => 'ultra',
                    'apiKey' => config('currencyrate.api.currency_converter_api.key'),
                    'q' => 'CNY_USD,USD_MYR',
                ]]
            )
            ->once()
            ->andReturn($mockResponse);
        $this->app->instance(Client::class, $mockClient);
        $this->api->getRate(1);
    }

    /**
     * @throws Exception
     */
    public function testGetRateResponseStatusIsNotOk()
    {
        $this->expectExceptionObject(new Exception('Failed to get currency rate.'));
        $mock = new MockHandler([
            new Response(202, [], '{"CNY_USD":0.14482,"USD_MYR":4.190504}')
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $this->app->instance(Client::class, $client);
        $rate = $this->api->getRate(1);
        $this->assertSame(0.60686878928, $rate);
    }
}
