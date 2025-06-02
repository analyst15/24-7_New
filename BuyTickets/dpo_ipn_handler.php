<?php
// dpo_ipn_handler.php

// Read POST data from DPO
$data = file_get_contents("php://input");
$xml = simplexml_load_string($data);

if (!$xml || $xml->Result != '000') {
    // Invalid or failed transaction
    http_response_code(400);
    exit('Invalid IPN');
}

// Extract transaction details
$transactionRef = (string) $xml->TransactionToken;
$paymentStatus  = (string) $xml->Result;
$paymentAmount  = (string) $xml->PaymentAmount;
$currency       = (string) $xml->PaymentCurrency;
$paidOn         = date('Y-m-d H:i:s');

// Connect to DB
require_once 'db.php';

// Update the record as paid
$stmt = $pdo->prepare("UPDATE checkout_requests SET paid = 1, paid_at = ? WHERE transaction_ref = ?");
$stmt->execute([$paidOn, $transactionRef]);

http_response_code(200); // Acknowledge
echo "OK";
?>
