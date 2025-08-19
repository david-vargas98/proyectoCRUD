<?php

namespace App\Mail;

use App\Models\ClienteUser; //Se incluye el modelo del cuál se necesita una instancia
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificaClienteUser extends Mailable
{
    use Queueable, SerializesModels;

    //

    /**
     * Create a new message instance.
     */
    //El usar 'public ClienteUser $asociacion' permite que la propiedad $asociacion esté disponible dentro de la instancia de la clase.
    public function __construct(public ClienteUser $asociacion) //Todos los atributos o variables declarados aquí, estarán disponibles en automática en la vista
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificación de asociación',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.asociacionNotifica',  //Para usar los pre-built email UI components
            with: [  //Para usar los parámetros directamnte dentro del markdown
                'nombreCliente' => $this->asociacion->cliente->nombrecliente,
                'nombreUser' => $this->asociacion->user->name,
                'verContratoUrl' => route('empleado.asociaciones.ver', $this->asociacion),
                'descargarContratoUrl' => route('empleado.asociaciones.descarga', $this->asociacion),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
