<?php

namespace App\Http\Controllers\Api;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Services\CountryService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    use   HttpResponse;
    public function __construct(public CountryService $countryService){}


    public function index(Request $request)
    {
        $lang = $request->header('Accept-Language', 'en');
        $country = $this->countryService->index($lang);
        return $this->simpleResponse($country, CountryResource::class);

    }
}
