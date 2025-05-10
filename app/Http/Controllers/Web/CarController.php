<?php

namespace App\Http\Controllers\Web;

use App\Models\CarType;
use App\Models\Country;
use App\Services\CarService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Car\CarRequest;

class CarController extends Controller
{
    public function __construct(public CarService $carService){}
    public function index()
    {
        $countries = Country::all();
        $types = CarType::all();
        return view('web.pages.car' ,compact('countries','types'));
    }

    public function store(CarRequest $request)
    {
        $newCar = $this->carService->store($request->all());

        return redirect()->route('web.my_autions');


    }
}
