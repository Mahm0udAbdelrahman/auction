<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Country;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Setting\SettingRequest;

class SettingController extends Controller
{
    public function show()
    {

        $setting = Setting::first();
        $countries = Country::all();
        return view("admin.setting.edit", compact("setting", "countries"));
      }
      public function update(SettingRequest $request)
      {
          $data = $request->validated();

          $PrivacyPolicy = Setting::first();

          if ($PrivacyPolicy) {
              $PrivacyPolicy->update($data);
          } else {
            Setting::create($data);
          }

          return redirect()->back()->with('success', 'Setting updated successfully!');

 }
}
