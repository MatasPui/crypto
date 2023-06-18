<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Services\CryptoCurrencyService;

class ApiCoinMarketCapController extends Controller
{

    public function __construct(protected CryptoCurrencyService $cryptoCurrencyService)
    {}

    public function index()
    {
       return $this->cryptoCurrencyService->getCurencyListFromDb();
    }

    public function singleCurrency(CurrencyRequest $request)
    {
        return $this->cryptoCurrencyService->getCurencyListFromDbById($request->id);
    }

    public function updateCurrencyList()
    {
        return $this->cryptoCurrencyService->updateCurrencyList();
    }
}
