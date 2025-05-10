<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Country;
use App\Traits\HasImage;
use Illuminate\Http\Request;
use App\Helpers\HandleUpload;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\{User,ModelHasRole};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Hash,Session};
use App\Http\Requests\Dashboard\User\{StoreUserRequest,UpdateUserRequest,ProfileRequest};

class UserController extends Controller
{
    use HasImage;
    public function index(Request $request)
    {
               $users = User::whereNot('id',auth()->user()->id)->latest()->paginate(10);
        return view('admin.users.index',compact('users'));
    }

    public function getVendorA()
{
    $vendors = User::whereHas('auctions', function ($query) {
        $query->where('status', 'won');
    }, '>', 10)->paginate();

    return view('admin.users.getVendorA',compact('vendors'));

}


public function getVendorB()
{
    $vendors = User::whereHas('auctions', function ($query) {
        $query->where('status', 'won');
    }, '>=', 6)->whereHas('auctions', function ($query) {
        $query->where('status', 'won');
    }, '<=', 10)->paginate();

    return view('admin.users.getVendorB',compact('vendors'));

}



public function getVendorC()
{
    $vendors = User::whereHas('auctions', function ($query) {
        $query->where('status', 'won');
    }, '>=', 1)->whereHas('auctions', function ($query) {
        $query->where('status', 'won');
    }, '<=', 5)->paginate();

    return view('admin.users.getVendorC',compact('vendors'));


}

public function getBuyerA()
{


   $buyers = User::whereHas('wonAuctions', function ($query) {
        $query->where('status', 'won');
    }, '>', 10)->paginate();

    return view('admin.users.getBuyerA',compact('buyers'));
}

public function getBuyerB()
{
    $buyers =  User::whereHas('wonAuctions', function ($query) {
        $query->where('status', 'won');
    }, '>=', 6)->whereHas('wonAuctions', function ($query) {
        $query->where('status', 'won');
    }, '<=', 10)->paginate();

    return view('admin.users.getBuyerB',compact('buyers'));
}
public function getBuyerC()
{
    $buyers =  User::whereHas('wonAuctions', function ($query) {
        $query->where('status', 'won');
    }, '>=', 1)->whereHas('wonAuctions', function ($query) {
        $query->where('status', 'won');
    }, '<=', 5)->paginate();

    return view('admin.users.getBuyerC',compact('buyers'));
}



    public function create()
    {

        $roles = Role::select(['id','name'])->get();
        $countries = Country::all();
        return view('admin.users.create',compact('roles','countries'));
    }

    public function store(StoreUserRequest $storeUserRequest)
    {

        $data = $storeUserRequest->validated();
        $data['password'] = Hash::make($storeUserRequest->password);
        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'user');
        } else {
            $data['image'] =  asset('default/default.png');
        }

        $user = User::create($data);
        if(isset($data['role_id']))
        {
            DB::table('model_has_roles')->insert([
                'model_type' => 'App\\Models\\User',
                'model_id' => $user->id,
                'role_id' => $storeUserRequest->role_id
            ]);
        }


        Session::flash('message', ['type' => 'success', 'text' => __('User created successfully')]);
        return redirect()->route('Admin.users.index');
    }

    public function edit(User $user)
    {

        $roles = Role::select(['id','name'])->get();
        $countries = Country::all();
        return view('admin.users.edit',compact('user','roles','countries'));
    }

    public function update(UpdateUserRequest $updateUserRequest,User $user)
    {

        $data = $updateUserRequest->validated();
        $data['password'] = $updateUserRequest->password ? Hash::make($updateUserRequest->password) : $user->password;
        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'user');
        } else {
            $data['image'] =  asset('default/default.png');
        }
        $user->update($data);
        if (isset($data['role_id']) && !empty($data['role_id'])) {
            $criteria = ['model_id' => $user->id];
            $attributes = [
                'model_type' => 'App\\Models\\User',
                'model_id' => $user->id,
                'role_id' => $updateUserRequest->role_id
            ];
            DB::table('model_has_roles')->updateOrInsert($criteria, $attributes);
        } else {
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        }



        Session::flash('message', ['type' => 'success', 'text' => __('User updated successfully')]);
        return redirect()->route('Admin.users.index');
        // return back();
    }

    public function profile()
    {
        $user = User::where('id',auth()->user()->id)->first();
        $countries = Country::all();
        return view('admin.users.profile',compact('user','countries'));
    }

    public function updateProfile(ProfileRequest $profileRequest)
    {
        $user = User::where('id',auth()->user()->id)->first();

        $data = $profileRequest->validated();
        $data['password'] = $profileRequest->password ? Hash::make($profileRequest->password) : $user->password;
        $data['image'] = $profileRequest->hasFile(key: 'image') ? $this->saveImage($profileRequest->image , 'users/images') : $user->image;
        $user->update($data);

        Session::flash('message', ['type' => 'success', 'text' => __('User updated successfully')]);
        return redirect()->back();
    }
}
