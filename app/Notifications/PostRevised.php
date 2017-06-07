<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostRevised extends Notification
{
    use Queueable;

    public $post;
    public $message;
    public $type;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post, $message, $type)
    {
        $this->post = $post;
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Manda notificação.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toArray ($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'message' => $this->message,
            'type' => $this->type
        ];
    }

}
