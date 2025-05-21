<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shopping Cart</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 95%;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            background-color: #fff;
            border-radius: 8px;
        }

        .cart-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .cart-container {
            display: grid;
            grid-template-columns: 3fr 1fr;
            gap: 20px;
        }

        .cart-items {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            /* Remove height restrictions to prevent extra space */
            height: auto;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 100px 3fr 2fr 2fr 2fr;
            align-items: center;
            padding: 15px 5px;
            border: 1px solid #eee;
            gap: 25px;
            margin-bottom: 5px;
            transition: background-color 0.2s, transform 0.2s;
            cursor: pointer;
        }

        .cart-item:hover {
            transform: scale(1.02);
            background-color: #f9f9f9;
        }

        .cart-item:last-child {
            border-bottom: 1px solid #eee;
            /* Changed from 'none' to show the border */
        }

        .item-img {
            width: 100%;
            border-radius: 4px;
            object-fit: cover;
            height: 100px;
        }

        .item-details h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .item-details p {
            color: #666;
            font-size: 14px;
        }

        .item-price {
            font-weight: 600;
            color: #ff5722;
            font-size: 18px;
        }

        .item-quantity {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            background-color: #eee;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .quantity-btn:hover {
            background-color: #ddd;
        }

        .quantity-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .quantity-value {
            font-weight: 600;
        }

        .remove-item a {
            background-color: #ff5722;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            display: inline-block;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.2s ease;
            text-align: center;
        }

        .remove-item a:hover {
            background-color: #e64a19;
        }

        /* Right side containers */
        .paymentProcess {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .cart-summary {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            /* Remove fixed height */
            height: auto;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .summary-label {
            font-weight: 500;
        }

        .summary-value {
            font-weight: 600;
        }

        .summary-total {
            font-size: 18px;
            font-weight: 700;
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
        }

        .total-value {
            color: #ff5722;
        }

        .checkout-btn {
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.2s;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .checkout-btn:hover {
            background-color: #e64a19;
        }

        .new-badge {
            background-color: #ff5722;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
        }

        .empty-cart {
            text-align: center;
            padding: 50px 0;
            max-width: 100%;
        }

        .empty-cart p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .continue-shopping {
            background-color: #ff5722;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: background-color 0.2s;
            display: inline-block;
        }

        .continue-shopping:hover {
            background-color: #e64a19;
        }

        .pagination {
            display: flex !important;
            justify-content: center !important;
            margin-top: 20px !important;
        }

        .user-details {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .user-details h2 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #ff5722;
            outline: none;
        }

        .required {
            color: #ff5722;
        }
         .logo img {
                width: 50px;
                margin-left: 0px;
            }
            .main {
                display: flex;
                justify-content: space-between;
                margin: 0 20px;
            }

        @media (max-width: 768px) {
            .cart-container {
                grid-template-columns: 1fr;
            }

            .cart-item {
                grid-template-columns: 100px 2fr 1fr;
                grid-template-rows: auto auto auto;
            }

            .item-img {
                grid-row: span 3;
            }

            .item-details {
                grid-column: 2 / span 2;
                grid-row: 1;
            }

            .item-quantity {
                grid-column: 2;
                grid-row: 2;
                margin-top: 10px;
            }

            .item-price {
                grid-column: 3;
                grid-row: 2;
                text-align: right;
            }

            .remove-item {
                grid-column: 2 / span 2;
                grid-row: 3;
                margin-top: 10px;
            }

            .remove-item button {
                width: 100%;
            }

           
        }
    </style>
</head>

<body>
    <!-- Fixed HTML structure for the cart container -->
    <div class="container">
        <header class="header">
            <div class="main">
                <div class="logo" style="display: flex; align-items: center;">
                    <a href="{{ url('/') }}" style="text-decoration: none; color: inherit;">
                        <span style="font-size:40px; font-weight: bolder; margin-right: 10px;">SoulGift</span>
                    </a></a>
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/nuw_logo.png') }}" alt="Logo">
                    </a>
                </div>
                <div class="titile">
                    <h1 class="cart-title"><span style="color: #FF5722;">{{ Auth::user()->name }}</span>'s Shopping Cart</h1>
                </div>
            </div>


        </header>

        <div class="cart-container">
            <div class="cart-items">
                @if(count($cart_items) > 0)
                @foreach($cart_items as $item)
                <div class="cart-item">
                    <img src="{{ asset('product/'.$item->product->image) }}" alt="{{ $item->product->title }}"
                        class="item-img">
                    <div class="item-details">
                        <h3>{{ $item->product->title }}
                            @if($item->product->is_new)
                            <span class="new-badge">NEW</span>
                            @endif
                        </h3>
                        <p>{{ $item->product->description }}</p>
                    </div>
                    <div class="item">
                        <div class="item-quantity" data-cart-id="{{ $item->id }}">
                            <button class="quantity-btn"
                                onclick="updateQuantity('{{ $item->id }}', 'decrease')">-</button>
                            <span class="quantity-value">{{ $item->quantity ?? 1 }}</span>
                            <button class="quantity-btn"
                                onclick="updateQuantity('{{ $item->id }}', 'increase')">+</button>
                        </div>
                        <div class="items_remaining" data-cart-id="{{ $item->id }}" style="margin-top: 10px; ">
                            <p>Items Remaining: <span
                                    style="color:#e64a19 ;">{{ $item->product->quantity - $item->quantity}}</span></p>
                        </div>
                    </div>
                    <div class="item-price" data-cart-id="{{ $item->id }}"
                        data-unit-price="{{ $item->product->price }}">
                        LKR {{ number_format($item->product->price * $item->quantity, 2) }}
                    </div>

                    <div class="remove-item">
                        <a href="{{ url('delete_item',$item->id ) }}" onclick="confirmation(event)">Remove Item</a>
                    </div>
                </div>
                @endforeach
                @else
                <div class="empty-cart">
                    <p>Your cart is empty.</p>
                    <a href="{{ url('/') }}" class="continue-shopping">Continue Shopping</a>
                </div>
                @endif
            </div>

            <div class="paymentProcess">
                @if(count($cart_items) > 0)
                <!-- User Details Form -->
                <div class="user-details">
                    <h2>Shipping Information</h2>
                    <form action="{{ route('payhere.checkout') }}" method="POST" id="checkoutForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ Auth::user()->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ Auth::user()->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number <span class="required">*</span></label>
                            <input type="tel" id="phone" name="phone" class="form-control"
                                value="{{ Auth::user()->phone ?? '' }}" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Shipping Address <span class="required">*</span></label>
                            <textarea id="address" name="address" class="form-control" rows="3"
                                required>{{ Auth::user()->address ?? '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="city">City <span class="required">*</span></label>
                            <input type="text" id="city" name="city" class="form-control"
                                value="{{ Auth::user()->city ?? '' }}" required>
                        </div>

                        <div class="form-group">
                            <label for="postal_code">Postal Code <span class="required">*</span></label>
                            <input type="text" id="postal_code" name="postal_code" class="form-control"
                                value="{{ Auth::user()->postal_code ?? '' }}" required>
                        </div>

                        <div class="form-group">
                            <label for="notes">Order Notes (Optional)</label>
                            <textarea id="notes" name="notes" class="form-control" rows="2"></textarea>
                        </div>

                </div>

                <!-- Order Summary -->
                @php
                $subtotal = 0;
                $Delivery_charges = 0;
                $total = 0;
                foreach($cart_items as $item) {
                $subtotal += $item->product->price * ($item->quantity ?? 1);
                }
                $total = $subtotal + $Delivery_charges;
                @endphp
                <div class="cart-summary">
                    <h2 class="summary-title">Order Summary</h2>
                    <div class="summary-row">
                        <span class="summary-label">Subtotal ({{ count($cart_items) }} items)</span>
                        <span class="summary-value">LKR {{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Delivery Charges</span>
                        <span class="summary-value">LKR {{ number_format($Delivery_charges, 2) }}</span>
                    </div>
                    <div class="summary-row summary-total">
                        <span class="summary-label">Total</span>
                        <span class="summary-value total-value">LKR {{ number_format($total, 2) }}</span>
                    </div>

                    <button type="submit" class="checkout-btn">Cash On Delivery</button>


                </div>



                <input type="hidden" name="total" value="{{ $total }}">
                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                <input type="hidden" name="delivery_charges" value="{{ $Delivery_charges }}">
                <input type="hidden" name="cart_items" value="{{ json_encode($cart_items) }}">
                </form>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Disable decrease buttons for items with quantity 1 on page load
            document.querySelectorAll('.item-quantity').forEach(function(quantityElement) {
                let quantityValue = parseInt(quantityElement.querySelector('.quantity-value').innerText);
                let decreseBtn = quantityElement.querySelector('.quantity-btn:first-child');
                let increaseBtn = quantityElement.querySelector('.quantity-btn:last-child');
                let itemsRemainingElement = quantityElement.parentElement.querySelector(
                    '.items_remaining span');
                let itemsRemaining = parseInt(itemsRemainingElement.innerText);

                if (quantityValue === 1) {
                    decreseBtn.disabled = true;
                    decreseBtn.style.opacity = "0.5";
                    decreseBtn.style.cursor = "not-allowed";
                } else {
                    decreseBtn.disabled = false;
                }
                if (itemsRemaining <= 0) {
                    increaseBtn.disabled = true;
                    increaseBtn.style.opacity = "0.5";
                    increaseBtn.style.cursor = "not-allowed";
                } else {
                    increaseBtn.disabled = false;
                }
            });
        });

        function confirmation(ev) {
            ev.preventDefault();
            var link = ev.currentTarget.getAttribute('href');
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, it will remove from cart ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    }
                });
        }

        function updateQuantity(cartId, action) {
            let quantityElement = document.querySelector(`.item-quantity[data-cart-id="${cartId}"] .quantity-value`);
            let currentQuantity = parseInt(quantityElement.innerText);
            console.log(currentQuantity);

            let itemsRemainingElement = document.querySelector(`.items_remaining[data-cart-id="${cartId}"] span`);
            let itemsRemaining = parseInt(itemsRemainingElement.innerText);
            let decreseBtn = document.querySelector(`.item-quantity[data-cart-id="${cartId}"] .quantity-btn:first-child`);
            let increaseBtn = document.querySelector(`.item-quantity[data-cart-id="${cartId}"] .quantity-btn:last-child`);

            // FIXED: Check remaining stock BEFORE updating quantity
            if (action === 'increase' && itemsRemaining <= 0) {
                alert("Cannot add more items. Stock limit reached.");
                return; // Stop execution if no stock remaining
            }

            let newQuantity = currentQuantity;
            if (action === 'increase') {
                newQuantity += 1;
                itemsRemainingElement.innerText = itemsRemaining - 1;
            } else if (action === 'decrease' && currentQuantity > 1) {
                newQuantity -= 1;
                itemsRemainingElement.innerText = itemsRemaining + 1;
            }

            // Update button states
            if (newQuantity <= 1) {
                decreseBtn.disabled = true;
                decreseBtn.style.opacity = "0.5";
                decreseBtn.style.cursor = "not-allowed";
            } else {
                decreseBtn.disabled = false;
                decreseBtn.style.opacity = "1";
                decreseBtn.style.cursor = "pointer";
            }

            // FIXED: Check the NEW remaining items value
            let newRemainingItems = parseInt(itemsRemainingElement.innerText);
            if (newRemainingItems <= 0) {
                increaseBtn.disabled = true;
                increaseBtn.style.opacity = "0.5";
                increaseBtn.style.cursor = "not-allowed";
            } else {
                increaseBtn.disabled = false;
                increaseBtn.style.opacity = "1";
                increaseBtn.style.cursor = "pointer";
            }

            quantityElement.innerText = newQuantity;

            fetch("{{ route('cart.updateQuantity') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        id: cartId,
                        quantity: newQuantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Recalculate the subtotal and total
                        let subtotal = 0;

                        document.querySelectorAll('.cart-item').forEach(item => {
                            let itemQuantity = parseInt(item.querySelector('.quantity-value').innerText);
                            let unitPrice = parseFloat(item.querySelector('.item-price').dataset.unitPrice);
                            subtotal += itemQuantity * unitPrice;
                        });

                        // Update individual item price display
                        let currentItem = document.querySelector(`.item-price[data-cart-id="${cartId}"]`);
                        let unitPrice = parseFloat(currentItem.dataset.unitPrice);
                        currentItem.innerText =
                            `LKR ${(unitPrice * newQuantity).toLocaleString('en-US', { minimumFractionDigits: 2 })}`;

                        // Update subtotal and total in the DOM
                        document.querySelector('.summary-value').innerText =
                            `LKR ${subtotal.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
                        const deliveryCharges = 0;
                        let total = subtotal + deliveryCharges;
                        document.querySelector('.total-value').innerText =
                            `LKR ${total.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
                    } else {
                        alert(data.message || 'Failed to update quantity.');
                        // Revert UI changes
                        quantityElement.innerText = currentQuantity;
                        itemsRemainingElement.innerText = itemsRemaining;

                        // Re-enable/disable buttons based on original values
                        if (currentQuantity <= 1) {
                            decreseBtn.disabled = true;
                            decreseBtn.style.opacity = "0.5";
                            decreseBtn.style.cursor = "not-allowed";
                        } else {
                            decreseBtn.disabled = false;
                            decreseBtn.style.opacity = "1";
                            decreseBtn.style.cursor = "pointer";
                        }

                        if (itemsRemaining <= 0) {
                            increaseBtn.disabled = true;
                            increaseBtn.style.opacity = "0.5";
                            increaseBtn.style.cursor = "not-allowed";
                        } else {
                            increaseBtn.disabled = false;
                            increaseBtn.style.opacity = "1";
                            increaseBtn.style.cursor = "pointer";
                        }
                    }
                })
                .catch(error => {
                    console.error('Error updating quantity:', error);

                    quantityElement.innerText = currentQuantity;
                    itemsRemainingElement.innerText = itemsRemaining;
                });
        }
        kj
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>