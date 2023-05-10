<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class TaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * 
     * Create a new message instance.
     */
    public function __construct($details)
    {
        //
        $this->details = $details;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail',
        );
    }

    /**
     * Get the message content definition.
     */
   public function build()
   {

    $taskFilePath = public_path('images/task/' . $this->details['task']);

    return $this->subject('Interview Time And Interviewe Name')
                        ->view('mail.taskmail')
                        ->attach($taskFilePath, [
                            'as' => 'task.pdf',
                            'mime' => 'application/pdf',
                        ]);
   }


}
