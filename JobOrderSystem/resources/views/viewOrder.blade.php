@extends('mainView.layout')

@section('content')
    <h1>View Orders</h1>
    <div class="container text-center">
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
                    <th>{{ $order->created_at->format("YmdHis") }}</th>
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
