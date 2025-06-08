<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bill #{{ $bill->id }} | MyShop</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
   <style>
    body {
        background-color: #f8f9fa;
        font-size: 14px; /* Slightly smaller font */
    }

    h2 {
        font-weight: 600;
        margin-bottom: 0.5rem; /* Reduce bottom margin */
    }

    .card-header {
        background-color: #0d6efd;
        color: white;
        padding: 0.5rem 1rem; /* Less padding */
        font-size: 1rem;
    }

    .card-body {
        padding: 0.5rem 1rem; /* Less padding inside cards */
    }

    p {
        margin-bottom: 0.25rem; /* Reduced spacing between paragraphs */
    }

    table.table {
        margin-bottom: 0; /* Remove bottom margin */
        font-size: 14px; /* Smaller font for table */
    }

    .table th, .table td {
        padding: 0.3rem 0.5rem; /* Smaller cell padding */
        vertical-align: middle;
    }

    .table thead th {
        border-bottom-width: 1px;
    }

    .btn {
        padding: 0.3rem 0.75rem; /* Smaller button padding */
        font-size: 0.9rem;
    }

    @media print {
        .no-print {
            display: none !important;
        }
        body {
            background-color: white;
            font-size: 12px;
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

    <div class="card shadow-sm mb-4">
        <div class="card-header">Bill Information</div>
        <div class="card-body row">
            <div class="col-md-6">
                <p><strong>Payment Method:</strong> {{ $bill->paymentMethod }}</p>
                <p><strong>Delivery Status:</strong> {{ $bill->Dilevery=='P'?'Pending':'Delivered' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Order Status:</strong> {{ $bill->orderplaced=='D'?'Packed':'Pending' }}</p>
                <p><strong>Last Updated:</strong> {{ \Carbon\Carbon::parse($bill->created_at)->format('d M Y, h:i A') }}</p>
            </div>
            <div class="col-12">
                <p><strong>Additional Info:</strong> {{ $bill->information }}</p>
            </div>
        </div>
    </div>

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
                                <th>#b</th>
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
                                    <td>{{ $item->name }}</td>
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
