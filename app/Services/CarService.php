<?php
namespace App\Services;

use App\Models\Car;
use App\Models\User;
use App\Models\CarType;
use App\Models\Auction;
use App\Traits\HasImage;
use App\Models\Insurance;
use App\Traits\HttpResponse;
use App\Models\BalanceInsurance;
use App\Notifications\CarNotification;
use Illuminate\Support\Facades\Storage;
use App\Notifications\DashboardNotification;
use Illuminate\Support\Facades\Notification;
use App\Exceptions\InsuranceNotFoundException;

class CarService
{
    use HasImage, HttpResponse;

    public function __construct(public Car $car)
    {}

    public function index($limit = 10)
    {

        return $this->car->where('user_id', auth()->id())->latest()->paginate($limit);
    }
    public function filterCars(array $filters)
    {
        return $this->car
            ->whereHas('auction', function ($query) {
                $query->where('status', 'pending');
            })
            ->filter($filters)
            ->paginate(10);

    }

    public function type($limit = 10)
    {
        return CarType::paginate($limit);
    }

    public function getCarStatusPending()
    {
        return $this->car->where('user_id', auth()->id())->pending()->latest()->paginate();

    }

    public function getCarStatusApproved()
    {

        return $this->car->where('user_id', auth()->id())->approved()->latest()->paginate();

    }

    public function getCarStatusRejected()
    {
        return $this->car->where('user_id', auth()->id())->rejected()->latest()->paginate();

    }

    // public function store(array $data): Car
    // {
    //     $user = auth()->user();

    //     if (! $user || $user->service !== 'vendor') {
    //         throw new InsuranceNotFoundException(__('The user is not associated with a vendor account.', [], request()->header('Accept-language')));
    //     }
        
    //     if ($user->category == 'my') {
    //     $carCount = Car::where('user_id', $user->id)->where('status','pending')->count();

    //     if ($carCount >= 1) {
    //         throw new InsuranceNotFoundException(__('You are only allowed to create one car.', [], request()->header('Accept-language')));
            
    //     }
        
        

    // }

    //     // $minBalance = BalanceInsurance::where('service', $user->service)
    //     //     ->where('category', $user->category)
    //     //     ->value('min_balance');

    //     // if (is_null($minBalance)) {
    //     //     throw new InsuranceNotFoundException(__('Min Balance Not Found', [], request()->header('Accept-language')));
    //     // }

    //     // $insurance = Insurance::where('user_id', $user->id)->first();

    //     // if (! $insurance) {
    //     //     throw new InsuranceNotFoundException(__('No insurance found for the user.', [], request()->header('Accept-language')));

    //     // }

    //     // if ($insurance->balance < $minBalance) {
    //     //     throw new InsuranceNotFoundException(__('You need to have an insurance balance of :minBalance or more to add a car.', [
    //     //         'minBalance' => $minBalance,
    //     //     ], request()->header('Accept-language')));
    //     // }

    //     // if ($insurance->payment_status !== 'paid') {
    //     //     throw new InsuranceNotFoundException(__('Your insurance payment status must be paid to add a car.', [], request()->header('Accept-language')));
    //     // }

    //     $data['user_id']       = $user->id;
    //     // $data['image_license'] = $data['image_license'] ?? null ? $this->saveImage($data['image_license'], 'car/image_license') : null;
    //      $images = [];

    //     if (isset($data['image_license'])) {
    //         foreach ($data['image_license'] as $image) {
    //             $images[] = $this->saveImage($image, 'car/image_license'); // حفظ جميع الصور في المصفوفة
    //         }
    //     }

    //      $data['image_license'] = json_encode($images);
    //     $data['report']        = $data['report'] ?? null ? $this->saveImage($data['report'], 'car/report') : null;

    //     $newCar = $this->car->create($data);
       

    //     if (isset($data['images'])) {
    //         foreach ($data['images'] as $image) {
    //             $newCar->carImages()->create([
    //                 'image' => $this->saveImage($image, 'car/images'),
    //             ]);
    //         }
    //     }
    //     $insurance_user = Insurance::where('user_id', $newCar->user_id)
    //     ->where('payment_status', 'paid')
    //     ->first();

    // if ($insurance_user) {
    //     $newCar->update([
    //         'status' => 'approved',
    //     ]);

       
    //     $auction = Auction::firstOrCreate([
    //         'car_id' => $newCar->id,
    //         'user_id' => $newCar->user->id,
    //     ], [
    //         'start_date'   => now(),
    //         'end_date'     => now()->addWeeks(4),
    //         'start_price'  => $newCar->price,
    //     ]);
    // }
    
    
    //  $user = auth()->user();
    //     $minBalance = BalanceInsurance::where('service', $user->service)
    //         ->where('category', $user->category)
    //         ->value('min_balance');

    //     if (is_null($minBalance)) {
    //         return $this->okResponse([], __('Min Balance Not Found', [], request()->header('Accept-language')));
    //     }

    //     $insurance = Insurance::where('user_id', $user->id)->first();

    //     if (! $insurance) {
            
    //         return $this->okResponse([], __('No insurance found for the user.', [], request()->header('Accept-language')));

    //     }

    //     if ($insurance->balance < $minBalance) {
    //         return $this->okResponse([], __('You need to have an insurance balance of :minBalance or more to add a car.', [
    //             'minBalance' => $minBalance,
    //         ], request()->header('Accept-language')));
           
