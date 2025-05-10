<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class NotificationService
{



public function index($limit = 10)
{
    $user = Auth::user();
    $notifications = $user->notifications()->latest()->paginate($limit);
    $lang = request()->header('Accept-Language', 'ar');

    $notes = $notifications->map(function ($note) use ($lang) {
        $data = $note->data;

        $titleKey = 'title_' . $lang;
        $bodyKey = 'body_' . $lang;

        $data['title'] = $data[$titleKey] ?? '';
        $data['body'] = $data[$bodyKey] ?? '';

        unset($data['title_ar'], $data['body_ar'], $data['title_en'], $data['body_en'], $data['title_ru'], $data['body_ru']);

        $note->data = $data;
        return $note;
    });

    return [
        'notifications' => $notes,
    ];
}


}
