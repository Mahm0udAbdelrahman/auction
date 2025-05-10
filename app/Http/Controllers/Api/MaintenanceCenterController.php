<?php

namespace App\Http\Controllers\Api;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MaintenanceCenterService;
use App\Http\Resources\MaintenanceCenterResource;

class MaintenanceCenterController extends Controller
{
    use HttpResponse;

    public function __construct(public MaintenanceCenterService $maintenanceCenterService){}

    public function index(Request $request)
    {
        $lang = $request->header('Accept-Language', 'en');
        $limit = request()->get('limit', 10);
        $questions = $this->maintenanceCenterService->index($lang,$limit);
        return $this->paginatedResponse($questions ,MaintenanceCenterResource::class);

    }

    public function show(Request $request, $id)
    {
        $lang = $request->header('Accept-Language', 'en');
        $question = $this->maintenanceCenterService->show($id, $lang);
        return $this->okResponse(MaintenanceCenterResource::make($question), __('Maintenance Center', [], Request()->header('Accept-language')));
    }
}
