@extends('mainView.layout')

@section('content')
    @foreach($orders as $order)
        @foreach($years as $year)
            <a class="btn btn-primary" href="{{ @route('view') }}">Back</a>
            <button type="button" class="btn btn-info" onclick="handleEdit({{ $order->customer_id }})">Edit</button>
            <button type="button" class="btn btn-success" onclick="handlePrint()">Print</button>
            @if(auth()->user()->is_admin == true)
                <form method="POST" action="{{@route('destroy-order' , ['orderId' => $order->id])}}" class="d-inline" id="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="handleDelete()" class="btn btn-danger">Remove</button>
                </form>
            @endif
            <div class="print">
                <div class="container text-center">
                    <img src="{{ asset('img/banner.jpg') }}" style="width: 1000px; height: 300px; border-radius: 8px; ">
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col">
                            <h6>Billing Statement: {{$year}} - {{ $order->id }}</h6>
                        </div>
                        <div class="col-6">
                            <h6>Customer Copy</h6>
                        </div>
                        <div class="col">
                            <h6>Date: {{ $order->created_at->toDateString() }}</h6>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col">
                            Customer Name: {{ $order->customer->customer_name }}
                        </div>
                        <div class="col-5">
                            Customer Address: {{ $order->customer->address }}
                        </div>
                        <div class="col">
                            Customer Contact No: {{ $order->customer->contact_num }}
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered align-middle">
                                <thead>
                                <tr>
                                    <th class="col-sm-1">Qty</th>
                                    <th class="col-sm-5">Description</th>
                                    <th class="col-sm-1">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($descs as $desc)
                                        <tr>
                                            <td>{{ $desc->qty }}</td>
                                            <td>{{ $desc->description }}</td>
                                            <td>{{ $desc->price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col">
                            Remarks: {{ $order->remarks }}
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col">
                            <p>Prepared By: {{ $order->user->name }}</p>
                        </div>
                        <div class="col-5">
                            Received By:
                        </div>
                        <div class="col">
                            @if($order->total == $order->payment)
                                <p>Full Paid</p>
                            @else
                                <p>Down Paid: {{ $order->payment }}</p>
                                <p>Balance: {{$order->total - $order->payment}}</p>
                            @endif

                        </div>
                        <div class="col">
                            <p>Total: <strong>₱ {{$order->total}}</strong></p>
                        </div>
                    </div>
                </div>
                 <p style="text-align: center">---------------------------------------------------</p>
                <div class="container text-center">
                    <img src="{{ asset('img/banner.jpg') }}" style="width: 1000px; height: 300px; border-radius: 8px; ">
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col">
                            <h6>Billing Statement {{$year}} - {{ $order->id }}</h6>
                        </div>
                        <div class="col-6">
                            <h6>Company Copy</h6>
                        </div>
                        <div class="col">
                            <h6>Date: {{ $order->created_at->toDateString() }}</h6>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col">
                            Customer Name: {{ $order->customer->customer_name }}
                        </div>
                        <div class="col-5">
                            Customer Address: {{ $order->customer->address }}
                        </div>
                        <div class="col">
                            Customer Contact No: {{ $order->customer->contact_num }}
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered align-middle">
                                <thead>
                                <tr>
                                    <th class="col-sm-1">Qty</th>
                                    <th class="col-sm-5">Description</th>
                                    <th class="col-sm-1">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($descs as $desc)
                                    <tr>
                                        <td>{{ $desc->qty }}</td>
                                        <td>{{ $desc->description }}</td>
                                        <td>{{ $desc->price }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col">
                            Remarks: {{ $order->remarks }}
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col">
                            <p>Prepared By: {{ $order->user->name }}</p>
                        </div>
                        <div class="col-5">
                            Received By:
                        </div>
                        <div class="col">
                            @if($order->total == $order->payment)
                                <p>Full Paid</p>
                            @else
                                <p>Down Paid: {{ $order->payment }}</p>
                            @endif

                        </div>
                        <div class="col">
                            <p>Total: <strong>₱ {{$order->total}}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .print, .print * {
            visibility: visible;
        }

        .print {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>

<script>
   function handlePrint() {
       window.print();
   }

   function handleEdit(customerId) {

       var editCustomerUrl = "{{ route('edit-customer', ['customerId' => ':customerId']) }}";

       var url = editCustomerUrl.replace(':customerId', customerId);
       window.location.href = url;
   }

   function handleDelete() {
       var result = confirm("Are you sure you would like to Delete this Order Permanently?");

       if (result) {
           // If user confirms, proceed with the delete action
           document.getElementById('delete-form').submit();
       } else {
           // If user cancels, do nothing
       }
   }
</script>
