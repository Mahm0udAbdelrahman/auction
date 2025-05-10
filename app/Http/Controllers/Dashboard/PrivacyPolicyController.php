<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PrivacyPolicy\PrivacyPolicyRequest;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(public PrivacyPolicy $model) {}

    public function index()
    {
        $data = $this->model->paginate();
        return view("admin.privacy_policy.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.privacy_policy.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrivacyPolicyRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('Admin.privacy_policy.index')->with('success', 'Created Privacy Policy');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $privacy_policy = $this->model->findOrFail($id);
        return view('admin.privacy_policy.show', compact('privacy_policy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $privacy_policy = $this->model->findOrFail($id);
        $countries = Country::all();
        return view('admin.privacy_policy.edit', compact('privacy_policy', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrivacyPolicyRequest $request, string $id)
    {
        $privacy_policy = $this->model->findOrFail($id);
        $privacy_policy->update($request->validated());
        return redirect()->route('Admin.privacy_policy.index')->with('success', 'Updated Privacy Policy');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $privacy_policy = $this->model->findOrFail($id);
        $privacy_policy->delete();
        return redirect()->route('Admin.privacy_policy.index')->with('success', 'Deleted Privacy Policy');
    }



    // public function show()
    // {

    //     $privacy_policy = PrivacyPolicy::first();
    //     return view("admin.privacy_policy.index", compact("privacy_policy"));
    // }
    // public function update(PrivacyPolicyRequest $request)
    // {
    //     $data = $request->validated();

    //     $PrivacyPolicy = PrivacyPolicy::first();

    //     if ($PrivacyPolicy) {
    //         $PrivacyPolicy->update($data);
    //     } else {
    //         PrivacyPolicy::create($data);
    //     }

    //     return redirect()->back()->with('success', 'Privacy Policy updated successfully!');
    // }
}
