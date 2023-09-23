<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function show(){
        return view('descriptionView' , [
            'customers' => Customer::latest(),
        ]);
    }

    public  function create(){
        return view('createCustomer');
    }

    public function store(){
        $cust = new Customer();
        $cust->customer_name = \request('customer_name');
        $cust->contact_num = \request('contact_num');
        $cust->address = \request('address');
        $cust->save();

        return redirect("/create-order/customer/{$cust->id}")->with('success' , 'Customer Added!');
    }

    public function edit($customerId){

        $customers = Customer::where('id', $customerId)->latest()->get();

        return view ('editCustomer' , [
            'customers' => $customers,
        ]);
    }

    public function updateCustomer(Request $request , $customerId){
        $customer = Customer::findOrFail($customerId);

        $customer->customer_name = $request->input('customer_name');
        $customer->contact_num = $request->input('contact_num');
        $customer->address = $request->input('address');

        $customer->save();


        return redirect("/edit-order/{$customerId}")->with('success' , 'Customer Updated!');
    }
}
