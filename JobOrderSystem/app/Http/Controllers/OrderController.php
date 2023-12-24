<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Description;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showAll(){
        $orders = Order::get();

        foreach ($orders as $order) {
            $timestamp = strtotime($order->created_at); // Assuming 'created_at' is the timestamp column
            $formattedTimestamp = date("Ymd", $timestamp);
            $formattedTimestamps[] = $formattedTimestamp;
        }

        return view('viewOrder' , [
            'orders' => Order::filter(request(['from' , 'to']))->with(['customer' , 'user'])->paginate(10),
            'order_id' => $formattedTimestamps,
        ]);
    }

    public function printPreview(Order $orderNum){
        $years = Order::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        $descriptions = DB::table('descriptions')
            ->join('orders', 'descriptions.customer_id', '=', 'orders.customer_id')
            ->where('orders.id', $orderNum->id)
            ->select('descriptions.*')
            ->get();


        return view('print' , [
            'orders' => Order::where('id', $orderNum->id)->with(['customer' , 'user'])->get(),
            'descs' => $descriptions,
            'years' => $years,
        ]);
    }

    public function store(Customer $customer){

        $payment = \request('payment');

        if ($payment === null || $payment === 0) {
            $payment = \request('total');
        }

        $order = new Order();
        $order->created_by = auth()->user()->id;
        $order->customer_id = $customer->id;
        $order->remarks = \request('remarks');
        $order->payment = $payment;
        $order->total = \request('total');
        $order->save();

        return redirect(route('home'))->with('success' , 'Job Order Created');
    }

    public function edit($customer){
        $descs = Description::where('customer_id', $customer)->latest()->get();
        $total = 0;
        foreach ($descs as $desc){
            $descPrice = $desc->price;
            $descQty = $desc->qty;
            $subtotal = $descPrice * $descQty;
            $total += $subtotal;
        }
        $order = Order::where('customer_id', $customer)->get();


        return view('editDescriptionView' , [
            'customer_id' => $customer,
            'descs' => $descs,
            'total' => $total,
            'orders' => $order,
        ]);
    }

    public function updateOrder(Request $request , $customer){
        $payment = $request->input('payment');

        if ($payment === null || $payment === 0) {
            $payment = $request->input('payment');
        }

        $orders = Order::where('customer_id', $customer)->get();

        foreach ($orders as $order) {
            $order->customer_id = $customer;
            $order->remarks = $request->input('remarks');
            $order->payment = $payment;
            $order->total = $request->input('total');
            $order->save();
        }

        return redirect(@route('view'))->with('success' , 'Order Updated!');
    }

    public function destroyOrder($orderId){

        Order::where('id' , $orderId)->delete();
        return redirect()->route('view')->with('success' , 'Order removed!');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        // Retrieve orders with associated customers where customer_name matches the keyword
        $orders = Order::with('customer')
            ->whereHas('customer', function ($query) use ($keyword) {
                $query->where('customer_name', 'like', '%' . $keyword . '%');
            })
            ->paginate(10);
        return view('viewOrder', compact('orders'));
    }
}
