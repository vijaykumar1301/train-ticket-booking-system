<?php
// Include the config file
require_once 'config.php';

// Include the Razorpay SDK
require 'vendor/autoload.php';
use Razorpay\Api\Api;

// Initialize Razorpay API
$api = new Api(RAZORPAY_API_KEY, RAZORPAY_API_SECRET);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // You should perform additional validation and processing here

    // Create a Razorpay order
    $order = $api->order->create([
        'amount' => 1000, // Amount in paise (100 paise = 1 INR)
        'currency' => 'INR',
        'receipt' => 'order_receipt_' . time(),
    ]);

    $orderId = $order->id;
} else {
    // Redirect to the checkout page if accessed directly without a valid order
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Include the Razorpay checkout.js script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

    <h1>Checkout Page</h1>

    <!-- Display order details and payment form -->
    <p>Total Amount: ₹10.00</p>

    <form action="charge.php" method="POST">
        <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">

        <!-- Razorpay Checkout Button -->
        <script
            src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="<?php echo RAZORPAY_API_KEY; ?>"
            data-amount="1000"
            data-currency="INR"
            data-order_id="<?php echo $orderId; ?>"
            data-buttontext="Pay with Razorpay"
            data-name="Your Company Name"
            data-description="Payment for Order #<?php echo $orderId; ?>"
            data-image="your_logo_url"
            data-prefill.name="customer_name"
            data-prefill.email="customer_email@example.com"
            data-theme.color="#F37254"
        ></script>
        <input type="hidden" custom="Hidden Element" name="hidden">
    </form>

</body>
</html>
