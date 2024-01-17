@props(['year', 'order' , 'descs' , 'copy'])

<img src="{{ asset('img/banner.jpg') }}" class="watermark">
<div class="row">
    <div class="col">
        <h6>Billing Statement: {{$year}} - {{ $order->id }}</h6>
    </div>
    <div class="col-6">
        <h6>{{$copy}}</h6>
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

<style>
    .watermark {
        position: absolute; /* Position freely over other content */
        width: 100%; /* Ensure full width coverage */
        height: 40%; /* Ensure full height coverage */
        opacity: 0.3; /* Adjust transparency as desired */
        z-index: -1; /* Place behind other content */
        border-radius: 8px;
        left: 0; /* Added to position the watermark at the left edge */
    }

</style>