<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css" />
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid #ccd0d2;
            border-radius: 4px;
            background-color: white;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Stripe Payment (v3)</h2>

    <form id="payment-form">
        <div id="card-element"></div>
        <button class="btn btn-primary">Pay Now</button>
    </form>

    <div id="payment-result" class="mt-3"></div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();
    const card = elements.create('card', { hidePostalCode: true });

    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: card,
        });

        if (error) {
            document.getElementById('payment-result').innerText = error.message;
        } else {
            fetch("{{ route('stripe.post') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ payment_method: paymentMethod.id })
            }).then(res => res.json())
              .then(data => {
                  if (data.success) {
                      document.getElementById('payment-result').innerText = "Payment successful!";
                  } else {
                      document.getElementById('payment-result').innerText = "Payment failed!";
                  }
              });
        }
    });
</script>
</body>
</html>
