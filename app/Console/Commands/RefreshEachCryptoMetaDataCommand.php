<?php

namespace App\Console\Commands;

use App\Helpers\ApiHelper;
use Illuminate\Console\Command;
use App\Models\CryptoCurrency;
use Carbon\Carbon;

class RefreshEachCryptoMetaDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:cryptoMetaData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fetches data from CoinMarketCap cryptocurrency meta data and stores into database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $cryptoCurrencies = CryptoCurrency::get();
        // foreach ($cryptoCurrencies as $cryptoCurrency) {
        //     $currencyMeta = resolve(ApiHelper::class)->getCurrencyMeta($cryptoCurrency->coinmarketplace_id);
        //     foreach ($currencyMeta['data'] as $key => $data) {
        //         $cryptoCurrency->metaData()->updateOrCreate(
        //             ['id' => $cryptoCurrency->metaData->id],
        //             [
        //                 'logo' => $data['logo'],
        //                 'description' => $data['description'],
        //                 'date_added' => Carbon::parse($data['date_added']),
        //                 'date_launched' => Carbon::parse($data['date_launched']),
        //             ]
        //         );
        //     }
        // }
        
    }
}
