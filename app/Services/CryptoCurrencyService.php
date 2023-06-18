<?php

namespace App\Services;

use App\Helpers\ApiHelper;
use App\Models\CryptoCurrency;
use App\Models\CryptoCurrencyMetaData;
use Illuminate\Http\JsonResponse;

class CryptoCurrencyService
{
    public function getCurencyListFromDb(): JsonResponse
    {
        $cryptoCurrencies = CryptoCurrency::with('metaData')->paginate(config('data.currencies_per_page'));
        return response()->json($cryptoCurrencies);
    }

    public function getCurencyListFromDbById(int $id): JsonResponse
    {
        $cryptoCurrencyData = CryptoCurrency::where('coinmarketplace_id', $id)->with('metaData')->first();
        return response()->json($cryptoCurrencyData);
    }

    public function updateCurrencyList()
    {
        $data = resolve(ApiHelper::class)->getCurencyList();
        CryptoCurrencyMetaData::query()->delete();
        CryptoCurrency::query()->delete();
        $localCrypto = '';
        foreach($data as $key => $cryptoArray){
            if($key == 'data'){
                foreach($cryptoArray as $index => $crypto){
                    $localCrypto = CryptoCurrency::create([
                        'coinmarketplace_id' => $crypto['id'],
                        'name' => $crypto['name']
                    ]);
                    CryptoCurrencyMetaData::create([
                        'crypto_currency_id' => $localCrypto->id,
                        'symbol' => $crypto['symbol'], 
                        'slug' => $crypto['slug'], 
                        'cmc_rank' => $crypto['cmc_rank'], 
                        'circulating_supply' => $crypto['circulating_supply'], 
                        'total_supply' => $crypto['total_supply']
                    ]);
                }
            }
        }
        return response()->json($localCrypto);
    }
}
