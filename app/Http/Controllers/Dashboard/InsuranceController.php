<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Insurance\InsuranceRequest;

class InsuranceController extends Controller
{
    public function __construct(public Insurance $model){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->model->paginate();
        return view('admin.insurances.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.insurances.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsuranceRequest $request)
    {

        $this->model->create($request->validated());

        return redirect()->route('Admin.insurances.index')->with('success','Created insurance');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $insurance = $this->model->findOrFail($id);
        return view('admin.insurances.show',compact('insurance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $insurance = $this->model->findOrFail($id);
        $users = User::all();
        return view('admin.insurances.edit',compact('insurance','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InsuranceRequest $request, string $id)
    {
        $insurance = $this->model->findOrFail($id);

        $insurance->update($request->validated());

         return redirect()->route('Admin.insurances.index')->with('success','Updated insurance');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $insurance = $this->model->findOrFail($id);
        $insurance->delete();
        return redirect()->route('Admin.insurances.index')->with('success','Deleted insurance');

    }
}
