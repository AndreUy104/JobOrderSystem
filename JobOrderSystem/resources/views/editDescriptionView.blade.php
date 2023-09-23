@extends('mainView.layout')
@section('content')

    <div class="card text-bg-light mb-3" id="descView">
        <h5 class="card-header">Edit Order List</h5>
        <div class="card-body">
            <form method="POST" action="{{ @route('edit-description' , ['customer' => $customer_id] ) }}">
                @csrf
                <div class="row">
                    <div class="col-sm">
                        <input type="number" name="qty" class="form-control" placeholder="Qty" aria-label="Qty" required>
                        <br/>
                        <button class="btn btn-success" type="submit">Add Order</button>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" name="description" class="form-control" placeholder="Description" aria-label="Description" required>
                    </div>
                    <div class="col-sm">
                        <input type="number" step="any" name="price" class="form-control" placeholder="Price" aria-label="Price" required>
                    </div>
            </form>
            <div class="col">
                <div class="scroll-div">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Qty</th>
                            <th scope="col">Description</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @empty($descs)
                            <p>No Order Added.</p>
                        @else
                            @foreach($descs as $desc)
                                <tr>
                                    <td>{{ $desc->qty }}</td>
                                    <td>{{ $desc->description }}</td>
                                    <td>{{ $desc->price }}</td>
                                    <td>
                                        <form method="POST" class="d-inline" action="{{@route('delete-description' , ['description' => $desc->id , 'customer' => $customer_id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endempty
                        </tbody>
                    </table>
                </div>
            </div>
            <form method="POST" action="{{ @route('edit-order' , ['customer' => $customer_id] ) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="input-group" style="margin-left: 1000px">
                        <div class="input-group-text">₱</div>
                        <input type="text" class="form-control disable" name="total" id="specificSizeInputGroupUsername" value="{{$total}}" readonly >
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col">
                        <input type="radio" class="btn-check" name="options-outlined" id="fullPay" onchange="handleChange('full')">
                        <label class="btn btn-outline-primary" for="fullPay">Full Payment</label>
                        <input type="radio" class="btn-check" name="options-outlined" id="downPay" onchange="handleChange('down')">
                        <label class="btn btn-outline-secondary" for="downPay">Down-Payment</label>
                        <br/>
                        <br/>
                        <div class="form-floating mb-3"  id="amountContainer">
                            <input type="number" step="any" class="form-control" name="payment" id="payment" value="{{$total}}">
                            <label for="floatingInput">Amount</label>
                        </div>
                    </div>
                    <div class="form-floating">
                        @foreach($orders as $order)
                        <textarea class="form-control" id="floatingTextarea2" name="remarks" style="height: 100px" required>{{$order->remarks}}</textarea>
                        <label for="floatingTextarea2">Remarks</label>
                        @endforeach
                        <br/>
                        <br/>
                    </div>
                    <button type="submit" class="btn btn-success" style="width: 400px">Create Order</button>
                </div>
            </form>
        </div>
    </div>
@endsection


<style>
    .scroll-div{
        padding:5px;
        margin:5px;
        width: 400px;
        height: 150px;
        overflow-y: auto;
        overflow-x: hidden;
        text-align:justify;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let showAmount = false;
        const amountContainer = document.getElementById("amountContainer");

        if (amountContainer) {
            if (showAmount) {
                amountContainer.style.display = "block";
            } else {
                amountContainer.style.display = "none";
            }
        } else {
            console.error("amountContainer is null or undefined");
        }

    })

    function handleChange(value){
        switch (value) {
            case 'full':
                showAmount = false;
                amountContainer.style.display = "none";
                break;
            case 'down':
                showAmount = true;
                amountContainer.style.display = "block";
                break;
            default:
                break;
        }
    }
</script>

