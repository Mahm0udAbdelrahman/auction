<?php

namespace App\Http\Controllers\Api;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Services\QuestionService;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;

class QuestionController extends Controller
{
    use HttpResponse;

    public function __construct(public QuestionService $questionService){}

    public function index(Request $request)
    {
        $lang = $request->header('Accept-Language', 'en');
        $limit = request()->get('limit', 10);
        $questions = $this->questionService->index($lang,$limit);
        return $this->paginatedResponse($questions ,QuestionResource::class);

    }

    public function show(Request $request, $id)
    {
        $lang = $request->header('Accept-Language', 'en');
        $question = $this->questionService->show($id, $lang);
        return $this->okResponse(QuestionResource::make($question), __('Privacy Policy', [], Request()->header('Accept-language')));
    }
}
