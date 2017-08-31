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
    public $title;
    public $link;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post = null, $title = null, $message = null, $class = null, $link = null)
    {
        $this->post = $post;
        $this->message = $message;
        $this->class = $class;
        $this->title = $title;
        $this->link = $link;
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
            'title' => $this->title,
            'post_id' => $this->post->id,
            'message' => $this->message,
            'class' => $this->class,
            'link' => $this->link
        ];
    }

}
