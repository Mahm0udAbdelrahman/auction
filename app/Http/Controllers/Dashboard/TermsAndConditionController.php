<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\TermsAndCondition;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ReturnPolicy\ReturnPolicyRequest;

class TermsAndConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(public TermsAndCondition $model) {}

    public function index()
    {
        $data = $this->model->paginate();
        return view("admin.terms_condition.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.terms_condition.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReturnPolicyRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('Admin.terms_condition.index')->with('success', 'Created Privacy Policy');
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
        $terms_condition = $this->model->findOrFail($id);
        $countries = Country::all();
        return view('admin.terms_condition.edit', compact('terms_condition', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReturnPolicyRequest $request, string $id)
    {
        $terms_condition = $this->model->findOrFail($id);
        $terms_condition->update($request->validated());
        return redirect()->route('Admin.terms_condition.index')->with('success', 'Updated Privacy Policy');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $terms_condition = $this->model->findOrFail($id);
        $terms_condition->delete();
        return redirect()->route('Admin.terms_condition.index')->with('success', 'Deleted Privacy Policy');
    }
}
