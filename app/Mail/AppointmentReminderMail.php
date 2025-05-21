<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class AppointmentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notifications;

    public function __construct($notifications)
    {
        $this->notifications = $notifications;
    }

    public function build()
    {
        // build a plain‑text or HTML body inline:
        $body = '<h2>Appointment Reminder</h2>';
        $body .= '<p>You have upcoming appointment(s):</p><ul>';

        foreach ($this->notifications as $appt) {
            $date = Carbon::parse($appt->rendezvous)->format('d M Y, H:i');
            $doctor = $appt->doctor->user->name;
            $body .= "<li>{$date} — Dr. {$doctor}</li>";
        }

        $body .= '</ul><p>Please don\'t forget your visit.</p>';

        return $this
            ->subject('Appointment Reminder')
            ->html($body);
    }
}

/*

0
class AppointmentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

     * Create a new message instance.
     
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     public function envelope(): Envelope
     {
        return new Envelope(
            subject: 'Appointment Reminder Mail',
        );
    }
    
    /**
     * Get the message content definition.
     public function content(): Content
     {
        return new Content(
            view: 'view.name',
        );
    }
    
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     public function attachments(): array
     {
        return [];
    }
}

*/
