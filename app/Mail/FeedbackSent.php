<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\{Feedback, User};

class FeedbackSent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The feedback instance.
     *
     * @var Feedback
     */
    public $feedback;

    /**
     * The admin instance.
     *
     * @var User
     */
    public $admin;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Feedback  $feedback
     * @return void
     */
    public function __construct(Feedback $feedback, User $admin)
    {
        $this->feedback = $feedback;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function build()
    {
        return $this->view('mails.feedback');
    }
}
