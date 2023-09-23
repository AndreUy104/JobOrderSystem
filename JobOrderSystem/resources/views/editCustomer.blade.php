@extends('mainView.layout')
@section('content')

    <div class="card text-bg-light mb-3">
        <h5 class="card-header">Edit Customer Details</h5>
        <div class="card-body">
            @foreach($customers as $customer)
                <form method="POST" action="{{ @route('edit-customer' , ['customerId' => $customer->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="customer_name" value="{{ $customer->customer_name }}" required>
                                <label for="floatingInput">Customer Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" name="contact_num" value="{{ $customer->contact_num }}" required>
                                <label for="floatingInput">Customer Contact Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="address" value="{{ $customer->address }}" required>
                                <label for="floatingInput">Customer Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <br/>
                    <button type="submit" class="btn btn-success">Next</button>
                </form>
            @endforeach
        </div>
    </div>
@endsection

