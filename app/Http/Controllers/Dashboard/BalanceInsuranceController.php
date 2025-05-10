<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\BalanceInsurance;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BalanceInsurance\BalanceInsuranceRequest;
use App\Models\Country;

class BalanceInsuranceController extends Controller
{
    public function __construct(public BalanceInsurance $model){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->model->paginate();
        return view('admin.balance_insurance.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $countries = Country::all();
        return view('admin.balance_insurance.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BalanceInsuranceRequest $request)
    {

        $this->model->create($request->validated());
        return redirect()->route('Admin.balance_insurances.index')->with('success','Created balance_insurance');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $balance_insurance = $this->model->findOrFail($id);
        return view('admin.balance_insurance.show',compact('balance_insurance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $balance_insurance = $this->model->findOrFail($id);
        $countries = Country::all();
        return view('admin.balance_insurance.edit',compact('balance_insurance','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BalanceInsuranceRequest $request, string $id)
    {
        $balance_insurance = $this->model->findOrFail($id);
        $balance_insurance->update($request->validated());
        return redirect()->route('Admin.balance_insurances.index')->with('success','Updated balance_insurance');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $balance_insurance = $this->model->findOrFail($id);
        $balance_insurance->delete();
        return redirect()->route('Admin.balance_insurances.index')->with('success','Deleted balance_insurance');

    }
}
