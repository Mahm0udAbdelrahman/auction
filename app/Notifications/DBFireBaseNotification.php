<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DBFireBaseNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $title_ar;
    public $title_en;
    public $body_ar;
    public $body_en;
    public $title_ru;
    public $body_ru;

    public $auction_id;
    public $price;
    public $name;
    public $type;


    public function __construct($title_ar=null,$body_ar=null,$title_en=null,$body_en=null,$body_ru=null,$title_ru=null,$auction_id=null,$name=null,$price=null,$type=null)
    {
        $this->title_ar = $title_ar;
        $this->title_en = $title_en;
        $this->body_ar = $body_ar;
        $this->body_en = $body_en;
        $this->title_ru = $title_ru;
        $this->body_ru = $body_ru;
        $this->auction_id = $auction_id;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;


    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'body_ar' => $this->body_ar,
            'body_en' => $this->body_en,
            'title_ru' => $this->title_ru,
            'body_ru' => $this->body_ru,
            'auction_id' => $this->auction_id,
            'name' => $this->name,
            'price' => $this->price,
            'url' => $this->type === 'car' ? route('web.aution_details', $this->auction_id) : null, 


        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
