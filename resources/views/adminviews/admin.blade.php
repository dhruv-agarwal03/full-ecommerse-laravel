@include('adminviews.AdminNav')


<table class="table">
    <thead>
        <tr>
            <th>Bill No.</th>
            <th>Name</th>
            <th>Payment</th>
            <th>Info</th>
            <th>Delivery</th>
            <th>Order Placed</th>
            <th>Date</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr class='{{ $d['Dilevery'] == 'P' ? 'table-primary' : 'table-light' }}'>
            <td>{{$d["id"]}}</td>
            <td>{{ $d['customer_name'] ?? $d['name'] ?? 'Unknown' }}</td>
            <td>{{ $d['paymentMethod'] }}</td>
            <td>{{ $d['information'] }}</td>

            <td>
                @if($d['Dilevery'] == 'P')
                    <form method="POST" action="{{ route('update.delivery', ['id' => $d['id']]) }}">
                        <input type="hidden" name="bill_id" value="{{ $d['id'] }}">
                        <select name="delivery_status" class="form-select form-select-sm d-inline w-auto">
                            <option value="p" {{ $d['Dilevery'] == 'P' ? 'selected' : '' }}>Pending</option>
                            <option value="D" {{ $d['Dilevery'] == 'D' ? 'selected' : '' }}>Delivered</option>
                        </select>
                        <button class="btn btn-sm btn-primary">Update</button>
                    </form>
                @else
                    Delivered
                @endif
            </td>

            <td>
                @if($d['orderplaced'] == 'P')
                    <form method="POST" action="{{ route('update.placed', ['id' => $d['id']]) }}">
                        <input type="hidden" name="bill_id" value="{{ $d['id'] }}">
                        <select name="delivery_status" class="form-select form-select-sm d-inline w-auto">
                            <option value="p" {{ $d['orderplaced'] == 'P' ? 'selected' : '' }}>Pending</option>
                            <option value="D" {{ $d['orderplaced'] == 'D' ? 'selected' : '' }}>Packed</option>
                        </select>
                        <button class="btn btn-sm btn-primary">Update</button>
                    </form>
                @else
                    Packed
                @endif
            </td>
            <td>{{ $d['created_at'] }}</td>
            <td>
                <a href="{{ route('bill.info', ['id' => $d['id']]) }}" class="btn btn-info btn-sm" target="_blank">Details</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
