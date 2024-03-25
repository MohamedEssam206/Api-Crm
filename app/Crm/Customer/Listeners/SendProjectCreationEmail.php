<?php

namespace App\Crm\Customer\Listeners;


use Crm\Customer\Events\CustomerCreation;
use Crm\Customer\Services\CustomerService;
use Crm\Project\Events\ProjectCreation;

class SendProjectCreationEmail
{
    private CustomerService $customerService;

    /**
     * Create the event listener.
     */
    public function __construct(CustomerService $customerServices)
    {
        $this->customerService = $customerServices;
    }

    /**
     * Handle the event.
     */
    public function handle(ProjectCreation $event)
    {
        $project = $event->getProject();

        $customer = $this->customerService->show($project->customer_id);


    }
}
