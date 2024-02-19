<form action="charge.php" method="POST">
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="<?php echo $api_key; ?>"
        data-amount="1000"
        data-currency="INR"
        data-order_id="<?php echo $orderId; ?>"
        data-buttontext="Pay with Razorpay"
        data-name="Your Company Name"
        data-description="Payment for Order #123"
        data-image="your_logo_url"
        data-prefill.name="customer_name"
        data-prefill.email="customer_email@example.com"
        data-theme.color="#F37254"
    ></script>
    <input type="hidden" custom="Hidden Element" name="hidden">
</form>
