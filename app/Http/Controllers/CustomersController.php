<?php

namespace App\Http\Controllers;

use Crm\Base\ResponseBuilder;
use Crm\Customer\Requests\CreateCustomer;
use Crm\Customer\Services\CustomerExportService;
use Crm\Customer\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomersController extends Controller
{
    private CustomerService $customerService;
    private CustomerExportService $customerExportService;

    # ده كده اسمه dependency injection انك بيكون عندك حاجه external dependency ال هوا (CustomerService) عملتلها inject جوا ال class
    public function __construct(CustomerService $customerService, CustomerExportService $customerExportService)
    {
        $this->customerService = $customerService;
        $this->customerExportService = $customerExportService;
    }


    public function index(Request $request)
    {
        $customer = $this->customerService->index($request);
        return responseBuilder()
            ->setData($customer)
            ->response();
    }

    public function show($id)
    {
        $customer =  $this->customerService->show($id);
        if (!$customer){
            return responseBuilder()
                ->setStatusCode(JsonResponse::HTTP_BAD_REQUEST)
                ->setError(['generic' => 'Customer Not Found'])
                ->response();
        }
        return responseBuilder()
            ->setData($customer)
            ->response();
    }

    public function create(CreateCustomer $request)
    {
        return $this->customerService->create($request->name);
    }

    public function update(Request $request , $id)
    {
        return $this->customerService->update($request ,$id);
    }

    public function delete(Request $request , int $id)
    {
        return $this->customerService->delete($request , (int) $id);
    }

    public function export(Request $request)
    {
         $this->customerExportService->export($request->get('format' , 'json'));
    }


}

