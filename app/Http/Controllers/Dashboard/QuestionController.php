<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Question\QuestionRequest;

class QuestionController extends Controller
{

    public function __construct(public Question $model){}
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $data = $this->model->paginate();
            return view('admin.questions.index',compact('data'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('admin.questions.create');
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(QuestionRequest $request)
        {

            $this->model->create($request->validated());

            return redirect()->route('Admin.questions.index')->with('success','Created question');

        }

        /**
         * Display the specified resource.
         */
        public function show(string $id)
        {
            $question = $this->model->findOrFail($id);
            return view('admin.questions.show',compact('question'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
            $question = $this->model->findOrFail($id);
            return view('admin.questions.edit',compact('question'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(QuestionRequest $request, string $id)
        {
            $question = $this->model->findOrFail($id);

            $question->update($request->validated());

             return redirect()->route('Admin.questions.index')->with('success','Updated question');

        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            $question = $this->model->findOrFail($id);
            $question->delete();
            return redirect()->route('Admin.questions.index')->with('success','Deleted question');

        }
}
