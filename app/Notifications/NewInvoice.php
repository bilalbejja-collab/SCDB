<?php

namespace App\Notifications;

use App\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NewInvoice extends Notification
{
    use Queueable;
    private $invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Mandar la notificación a la base de datos y al email
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = 'http://app-scdb.herokuapp.com/invoices-details/' . $this->invoice->id;
        // en local
        // $url = 'http://127.0.0.1:8000/invoices-details/' . $this->invoice_id;

        return (new MailMessage)
            ->greeting('Hola!')
            ->subject('NUEVA FACTURA!')
            ->line('Se añadió nueva factura')
            ->action('Mostrar la factura', $url)
            ->line('Gracias por usar SCDB para administrar sus facturas');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->invoice->id,
            'title' => 'Se ha añadido nueva factura por: ',
            'user' => Auth::user()->name
        ];
    }
}
