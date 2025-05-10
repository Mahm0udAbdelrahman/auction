<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\ReturnPolicye;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ReturnPolicy\ReturnPolicyRequest;

class ReturnPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(public ReturnPolicye $model) {}

    public function index()
    {
        $data = $this->model->paginate();
        return view("admin.return_policy.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.return_policy.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReturnPolicyRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('Admin.return_policy.index')->with('success', 'Created Privacy Policy');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $return_policy = $this->model->findOrFail($id);
        $countries = Country::all();
        return view('admin.return_policy.edit', compact('return_policy', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReturnPolicyRequest $request, string $id)
    {
        $return_policy = $this->model->findOrFail($id);
        $return_policy->update($request->validated());
        return redirect()->route('Admin.return_policy.index')->with('success', 'Updated Privacy Policy');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $return_policy = $this->model->findOrFail($id);
        $return_policy->delete();
        return redirect()->route('Admin.return_policy.index')->with('success', 'Deleted Privacy Policy');
    }
}
