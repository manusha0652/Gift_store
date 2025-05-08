<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .product-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 50px auto;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }

        .product-image-container {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            width: 400px;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image {
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
            transition: transform 0.3s ease;

        }

        .product-image:hover {
            transform: scale(1.03);
        }

        .new-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: #ff5722;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
        }

        .product-details {
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        .product-price {
            font-size: 24px;
            font-weight: 600;
            color: #ff5722;
            margin-bottom: 20px;
        }

        .product-description {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .quantity-label {
            margin-right: 15px;
            font-weight: 500;
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

        .quantity-value {
            margin: 0 15px;
            font-weight: 600;
            min-width: 20px;
            text-align: center;
        }

        .add-to-cart-btn {
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            width: 100%;
            max-width: 300px;
        }

        .add-to-cart-btn:hover {
            background-color: #e64a19;
        }

        .product-features {
            margin-top: 30px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .feature-icon {
            color: #ff5722;
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .product-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="product-container">
            <div class="product-image-container">
                <img src="{{ asset('product/'.$product->image) }}" alt="{{ $product->title }}" class="product-image">

                <span class="new-badge">NEW</span>

            </div>

            <div class="product-details">
                <h1 class="product-title">{{ $product->title }}</h1>
                <p class="product-price">LKR {{ number_format($product->price, 2) }}</p>
                <p class="product-description">{{ $product->description }}</p>

                <div class="quantity-control">
                    <span class="quantity-label">Quantity:</span>
                    <button class="quantity-btn" id="decrease-quantity">-</button>
                    <span class="quantity-value" id="quantity">1</span>
                    <button class="quantity-btn" id="increase-quantity">+</button>
                </div>

                <form action="{{ route('product.addToCartInProductDetail', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" id="quantity-input" value="1">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                </form>

                <div class="product-features">
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>Quality Guaranteed</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>Free Returns</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>Fast Delivery</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const decreaseBtn = document.getElementById('decrease-quantity');
            const increaseBtn = document.getElementById('increase-quantity');
            const quantityDisplay = document.getElementById('quantity');
            const quantityInput = document.getElementById('quantity-input');

            decreaseBtn.addEventListener('click', function() {
                let quantity = parseInt(quantityDisplay.textContent);
                if (quantity > 1) {
                    quantity--;
                    quantityDisplay.textContent = quantity;
                    quantityInput.value = quantity;
                }
            });

            increaseBtn.addEventListener('click', function() {
                let quantity = parseInt(quantityDisplay.textContent);
                quantity++;
                quantityDisplay.textContent = quantity;
                quantityInput.value = quantity;
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>