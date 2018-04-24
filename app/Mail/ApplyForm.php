<?php

namespace App\Mail;

use App\Profile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplyForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Profile instance
     *
     * @var Profile
     */
    public $profile;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->to(['hector@maniak.com.mx']);

        return $this->view('emails.apply-form');
    }
}
