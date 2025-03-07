<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectDone extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Project $project
    )
    {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project Done',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.projects.done',
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
