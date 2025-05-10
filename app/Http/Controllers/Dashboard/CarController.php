<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Car;
use App\Models\User;
use App\Models\Auction;
use App\Models\CarType;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\SendNotificationHelper;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DBFireBaseNotification;
use App\Http\Requests\Dashboard\Car\CarRequest;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct(public Car $model){}
    public function index()
    {
        $data = $this->model->pending()->paginate(10);
        return view('admin.cars.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carTypes = CarType::all();
        return view('admin.cars.create',compact('carTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('image_license')) {
            $validated['image_license'] = $request->file('image_license')->store('car_licenses', 'public');
        }

        if ($request->hasFile('report')) {
            $validated['report'] = $request->file('report')->store('car_reports', 'public');
        }

        $car = Car::create($validated);

        if ($request->hasFile('car_images')) {
            foreach ($request->file('car_images') as $image) {
                $car->carImages()->create([
                    'image' => $image->store('car_images', 'public'),
                ]);
            }
        }
        return redirect()->route('Admin.cars.index')->with('success','Created Car');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $car = $this->model->findOrFail($id);
      return view('admin.cars.show',compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = $this->model->findOrFail($id);
        $types = CarType::all();
        $countries = Country::all();
        return view('admin.cars.edit',compact('countries','car','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, string $id)
    {


        $car = $this->model->findOrFail($id);
        $data = $request->validated();
        if (isset($data['status']) && $data['status'] === 'approved') {
          $auction =  Auction::firstOrCreate([
                'car_id' => $car->id,
                'user_id' => $car->user->id,
            ], [
                'start_date'=> now(),
               'end_date' => now()->addWeeks(4),
                'start_price' => $car->price,
            ]);
        }
        $car->update($data);

        $data =
        [
            "title_ar" => "تمت الموافقة على سيارتك $car->name وتم طرحها في المزاد",
            "body_ar"  => "مرحباً، تمت الموافقة على سيارتك بنجاح، وهي متاحة الآن في المزاد للمزايدة. نتمنى لك حظًا سعيدًا في بيعها!",
            "title_en" => "Your Car $car->name Has Been Approved and Listed for Auction",
            "body_en"  => "Hello, your car has been successfully approved and is now available in the auction for bidding. We wish you the best of luck in selling it!",
            "title_ru" => "Ваш автомобиль $car->name одобрен и выставлен на аукцион",
            "body_ru"  => "Здравствуйте, ваш автомобиль был успешно одобрен и теперь доступен на аукционе для ставок. Желаем вам удачи в продаже!",
            'image'    => null,
        ];


        $newNotification = new SendNotificationHelper();
        $user = User::findOrFail($car->user->id);
        Notification::send(
            $user,
            new DBFireBaseNotification($data['title_ar'], $data['body_ar'], $data['title_en'], $data['body_en'], $data['title_ru'], $data['body_ru'],$auction->id,$car->name,$car->price,'car')
        );
        $newNotification->sendNotification($data , [$user->fcm_token]);



         return redirect()->route('Admin.cars.index')->with('success','Updated car');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = $this->model->findOrFail($id);
        $car->delete();
        return redirect()->route('Admin.cars.index')->with('success','Deleted car');

    }
}
