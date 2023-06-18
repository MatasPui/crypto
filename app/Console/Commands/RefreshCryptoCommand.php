<?php

namespace App\Console\Commands;

use App\Helpers\ApiHelper;
use Illuminate\Console\Command;
use App\Models\CryptoCurrency;
use App\Models\CryptoCurrencyMetaData;

class RefreshCryptoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:crypto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fetches data from CoinMarketCap latest crypto and replace existing one with newest';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = resolve(ApiHelper::class)->getCurencyList();
        CryptoCurrencyMetaData::query()->delete();
        CryptoCurrency::query()->delete();
        foreach ($data['data'] ?? [] as $crypto) {
            $localCrypto = CryptoCurrency::create([
                'coinmarketplace_id' => data_get($crypto, 'id'),
                'name' => data_get($crypto, 'name')
            ]);
        
            CryptoCurrencyMetaData::create([
                'crypto_currency_id' => $localCrypto->id,
                'symbol' => data_get($crypto, 'symbol'),
                'slug' => data_get($crypto, 'slug'),
                'cmc_rank' => data_get($crypto, 'cmc_rank'),
                'circulating_supply' => data_get($crypto, 'circulating_supply'),
                'total_supply' => data_get($crypto, 'total_supply')
            ]);
        }
    }
}
