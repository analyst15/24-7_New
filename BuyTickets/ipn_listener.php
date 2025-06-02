<?php
require_once 'db.php'; // Your DB connection

$xml = file_get_contents("php://input");
if (!$xml) {
    http_response_code(400);
    exit("No XML received");
}

$ipn = simplexml_load_string($xml);
if (!$ipn || $ipn->Result != "000") {
    http_response_code(400);
    exit("Invalid or unsuccessful IPN");
}

// Update payment status in your DB
$transactionRef = $ipn->Transaction->CompanyRef;
$status = "Paid";

$stmt = $pdo->prepare("UPDATE checkout_requests SET payment_status = :status WHERE transaction_ref = :ref");
$stmt->execute([
    ':status' => $status,
    ':ref' => $transactionRef
]);

http_response_code(200);
echo "IPN processed";
