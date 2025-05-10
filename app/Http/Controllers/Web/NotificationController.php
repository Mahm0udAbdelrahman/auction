<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;

class NotificationController extends Controller
{
    public function __construct(public NotificationService $notificationService){}


    public function index()
    {
        // $limit = request()->get('limit', 10);
        // $notifications = $this->notificationService->index($limit);
        // dd($notifications);
        return view('web.pages.notification');

    }
}
