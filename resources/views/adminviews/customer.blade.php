
    <title>Customer #{{ $customer->fname }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<body>

<div class="container my-5">
    <h2 class="mb-4">Customer Billing Details</h2>

    <!-- Customer Info -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Customer Information
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $customer->fname }} {{ $customer->lname }}</p>
            <p><strong>Email:</strong> {{ $customer->email ?? 'N/A' }}</p>
            <p><strong>Phone:</strong> {{ $customer->number }}</p>
            <p><strong>Address:</strong> {{ $customer->address }}, {{ $customer->city }}, {{ $customer->state }} - {{ $customer->pincode }}</p>
        </div>
    </div>

    <!-- Bills -->
     <div>
        <form method="POST">
            <div class="row">
                <input class="col-xxl-5 col-xl-5 col-lg-5 col-10 m-1 p-1" type="number" class="form form-control" name="amount" min="0"/>
                <input class="col-xxl-5 col-xl-5 col-lg-5 col-10 m-1 p-1" type="text" class="form form-control" name="information" placeholder="Any information" required/>
</div>
            <div class="m-2">
                <button type="submit" class="btn btn-success" name="deposit">Deposit</button>
                <button type="submit" class="btn btn-danger" name="Withdraw">withdraw</button>
            </div>
        </form>
     </div>
    <div class="card">
        <div class="card-header bg-success text-white">
            Bills Of {{ $customer->fname }}
        </div>
        <div class="card-body p-0">
            @if($dairy->isEmpty())
                <div class="p-3">No Information found for this customer.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Action </th>
                                <th>Amount</th>
                                <th>Date & Time</th>
                                <th>Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $ind=1;
                            @endphp
                            @foreach($dairy as $bill)
                                <tr>
                                    <td>{{$ind++}}</td>
                                    <td>{{ $bill->action }}</td>
                                    <td>{{ $bill->amount }}</td>
                                    <td>{{ \Carbon\Carbon::parse($bill->updated_at)->format('d M Y, h:i A') }}</td>
                                    <td>
                                    @if($bill->action=='Bill Generated'||$bill->action=='Bill Payment')
                                    <a href="{{ route('bill.info', ['id' => $bill['information']]) }}" class="btn btn-info btn-sm" target="_blank">Details</a>
                                    @else
                                            {{$bill->information}}
                                    
                                    @endif
                                </td>
                                   </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        
                          
    </div>
</div>

</body>
</html>
