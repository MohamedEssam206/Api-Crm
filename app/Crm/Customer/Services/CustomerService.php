<?php

namespace Crm\Customer\Services;

use Crm\Customer\Events\CustomerCreation;
use Crm\Customer\Models\Customer;
use Crm\Customer\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerService
{
    private CustomerRepository $customerRepository;

    /**
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }


    public function index(Request $request)
    {
        # وظيقه ال Repository بدل ما كنت بنادي علي ال model لا بنادي علي ال Repository في ال service وهيا بتعملي الي انا عاوزه بدل ال model
        return $this->customerRepository->all();

//        return Customer::all();
    }

    public function show($id)
    {

        return $this->customerRepository->find($id);
    }

    public function create($name)
    {
        # بدل ما تبعت ال Request كله انت ممكن تبعتله اسم ال Request ال جايلك زي ال name هنا كده

        $customer = new Customer();
        $customer->name = $name;
        $customer->save();

        event(new CustomerCreation($customer));

        return $customer;
    }

    public function update(Request $request , $id)
    {
        $customer = Customer::find($id);

        if (!$customer){
            return response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
        }

        $customer->name = $request->get('name');
        $customer->save();

        return $customer;
    }

    public function delete(Request $request , $id)
    {
        $customer = Customer::find($id);

        if (!$customer){
            return response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
        }

        $customer->delete();

        return response()->json(['status' => 'deleted'] , Response::HTTP_OK);
    }
}
