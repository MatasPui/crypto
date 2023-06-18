<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoCurrency extends Model
{
    use HasFactory;

    protected $fillable = [
        'coinmarketplace_id',
        'name'
    ];

    public function metaData()
    {
        return $this->hasOne(CryptoCurrencyMetaData::class);
    }

}
