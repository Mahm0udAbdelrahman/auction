<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Car;
use App\Models\User;
use App\Models\Order;
use App\Models\Auction;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\ModelHasRole;
use Illuminate\Http\Request;
use App\Models\MaintenanceCenter;
use App\Models\TransationHestory;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\DropshippingProduct;
use App\Models\ShippingGovernorate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::count();
        $vendor = User::where('service', 'vendor')->count();
        $buyer = User::where('service', 'buyer')->count();
        $car = Car::count();
        $auction = Auction::count();
        $car_won = Auction::where('status','won')->count();
        $car_pending = Auction::where('status','pending')->count();
        $maintenance_center =MaintenanceCenter::count();
        $country = Country::count();

        return view('admin.index', compact('user','vendor', 'buyer', 'car','auction' ,'maintenance_center','car_won','car_pending','country'));
    }

    public function confirmDelete($model, $id)
    {
        $data = app('App\\Models\\' . ucfirst($model))->find($id);
        if ($model == 'role') {
            $data->revokePermissionTo($data->permissions);
        }

        if ($model == 'user') {
            DB::table('model_has_roles')->where('model_id', $id)->delete();

        }

        $data->delete();
        Session::flash('message', ['type' => 'success', 'text' => __('Deleted successfully')]);
        return redirect()->back();
    }

    
}
