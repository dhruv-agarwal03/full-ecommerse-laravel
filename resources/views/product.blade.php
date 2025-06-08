@include('nav')

<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        border: none;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<div class="container py-5">
    <div class="row">
        <!-- Image -->
        <div class="col-md-6">
            <img src="data:image/png;base64,{{ $image }}" width="100%"/>
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <h2 class="mb-3">{{ $product->name }}</h2>

            @if($product->MRP != $product->sellingPrice)
                <h4 class="text-danger"><del>₹{{ $product->MRP }}</del></h4>
                <h3 class="text-success">₹{{ $product->sellingPrice }}</h3>
                <p class="text-info fw-bold">You save ₹{{ $product->MRP - $product->sellingPrice }}</p>
            @else
                <h3 class="text-success">₹{{ $product->sellingPrice }}</h3>
            @endif

            <p><strong>HSN Code:</strong> {{ $product->HSNcode }}</p>
            <p><strong>GST:</strong> {{ $product->gst }}%</p>

            @if($product->expirs)
                <p><strong>Expires:</strong> {{ \Carbon\Carbon::parse($product->expirs)->format('d M Y') }}</p>
            @endif

            @if($product->qualityNo != 0)
                <p><strong>Quality:</strong> {{ $product->qualityNo }}</p>
            @endif

            @if($product->Available != 'N')
                <div class="mt-3">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="1000" class="form-control w-25 d-inline-block">
                    <button id="add-to-cart-btn" class="btn btn-success ms-2">Add to Cart</button>
                </div>
            @else
                <div class="alert alert-danger mt-3">Out of Stock</div>
            @endif
        </div>
    </div>
</div>

<script>
    // Utility: Get cart from cookie (returns array)
    function getCartFromCookie() {
        const name = "cart=";
        const decodedCookie = decodeURIComponent(document.cookie);
        const cookies = decodedCookie.split(';');
        for (let c of cookies) {
            c = c.trim();
            if (c.indexOf(name) === 0) {
                try {
                    return JSON.parse(c.substring(name.length));
                } catch {
                    return [];
                }
            }
        }
        return [];
    }

    // Save cart array back to cookie (7 days expiry)
    function saveCartToCookie(cartArray) {
        document.cookie = "cart=" + encodeURIComponent(JSON.stringify(cartArray)) +
            "; path=/; max-age=" + (60 * 60 * 24 * 7);
    }

    // Add new item or update quantity if it exists
    function addOrUpdateCartItem(id, quantity) {
        let cart = getCartFromCookie();
        const index = cart.findIndex(item => item.id === id);
        if (index !== -1) {
            cart[index].quantity = quantity;
        } else {
            cart.push({ id, quantity });
        }
        saveCartToCookie(cart);
    }

    // Event listener for Add to Cart button
    document.getElementById('add-to-cart-btn').addEventListener('click', function() {
        const quantityInput = document.getElementById('quantity');
        let quantity = parseInt(quantityInput.value);
        console.log ({{ $product->productId }});
        if (isNaN(quantity) || quantity < 1) {
            alert('Please enter a valid quantity (1 or more).');
            quantityInput.value = 1;
            quantity = 1;
        } else if (quantity > 1000) {
            alert('Maximum quantity is 1000.');
            quantityInput.value = 1000;
            quantity = 1000;
        }

        const productId = "{{ $product->productId }}";

        addOrUpdateCartItem(productId, quantity);
        alert('Added to cart!');
    });
</script>
