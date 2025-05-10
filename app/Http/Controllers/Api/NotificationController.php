<?php

namespace App\Http\Controllers\Api;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;


class NotificationController extends Controller
{
    use   HttpResponse;
    public function __construct(public NotificationService $notificationService){}


    public function index()
    {
        $limit = request()->get('limit', 10);
        $data = $this->notificationService->index($limit);
        return $data;

    }
}
