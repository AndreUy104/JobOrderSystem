@extends('mainView.layout')

@section('content')
    @guest
        <x-landing/>
    @endguest
@auth
<div class="container text-center">
    <div class="row">
    <div class="col"/>
    <div class="col">
      <h1>Job Order System</h1>
      <p>By: A.L.U. Tech</p>
    </div>
    <div class="col"/>
    </div>
    <div class="row">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('img/Create.png') }}" class="card-img-top" alt="Create">
                <div class="card-body">
                    <h5 class="card-title">Create</h5>
                    <p class="card-text">Navigate into <strong>Create Order or Click the button Below</strong> to create a new Order</p>
                    <a href="{{ @route('create-customer') }}" class="btn btn-primary">Create Order</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('img/Find.png') }}" class="card-img-top" alt="View">
                <div class="card-body">
                    <h5 class="card-title">View</h5>
                    <p class="card-text">Navigate into <strong>View Orderor Click the button Below</strong> to view all orders from different customers. Click the view button in-order to see the full details of the order</p>
                    <a href="{{ @route('view') }}" class="btn btn-primary">View Order</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('img/print.jpg') }}" class="card-img-top" alt="Print">
                <div class="card-body">
                    <h5 class="card-title">Print</h5>
                    <p class="card-text">A full details of the order will be shown and you may have the option to print the order</p>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col"/>
        <div class="col">
          <h4>Simple, Reliable and Fast</h4>
          <img src="{{ asset('img/ALUlogo.png') }}" alt="ALULogo" style="border-radius: 50%; height: 200px;">
        </div>
        <div class="col"/>
     </div>
</div>
@endauth
@endsection
