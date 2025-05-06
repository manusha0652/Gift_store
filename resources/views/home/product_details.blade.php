<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            max-width: 100%;
            border-radius: 10px;
        }
        .product-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .product-price {
            font-size: 1.5rem;
            color: #28a745;
            margin-bottom: 20px;
        }
        .product-description {
            font-size: 1rem;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="product-container">
            <img src="{{ asset('product/'.$product->image) }}" alt="{{ $product->name }}" class="product-image">
            <h1 class="product-title">{{ $product->title }}</h1>
            <p class="product-price">LKR {{ number_format($product->price, 2) }}</p>
            <p class="product-description">{{ $product->description }}</p>
            <a href="{{ route('product.addToCart', $product->id) }}" class="btn btn-primary">Add to Cart</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>