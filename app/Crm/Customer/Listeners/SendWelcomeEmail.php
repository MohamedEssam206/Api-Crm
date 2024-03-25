<?php

namespace Crm\Customer\Listeners;



use Crm\Customer\Events\ProjectCreation;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProjectCreation $event): void
    {
        //
    }
}
