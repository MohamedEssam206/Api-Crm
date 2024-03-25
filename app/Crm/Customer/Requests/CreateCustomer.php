<?php

namespace Crm\Customer\Requests;


use Crm\Base\Requests\ApiRequest;

class CreateCustomer extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|min:3'
        ];
    }
}
