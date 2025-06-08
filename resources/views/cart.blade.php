@include("nav")

@if(empty($cart))
    <p class="h3 m-2 text-success">Your cart is empty.</p>
@else
    @php 
        $i = 1;
        $final = 0;
    @endphp

    <div class="container mt-4">
        <h2>Your Cart</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price per piece</th>
                    <th>Total Amount</th>
                    <th>GST (%)</th>
                    <th>Final Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    @php
                        $total = $item['qty'] * $item['price'];
                        $finalAmount = $total * (100 + $item['GST']) / 100;
                        $final += $finalAmount;
                    @endphp
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['qty'] }}</td>
                        <td>₹{{ number_format($item['price'], 2) }}</td>
                        <td>₹{{ number_format($total, 2) }}</td>
                        <td>{{ $item['GST'] }}%</td>
                        <td>₹{{ number_format($finalAmount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td colspan="6" class="text-end"><strong>Final Amount:</strong></td>
                    <td><strong>₹{{ number_format($final, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <form action="#" method="post" class="row g-3 justify-content-end">
            <div class="col-md-4">
                <label for="payment" class="form-label">Select Payment Method</label>
                <select name="payment" id="payment" class="form-select">
                    <option>Cash on Delivery</option>
                    <option>UPI</option>
                    <option>Banking</option>
                </select>
            </div>
            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-success w-100">Confirm Order</button>
            </div>
        </form>
    </div>
@endif
