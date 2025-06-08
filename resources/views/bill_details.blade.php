<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bill #{{ $bill->id }} | MyShop</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }

        h2 {
            font-weight: 600;
        }

        .card-header {
            background-color: #0d6efd;
            color: white;
        }

        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: white;
            }
            .card, .table {
                border: none !important;
            }
            .card-body {
                padding: 0 !important;
            }
        }
    </style>
</head>
<body>
@include('nav')

<div class="container py-4" id="bill-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Bill Details - <span class="text-dark">#{{ $bill->id }}</span></h2>
        <button onclick="printBill()" class="btn btn-success no-print">🖨️ Print Bill</button>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Customer Details</div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $customer->fname }} {{ $customer->lname }}</p>
                    <p><strong>Email:</strong> {{ $customer->email }}</p>
                    <p><strong>Phone:</strong> {{ $customer->number }}</p>
                    <p><strong>Address:</strong> {{ $customer->address }}, {{ $customer->city }}, {{ $customer->state }} - {{ $customer->pincode }}</p>
                </div>
            </div>
        </div>

        <!-- Seller -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Seller Details</div>
                <div class="card-body">
                    <p><strong>Store Name:</strong> MyShop Pvt. Ltd.</p>
                    <p><strong>Email:</strong> support@myshop.com</p>
                    <p><strong>Phone:</strong> +91-9876543210</p>
                    <p><strong>Address:</strong> 123 Market Road, Delhi, India - 110001</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bill Summary -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">Bill Information</div>
        <div class="card-body row">
            <div class="col-md-6">
                <p><strong>Payment Method:</strong> {{ $bill->paymentMethod }}</p>
                <p><strong>Delivery Status:</strong> {{ $bill->Dilevery }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Order Status:</strong> {{ $bill->orderplaced }}</p>
                <p><strong>Last Updated:</strong> {{ \Carbon\Carbon::parse($bill->updated_at)->format('d M Y, h:i A') }}</p>
            </div>
            <div class="col-12">
                <p><strong>Additional Info:</strong> {{ $bill->information }}</p>
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="card shadow-sm">
        <div class="card-header">Bill Items</div>
        <div class="card-body p-0">
            @if($items->isEmpty())
                <div class="p-3">No items in this bill.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped m-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Product ID</th>
                                <th>Quantity</th>
                                <th>Sell Price</th>
                                <th>GST (%)</th>
                                <th>Total (Incl. GST)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; $grandTotal = 0; @endphp
                            @foreach($items as $item)
                                @php
                                    $total = $item->qty * $item->sellprice;
                                    $gstAmount = $total * ($item->gst / 100);
                                    $totalWithGst = $total + $gstAmount;
                                    $grandTotal += $totalWithGst;
                                @endphp
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->productId }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>₹{{ number_format($item->sellprice, 2) }}</td>
                                    <td>{{ $item->gst }}%</td>
                                    <td>₹{{ number_format($totalWithGst, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr class="table-secondary fw-bold">
                                <td colspan="5" class="text-end">Grand Total</td>
                                <td>₹{{ number_format($grandTotal, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function printBill() {
        window.print();
    }
</script>

</body>
</html>
