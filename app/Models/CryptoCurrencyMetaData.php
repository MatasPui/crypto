<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoCurrencyMetaData extends Model
{
    use HasFactory;

    protected $table = 'crypto_currencies_meta_data';

    protected $fillable = [
        'crypto_currency_id',
        'symbol', 
        'slug', 
        'cmc_rank', 
        'circulating_supply', 
        'total_supply',
        'logo',
        'description',
        'date_added',
        'date_launched' 
    ];

    public function cryptoCurrency()
    {
        return $this->belongsTo(CryptoCurrency::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
