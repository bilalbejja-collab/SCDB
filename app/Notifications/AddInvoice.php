<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddInvoice extends Notification
{
    use Queueable;
    private $invoice_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // hay que cambiar la url en producción
        $url = 'http://127.0.0.1:8000/invoices-details/' . $this->invoice_id;

        return (new MailMessage)
            ->greeting('Hola!')
            ->subject('NUEVA FACTURA!')
            ->line('Se añadió nueva factura')
            ->action('Mostrar la factura', $url)
            ->line('Gracias por usar SCDB para administrar sus facturas');
    }
}
