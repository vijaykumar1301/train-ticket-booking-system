<?php
// Include the config file
require_once 'config.php';

// Include the Razorpay SDK
require 'vendor/autoload.php';
use Razorpay\Api\Api;

// Initialize Razorpay API
$api = new Api(RAZORPAY_API_KEY, RAZORPAY_API_SECRET);

// Check if the payment was successful
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify the payment using Razorpay API
    $paymentId = $_POST['razorpay_payment_id'];

    try {
        $payment = $api->payment->fetch($paymentId);
        // You can perform additional verification and processing here
    } catch (\Exception $e) {
        // Handle the exception, e.g., log the error or redirect to an error page
        header('Location: error.php');
        exit();
    }
} else {
    // Redirect to the home page if accessed directly without a valid payment
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
</head>
<body>

    <h1>Payment Successful</h1>

    <p>Thank you for your purchase. Your payment was successful.</p>

    <!-- Display order details or any other relevant information -->
    <p>Order ID: <?php echo $payment->order_id; ?></p>
    <p>Amount: <?php echo $payment->amount / 100; ?> INR</p>
    <!-- Additional details... -->

    <!-- You may also want to provide a link to the user's account or a confirmation page -->
    <p><a href="index.php">Back to Home</a></p>

</body>
</html>
