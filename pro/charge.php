<?php
$success = true;

if (isset($_POST['razorpay_payment_id'])) {
    $paymentId = $_POST['razorpay_payment_id'];
    // Verify the payment using Razorpay API
    try {
        $payment = $api->payment->fetch($paymentId);
    } catch (\Exception $e) {
        $success = false;
    }

    if ($success) {
        // Payment successful, perform necessary actions
        echo "Payment successful. Payment ID: " . $paymentId;
    } else {
        echo "Payment failed.";
    }
}
