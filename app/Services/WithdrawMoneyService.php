<?php
namespace App\Services;

use App\Models\User;
use App\Models\Insurance;
use App\Models\WithdrawMoney;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DashboardNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DBFireBaseNotification;



class WithdrawMoneyService
{
    public function __construct(public WithdrawMoney $model){}
    public function index($limit = 10)
    {
        return $this->model->where('user_id', auth()->id())->latest()->paginate($limit);
    }
    public function store($user, $data)
    {

        $WithdrawMoney  = WithdrawMoney::create([
            'user_id' => $user->id,
            'phone' => $data['phone'],
            'money' => $data['money'],
        ]);
        $adminUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        Notification::send(
            $adminUsers,
            new DashboardNotification($WithdrawMoney->id, '', $WithdrawMoney->money, 'withdraw')
        );

        return $WithdrawMoney->fresh();
    }

    public function show($id)
    {
        return $this->model->where('user_id', auth()->id())->findOrFail($id);
    }

}
