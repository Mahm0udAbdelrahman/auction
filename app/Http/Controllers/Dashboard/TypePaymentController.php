<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\TypePayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TypePayment\TypePaymentRequest;
use App\Traits\HasImage;

class TypePaymentController extends Controller
{
    use HasImage;
  /**
     * Display a listing of the resource.
     */
    public function __construct(public TypePayment $model){}
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $data = $this->model->paginate();
            return view('admin.type_payment.index',compact('data'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('admin.type_payment.create');
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(TypePaymentRequest $request)
        {
           $data = $request->validated();
           if(isset($data['icon']))
           {
                $data['icon'] = $this->saveImage($data['icon'], 'type_payment');
           }
            $this->model->create($data);

            return redirect()->route('Admin.type_payment.index')->with('success','Created type_payment');

        }

        /**
         * Display the specified resource.
         */
        public function show(string $id)
        {
            $type_payment = $this->model->findOrFail($id);
            return view('admin.type_payment.show',compact('type_payment'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
            $type_payment = $this->model->findOrFail($id);
            return view('admin.type_payment.edit',compact('type_payment'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(TypePaymentRequest $request, string $id)
        {
            $type_payment = $this->model->findOrFail($id);
            $data = $request->validated();
            if($request->hasFile('icon'))
            {
                $this->deleteImage($type_payment->icon);
            }
            if(isset($data['icon']) && $data['icon'] != null)
            {
                $data['icon'] = $this->saveImage($data['icon'], 'type_payment');
            }
            $type_payment->update($data);

             return redirect()->route('Admin.type_payment.index')->with('success','Updated type_payment');

        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            $type_payment = $this->model->findOrFail($id);
            $type_payment->delete();
            return redirect()->route('Admin.type_payment.index')->with('success','Deleted type_payment');

        }
}
