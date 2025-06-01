<?php
require_once 'db.php'; // Database connection

// Handle optional search term
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$sql = "SELECT * FROM checkout_requests";
$params = [];

if (!empty($searchTerm)) {
    $sql .= " WHERE 
        first_name LIKE :search OR 
        last_name LIKE :search OR 
        email LIKE :search OR 
        transaction_ref LIKE :search OR 
        amount LIKE :search";
    $params[':search'] = '%' . $searchTerm . '%';
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Set CSV headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="checkout_requests.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// Output CSV column headers
fputcsv($output, ['ID', 'Transaction Ref', 'First Name', 'Last Name', 'Email', 'Amount', 'Currency', 'Phone', 'City', 'Country', 'Date']);

// Output each row
foreach ($requests as $row) {
    fputcsv($output, [
        $row['id'],
        $row['transaction_ref'],
        $row['first_name'],
        $row['last_name'],
        $row['email'],
        $row['amount'],
        $row['currency'],
        $row['phone'],
        $row['city'],
        $row['country'],
        $row['created_at'],
    ]);
}

fclose($output);
exit;
