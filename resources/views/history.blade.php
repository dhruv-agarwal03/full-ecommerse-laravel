@include("nav")

@if(empty($data))
    <p>Your cart is empty.</p>
@else
    @php
        $i=1
    @endphp
        
<table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Bill Id</th>
                <th>Payment </th>
                <th>dilevery</th>
                <th>date</th>
                <th>Info</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
                
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $d['id'] }}</td>
                    <td>{{ $d['paymentMethod'] }}</td>
                   <td>{{ $d['Dilevery'] == 'D' ? 'Delivered' : 'Pending' }}</td>
                    <td>{{ $d['updated_at'] }}</td>
                    <td>{{ $d['information'] }}</td>
                    <td><a href="{{ route('bill.details', ['id' => $d['id']]) }}" class="btn btn-info" target="_blank">Details</a></td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
  

@endif