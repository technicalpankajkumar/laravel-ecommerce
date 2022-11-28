<?php

namespace App\Listeners;

use App\Events\WelcomeEvent;
use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeListener implements ShouldQueue
{
    public $queue='listener';
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\welcomeEvent  $event
     * @return void
     */
    public function handle(WelcomeEvent $event)
    {
        $emailData=[
            'subject'=>'Welcome to Mobile Store',
            'body'=>'you are come this shop and buy best price phone comperision to other online shops',
            'tagline'=>'Best Phone Best Price',
            'email'=>$event->email,
        ];
       Mail::to($event->email)->send(new WelcomeMail($emailData));
    }
}