    //     }

    //     if ($insurance->payment_status !== 'paid') {
    //         return $this->okResponse([], __('Your insurance payment status must be paid to add a car.', [], request()->header('Accept-language')));
    //     }
    
    
    

    //     if($user->service == 'vendor' && $user->category=='my')
    //     {
    //         Insurance::where('user_id',$user->id)->delete();
    //     }
    //     $adminUsers = User::whereHas('roles', function ($query) {
    //         $query->where('name', 'admin');
    //     })->get();

    //     Notification::send(
    //         $adminUsers,
    //         new DashboardNotification($newCar->id, $data['name'], $data['price'],'car')
    //     );

    //     return $newCar->fresh();
    // }
    
    
  public function store(array $data): Car
{
    $user = auth()->user();

    if (! $user || $user->service !== 'vendor') {
        throw new InsuranceNotFoundException(__('The user is not associated with a vendor account.', [], request()->header('Accept-language')));
    }

   
    if ($user->category == 'my') {
        $carCount = Car::where('user_id', $user->id)->where('status','pending')->count();
        if ($carCount >= 1) {
            throw new InsuranceNotFoundException(__('You are only allowed to create one car.', [], request()->header('Accept-language')));
        }
    }


    $insurance = Insurance::where('user_id', $user->id)->where('payment_status','paid')->first();

   

    $data['user_id'] = $user->id;

    $images = [];
    if (isset($data['image_license'])) {
        foreach ($data['image_license'] as $image) {
            $images[] = $this->saveImage($image, 'car/image_license');
        }
    }
    $data['image_license'] = json_encode($images);

    $data['report'] = $data['report'] ?? null ? $this->saveImage($data['report'], 'car/report') : null;

    $newCar = $this->car->create($data);


    if (isset($data['images'])) {
        foreach ($data['images'] as $image) {
            $newCar->carImages()->create([
                'image' => $this->saveImage($image, 'car/images'),
            ]);
        }
    }
    
    if (!$insurance) {
   throw new InsuranceNotFoundException(__('Insurance Required To Auction', [], request()->header('Accept-language')));

        
    }
    

  if($insurance)
  {
        $newCar->update(['status' => 'approved']);
    Auction::firstOrCreate([
        'car_id' => $newCar->id,
        'user_id' => $newCar->user->id,
    ], [
        'start_date' => now(),
        'end_date' => now()->addWeeks(4),
        'start_price' => $newCar->price,
    ]);
  }

    
    if ($user->service === 'vendor' && $user->category === 'my' && $insurance) {
    $insurance->delete();
}

    
    $adminUsers = User::whereHas('roles', function ($query) {
        $query->where('name', 'admin');
    })->get();

    Notification::send(
        $adminUsers,
        new DashboardNotification($newCar->id, $data['name'], $data['price'], 'car')
    );

    return $newCar->fresh();
}
    public function show($id)
    {
        return $this->car->findOrFail($id);
    }

    public function update($id, array $data): Car
    {
        $user = auth()->user();

        if (! $user || $user->service !== 'vendor') {
            throw new InsuranceNotFoundException(__('The user is not associated with a vendor account.', [], request()->header('Accept-language')));
        }

        $minBalance = BalanceInsurance::where('service', $user->service)
            ->where('category', $user->category)
            ->value('min_balance');

        if (is_null($minBalance)) {
            throw new InsuranceNotFoundException(__('Min Balance Not Found', [], request()->header('Accept-language')));
        }

        $insurance = Insurance::where('user_id', $user->id)->first();

        if (! $insurance) {
            throw new InsuranceNotFoundException(__('No insurance found for the user.', [], request()->header('Accept-language')));
        }

        if ($insurance->balance < $minBalance) {
            throw new InsuranceNotFoundException(__('You need to have an insurance balance of :minBalance or more to update the car.', [
                'minBalance' => $minBalance,
            ], request()->header('Accept-language')));
        }

        if ($insurance->payment_status !== 'paid') {
            throw new InsuranceNotFoundException(__('Your insurance payment status must be paid to update the car.', [], request()->header('Accept-language')));
        }

        $car = $this->car->findOrFail($id);

        if ($car->user_id !== $user->id) {
            throw new InsuranceNotFoundException(__('Car not found or you do not have permission to update it.', [], request()->header('Accept-language')));
        }

        $data['user_id'] = $user->id;

        foreach (['image_license', 'report'] as $field) {
            if (isset($data[$field])) {
                $this->deleteOldImage($car->$field);
                $data[$field] = $this->saveImage($data[$field], "car/$field");
            }
        }

        $car->update($data);

        if (! empty($data['images']) && is_array($data['images'])) {
            $car->carImages()->each(fn($image) => $this->deleteOldImage($image->image) && $image->delete());

            foreach ($data['images'] as $image) {
                $car->carImages()->create([
                    'image' => $this->saveImage($image, 'car/images'),
                ]);
            }
        }

        return $car;
    }

    private function deleteOldImage($path)
    {
        if ($path && Storage::exists($path)) {
            Storage::delete($path);
        }
    }

    public function destroy($id)
    {
        $car = $this->car->findOrFail($id);
        $car->delete();
        return $car;
    }

}
