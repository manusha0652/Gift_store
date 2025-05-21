<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to PayHere...</title>
</head>
<body>
 
    <p>Redirecting to PayHere payment gateway. Please wait...</p>
    
    <form id="payhere-form" method="post" action="https://sandbox.payhere.lk/pay/checkout">
        <input type="hidden" name="merchant_id" value="{{ $data['merchant_id'] }}">
        <input type="hidden" name="return_url" value="{{ $data['return_url'] }}">
        <input type="hidden" name="cancel_url" value="{{ $data['cancel_url'] }}">
        <input type="hidden" name="notify_url" value="{{ $data['notify_url'] }}">
        <input type="hidden" name="order_id" value="{{ $data['order_id'] }}">
        <input type="hidden" name="items" value="{{ $data['items'] }}">
        <input type="hidden" name="amount" value="{{ $data['amount'] }}">
        <input type="hidden" name="currency" value="{{ $data['currency'] }}">
        <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
        <input type="hidden" name="last_name" value="Unknown">
        <input type="hidden" name="email" value="{{ $data['email'] }}">
        <input type="hidden" name="phone" value="{{ $data['phone'] }}">
        <input type="hidden" name="address" value="{{ $data['address'] }}">
        <input type="hidden" name="city" value="{{ $data['city'] }}">
        <input type="hidden" name="country" value="{{ $data['country'] }}">
        <input type="hidden" name="hash" value="{{ $hash }}">
    </form>
   
    <script>
        document.getElementById('payhere-form').submit();
    </script>
</body>
</html>
