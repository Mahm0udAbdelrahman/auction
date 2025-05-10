<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Traits\HasImage;
use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Models\WithdrawMoney;
use App\Http\Controllers\Controller;
use App\Helpers\SendNotificationHelper;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DBFireBaseNotification;
use App\Http\Requests\Dashboard\WithdrawMoney\WithdrawMoneyRequest;

class WithdrawMoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HasImage;
    public function __construct(public WithdrawMoney $model){}
    public function index()
    {
        $data = $this->model->paginate();
        return view('admin.withdraw_money.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $withdraw_money = $this->model->findOrFail($id);
      return view('admin.withdraw_money.show',compact('withdraw_money'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $withdraw_money = $this->model->findOrFail($id);

        return view('admin.withdraw_money.edit',compact('withdraw_money'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WithdrawMoneyRequest $request, string $id)
    {
        $withdraw_money = $this->model->findOrFail($id);
        $data = $request->validated();
        if($data['status'] == 'approved')
        {
          $insurance = Insurance::where('user_id', $withdraw_money->user_id)
            ->where('payment_status', 'paid')
            ->first();

        if ($insurance && $insurance->balance >= $withdraw_money->money) {
            $insurance->balance -= $withdraw_money->money;
            $insurance->save();
        }
        }
        if(isset($data['image']))
        {
            $data['image'] = $request->hasFile( 'image') ? $this->saveImage($request->image , 'withdraw_money/images') : 'no image';

        }
        $withdraw_money->update($data);
        $data = [
            "title_ar" => " تمت الموافقة على طلب السحب $withdraw_money->money",
            "body_ar"  => "مرحباً، تمت الموافقة على طلب سحب رصيدك!",
            "title_en" => "Withdrawal Request Approved $withdraw_money->money",
            "body_en"  => "Hello, your withdrawal request has been approved",
            "title_ru" => "Запрос на вывод средств одобрен $withdraw_money->money",
            "body_ru"  => "Здравствуйте, ваш запрос на вывод средств был одобрен",
            'image'    => null,
        ];

        $newNotification = new SendNotificationHelper();
        $user = User::findOrFail($withdraw_money->user->id);
        Notification::send(
            $user,
            new DBFireBaseNotification($data['title_ar'], $data['body_ar'], $data['title_en'], $data['body_en'], $data['title_ru'], $data['body_ru'],null,null,$withdraw_money->money,null)
        );
        $newNotification->sendNotification($data , [$user->fcm_token]);

        return redirect()->route('Admin.withdraw_money.index');





    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = $this->model->findOrFail($id);
        $car->delete();
        return redirect()->route('Admin.withdraw_money.index')->with('success','Deleted car');

    }
}
