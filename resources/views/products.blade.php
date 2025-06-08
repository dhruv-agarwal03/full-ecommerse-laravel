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

    .icon-shape {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        vertical-align: middle;
    }

    .icon-sm {
        width: 2rem;
        height: 2rem;
    }
</style>

<script>
    // Cart Cookie Functions
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

    function saveCartToCookie(cartArray) {
        document.cookie = "cart=" + encodeURIComponent(JSON.stringify(cartArray)) +
            "; path=/; max-age=" + (60 * 60 * 24 * 7); // 7 days
    }

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

    function removeCartItem(id) {
        let cart = getCartFromCookie();
        cart = cart.filter(item => item.id !== id);
        saveCartToCookie(cart);
    }

    function initCartUI() {
        const cart = getCartFromCookie();
        cart.forEach(item => {
            const productId = item.id;
            const qtyDiv = document.getElementById(`qty:${productId}`);
            const noQtyBtn = document.getElementById(`noqty:${productId}`);
            if (qtyDiv && noQtyBtn) {
                qtyDiv.style.display = 'flex';
                noQtyBtn.style.display = 'none';
                const input = qtyDiv.querySelector('input[name="quantity"]');
                if (input) input.value = item.quantity;
            }
        });
    }

    function setupCartButtons() {
        const allQtyDivs = document.querySelectorAll('[data-product-id]');

        allQtyDivs.forEach(container => {
            const productId = container.getAttribute('data-product-id');
            const qtyDiv = document.getElementById(`qty:${productId}`);
            const noQtyBtn = document.getElementById(`noqty:${productId}`);
            const minusBtn = qtyDiv.querySelector('.button-minus');
            const plusBtn = qtyDiv.querySelector('.button-plus');
            const input = qtyDiv.querySelector('input[name="quantity"]');

            // Increase Quantity
            plusBtn.addEventListener('click', () => {
                let val = parseInt(input.value) || 1;
                if (val < 1000) {
                    val += 1;
                    input.value = val;
                    addOrUpdateCartItem(productId, val);
                }
            });
            input.addEventListener('input', () => {
                let val = parseInt(input.value);
                if (isNaN(val) || val < 1) {
                    val = 1;
                    qtyDiv.style.display = 'none';
                    noQtyBtn.style.display = 'block';
                    removeCartItem(productId);
                } else if (val > 1000) {
                    val = 1000;
                }
                input.value = val;
                addOrUpdateCartItem(productId, val);
            });
            minusBtn.addEventListener('click', () => {
                let val = parseInt(input.value) || 1;
                val -= 1;
                if (val <= 0) {
                    input.value = 1;
                    qtyDiv.style.display = 'none';
                    noQtyBtn.style.display = 'block';
                    removeCartItem(productId);
                } else {
                    input.value = val;
                    addOrUpdateCartItem(productId, val);
                }
            });

            noQtyBtn.addEventListener('click', () => {
                const quantity = parseInt(input.value) || 1;
                if (quantity > 0) {
                    addOrUpdateCartItem(productId, quantity);
                    qtyDiv.style.display = 'flex';
                    noQtyBtn.style.display = 'none';
                } else {
                    alert('Please enter a valid quantity');
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        initCartUI();
        setupCartButtons();
    });
</script>

<div class="">
    <div style="position:fixed; right:20px;bottom:10px "> <a href="/cart"><img src="{{asset('images/cart.jpg')}}" width="100px"/></a> </div>
    <div class="row m-2">
        @foreach($data as $pro)
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-6 p-3 " data-product-id="{{ $pro['product_id'] }}">
            
            <div>
                <a href="product/{{$pro['product_id']}}">
                <img src="data:image/png;base64,{{ $pro['image'] }}" width="100%"/>
</a>
            </div>

            <div>
                <b class="h3 m3" >{{$pro["name"]}}</b>
                @if($pro['MRP'] != $pro['sellingPrice'])
                <div class="text-danger h3"><del>&#8377;{{ $pro['MRP'] }}</del></div>
                <span class="text-success h3">&#8377;{{ $pro['sellingPrice'] }}</span><br/>
                <span class="text-info fw-bolder">Saved: &#8377;{{ $pro['MRP'] - $pro['sellingPrice'] }}</span>
                @else
                <br/><br/>
                <div class="text-success h3">&#8377;{{ $pro['sellingPrice'] }}</div>
                @endif

                @if($pro['Available'] != "N")
                <!-- Quantity Control -->
                <div class="input-group w-auto justify-content-end align-items-center my-2"
                     id="qty:{{ $pro['product_id'] }}"
                     style="display: none;">
                    <button type="button" class="button-minus border rounded-circle icon-shape icon-sm mx-1">-</button>
                    <input type="number" step="1" max="1000" min="1" value="1" name="quantity"
                           class="quantity-field border-0 text-center w-25">
                    <button type="button" class="button-plus border rounded-circle icon-shape icon-sm">+</button>
                </div>

                <!-- Add to Cart Button -->
                <button type="button"
                        id="noqty:{{ $pro['product_id'] }}"
                        class="btn btn-success add-to-cart-btn"
                        style="display: block;">
                    Add in cart
                </button>
                @else
                <div class="h4 text-danger">Out of Stock</div><br/>
                @endif

                @if($pro['qualityNo'] != 0)
                <div class="h6 text-info">Quality: {{ $pro['qualityNo'] }}</div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    
</div>
