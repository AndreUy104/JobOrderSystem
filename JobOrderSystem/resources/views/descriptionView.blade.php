@extends('mainView.layout')
@section('content')
<div class="card text-bg-light mb-3" id="descView">
    <h5 class="card-header">Order List</h5>
    <div class="card-body">
            <div class="row">
                <!-- Add Order Form -->
                <div class="col-md-6">
                    <form method="POST" action="{{ route('save-description', ['customer' => $customers]) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="qty">Quantity</label>
                            <input type="number" name="qty" class="form-control" id="qty" placeholder="Qty" required>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Description" required>
                        </div>
                        <div class="mb-3">
                            <label for="price">Price</label>
                            <input type="number" step="any" name="price" class="form-control" id="price" placeholder="Price" required>
                            <br/>
                            <button class="btn btn-success" type="submit">Add Order</button>
                        </div>
                    </form>
                </div>
                <!-- Order List -->
                <div class="col-md-6">
                    <div class="scroll-div">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Qty</th>
                                <th scope="col">Description</th>
                                <th scope="col">Unit Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($descs ?? [] as $desc)
                                <tr>
                                    <td>{{ $desc->qty }}</td>
                                    <td>{{ $desc->description }}</td>
                                    <td>{{ $desc->price }}</td>
                                    <td>
                                        <form id="removeForm" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="deleteDescription('{{ route('delete-description', ['description' => $desc->id, 'customer' => $customers]) }}')" class="btn btn-outline-danger">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Order Added.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <form method="POST" action="{{ @route('save-order' , ['customer' => $customers] ) }}">
        @csrf
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control disable" name="total" id="specificSizeInputGroupUsername" value="{{$total}}" readonly >
                    </div>
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
                        <input type="number" step="any" class="form-control" name="payment" id="payment" onchange="validateDp()" value="{{$total}}">
                        <label for="floatingInput">Amount</label>
                    </div>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" id="floatingTextarea2" name="remarks" style="height: 100px" required></textarea>
                    <label for="floatingTextarea2">Remarks</label>
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
        height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
        text-align:justify;
    }
</style>

<script>

    function validateDp() {
        var amountInput = document.getElementById("payment");
        var amount = parseFloat(amountInput.value);
        var total = parseFloat("{{$total}}");

        if (amount > total) {
            alert("Payment amount cannot be greater than total.");
            // You might want to reset the input value or take some other action
            amountInput.value = total;
        }
    }

    function deleteDescription(route) {
        // Confirm deletion with the user if needed
        if (!confirm("Are you sure you want to delete this item?")) {
            return;
        }

        // Send a DELETE request using Fetch API
        fetch(route, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        location.replace(location.href);
    }

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
        console.log(showAmount)
    }
</script>

