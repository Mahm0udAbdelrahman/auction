<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\CarType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CarType\CarTypeRequest;

class CarTypeController extends Controller
{
    public function __construct(public CarType $model){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->model->paginate();
        return view('admin.car_types.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.car_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarTypeRequest $request)
    {

        $this->model->create($request->validated());

        return redirect()->route('Admin.car_types.index')->with('success','Created car_type');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car_type = $this->model->findOrFail($id);
        return view('admin.car_types.show',compact('car_type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car_type = $this->model->findOrFail($id);
        return view('admin.car_types.edit',compact('car_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarTypeRequest $request, string $id)
    {
        $car_type = $this->model->findOrFail($id);

        $car_type->update($request->validated());

         return redirect()->route('Admin.car_types.index')->with('success','Updated car_type');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car_type = $this->model->findOrFail($id);
        $car_type->delete();
        return redirect()->route('Admin.car_types.index')->with('success','Deleted car_type');

    }
}
