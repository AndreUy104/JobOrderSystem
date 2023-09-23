<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Description;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{

    public function showAll(){
        return view('createOrder' , [
            'descs' => Description::latest(),
        ]);
    }

    public function create(){
        $latestCustomerId = Customer::latest()->first()->id;
        $descs = Description::where('customer_id', $latestCustomerId)->latest()->get();
        $total = 0;
        foreach ($descs as $desc){
            $descPrice = $desc->price;
            $descQty = $desc->qty;
            $subtotal = $descPrice * $descQty;
            $total += $subtotal;
        }
        return view('descriptionView' , [
            'customers' => $latestCustomerId,
            'descs' => $descs,
            'total' => $total,
        ]);
    }

    public function store(Customer $customer){
        $desc = new Description;
        $desc->qty = request('qty');
        $desc->description = request('description');
        $desc->price = request('price');
        $desc->customer_id = $customer->id;
        $desc->save();


        return redirect()->route('create-description', ['customer' => $customer->id]);
    }

    public function destoryDescription(Description $description){
        $latestCustomerId = Customer::latest()->first()->id;
        $description->delete();
        return redirect()->route('create-description', ['customer' => $latestCustomerId ])->with('success' , 'Description removed!');
    }

    public function edit($customer){
        $desc = new Description;
        $desc->qty = request('qty');
        $desc->description = request('description');
        $desc->price = request('price');
        $desc->customer_id = $customer;
        $desc->save();


        return redirect()->route('edit-description', ['customer' => $customer]);
    }

    public function destoryEditDescription(Description $description , $customer){
        $description->delete();
        return redirect()->route('edit-description', ['customer' => $customer])->with('success' , 'Description removed!');
    }
}
