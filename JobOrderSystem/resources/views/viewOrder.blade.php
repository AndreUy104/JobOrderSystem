@extends('mainView.layout')

@section('content')
    <h1>View Orders</h1>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                {{--Search By Customer name or order number--}}
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Customer Name Or Order Number">
                    <label for="floatingInput">Search Customer Name or Order Number</label>
                </div>
            </div>
            <div class="col-6">
                {{--Search by Date--}}
                <form method="GET" action="#">
                    <div class="row">
                        <div class="col">
                            <label for="startDate" class="form-label">From</label>
                            <input type="date" id="startDate" name="from" value="{{ request('from') }}" style="height: 35px" required>

                            <label for="endDate" class="form-label">To</label>
                            <input type="date" id="endDate" name="to" value="{{ request('to') }}" style="height: 35px" required>

                            <button class="btn btn-primary" type="submit">Search</button>
                            <a class="btn btn-secondary" href="{{ @route('view') }}" role="button">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                {{--Sort by Category--}}
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option selected>Please Select</option>
                        <option value="1">Plaque</option>
                        <option value="2">Signage</option>
                        <option value="3">Metal Cutting</option>
                    </select>
                    <label for="floatingSelect">Sort Category By:</label>
                </div>
            </div>
        </div>
    </div>
    {{ $orders->links('pagination::bootstrap-5') }}
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Order Number</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Created On</th>
            <th scope="col">Created By</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
                <tr>
                    <th>{{ $order->created_at->format("Y") }} - {{$order->id}}</th>
                    <td>{{ $order->customer->customer_name }}</td>
                    <td>{{ $order->created_at->toDateString() }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        <a href="{{ @route('print' , ['orderNum' => $order->id]) }}">View</a>
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>
    {{ $orders->links('pagination::bootstrap-4') }}

@endsection()
