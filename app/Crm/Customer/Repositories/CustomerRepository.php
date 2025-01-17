<?php

namespace Crm\Customer\Repositories;

use Crm\Base\Repositories\Repository;
use Crm\Customer\Models\Customer;

class CustomerRepository extends Repository
{
    public function __construct(Customer $customer)
    {
        $this->setModel($customer);
    }

    public function customerAnalytic(): array
    {
        return [];
    }
}
