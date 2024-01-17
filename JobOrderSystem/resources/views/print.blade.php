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
                <br/>
                <br/>
                <div class="container text-center">
                    <x-printPreview :year="$year" :order="$order" :descs="$descs" copy="Original Copy"/>
                </div>
                <br/>
                <br/>
                <hr style="border: 5px solid #000000; margin: 20px auto;">
                <div class="container text-center">
                    <x-printPreview :year="$year" :order="$order" :descs="$descs" copy="Customer Copy"/>
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
            width: 210mm; /* Set width to A4 width */
            height: 297mm; /* Set height to A4 height */
            margin: 0; /* Remove default margin to fully utilize the page */
            padding: 0; /* Remove default padding to fully utilize the page */
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
