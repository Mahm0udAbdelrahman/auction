<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FaqsController extends Controller
{
    public function __construct(public QuestionService $questionService)
    {}

    public function index(Request $request)
    {
        $lang = App::getLocale();
        $faqs = $this->questionService->index($lang);

        return view('web.pages.faqs', compact('faqs'));

    }
}
