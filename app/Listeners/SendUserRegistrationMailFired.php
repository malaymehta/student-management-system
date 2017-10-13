<?php

namespace App\Listeners;

use App\Events\SendUserRegistrationMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendUserRegistrationMailFired
 *
 * @package App\Listeners
 */
class SendUserRegistrationMailFired
{
    /**
     * @var \App\Repositories\UserRepository
     */
    protected $userRepo;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    /**
     * Handle the event.
     *
     * @param  SendUserRegistrationMail  $event
     * @return void
     */
    public function handle(SendUserRegistrationMail $event)
    {
        $user = $this->userRepo->getById($event->userId)->toArray();
        $content_var_values = \View::make('emails.user_registration_mail')
            ->with(compact('user'))
            ->render();
        $content_data = ['email_content' => $content_var_values];
        Mail::send('emails.sample', $content_data, function($message) use ($user){
            $message->to($user['email']);
            $message->subject('Registration Successfull');
        });
    }
}
