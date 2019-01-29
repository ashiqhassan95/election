<?php

namespace App\Mail;

use App\Models\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteCreated extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Invite
     */
    public $invite;

    /**
     * Create a new message instance.
     *
     * @param Invite|mixed $invite
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('elect@gmail.com')
            ->subject("You've been invited to join the Elect")
            ->view('emails.invite');
    }
}
