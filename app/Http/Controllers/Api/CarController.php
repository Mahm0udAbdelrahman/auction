<?php

namespace App\Http\Controllers\Api;

use App\Services\CarService;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Resources\CarResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarTypeResource;
use App\Http\Requests\Api\Car\CarRequest;
use App\Http\Requests\Api\Car\CarUpdateRequest;
use App\Exceptions\InsuranceNotFoundException;
use App\Models\BalanceInsurance;
use App\Models\Insurance;


class CarController extends Controller
{
    use   HttpResponse;
    public function __construct(public CarService $carService){}
    /**
     * Display a listing of the resource.
     */


     public function index()
     {
         $limit = request()->get('limit', 10);
         $cars = $this->carService->index($limit);
         return $this->paginatedResponse($cars, CarResource::class);
     }

    public function filter(Request $request){
        $filters = $request->all();
        $cars = $this->carService->filterCars($filters);
        return $this->paginatedResponse($cars, CarResource::class);

    }
    public function type()
    {
        $limit = request()->get('limit', 10);
        $type = $this->carService->type($limit);
        return $this->paginatedResponse($type, CarTypeResource::class);
    }


    public function getCarStatusPending()
    {
        $cars = $this->carService->getCarStatusPending();
        return $this->paginatedResponse($cars, CarResource::class);

    }

    public function getCarStatusApproved()
    {
        $cars = $this->carService->getCarStatusApproved();
        return $this->paginatedResponse($cars, CarResource::class);
    }

    public function getCarStatusRejected()
    {
        $cars = $this->carService->getCarStatusRejected();
        return $this->paginatedResponse($cars, CarResource::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request)
    {
        $newCar = $this->carService->store($request->validated());
        //  $user = auth()->user();
        // $minBalance = BalanceInsurance::where('service', $user->service)
        //     ->where('category', $user->category)
        //     ->value('min_balance');

        // if (is_null($minBalance)) {
        //     return $this->okResponse([], __('Min Balance Not Found', [], request()->header('Accept-language')));
        // }

        // $insurance = Insurance::where('user_id', $user->id)->first();

        // if (! $insurance) {
            
        //     return $this->okResponse([], __('No insurance found for the user.', [], request()->header('Accept-language')));

        // }

        // if ($insurance->balance < $minBalance) {
        //     return $this->okResponse([], __('You need to have an insurance balance of :minBalance or more to add a car.', [
        //         'minBalance' => $minBalance,
        //     ], request()->header('Accept-language')));
           
        // }

        // if ($insurance->payment_status !== 'paid') {
        //     return $this->okResponse([], __('Your insurance payment status must be paid to add a car.', [], request()->header('Accept-language')));
        // }
       return $this->okResponse(new CarResource($newCar), __('The car has been added successfully', [], request()->header('Accept-language')));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car =  $this->carService->show($id);
        return $this->okResponse(new CarResource($car), __('The car has been  successfully', [], request()->header('Accept-language')));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarUpdateRequest $request, string $id)
    {
        $car =   $this->carService->update($id, $request->validated());

        return $this->okResponse(new CarResource($car), __('The car has been updated successfully', [], request()->header('Accept-language')));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $car =  $this->carService->destroy($id);
        return $this->okResponse( message: __('The car has been deleted successfully', [], request()->header('Accept-language')));

    }
}
