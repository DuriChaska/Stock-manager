<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StockBajoNotification extends Notification
{
    use Queueable;

    /**
     * The producto instance.
     *
     * @var mixed
     */
    protected $producto;

    /**
     * Create a new notification instance.
     */
    public function __construct($producto)
    {
        $this->producto = $producto;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "El producto '{$this->producto->nombre}' tiene stock bajo ({$this->producto->existencia} unidades).",
            'producto_id' => $this->producto->id
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

}
