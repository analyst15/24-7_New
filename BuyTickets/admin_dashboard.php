<?php

session_start();
require_once 'db.php'; // include your DB connection

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: admin_login.php');
    exit;
}
// Get summary statistics
$totalQuery = $pdo->query("SELECT COUNT(*) as total, SUM(CASE WHEN currency = 'KES' THEN amount ELSE 0 END) as total_kes, SUM(CASE WHEN currency = 'USD' THEN amount ELSE 0 END) as total_usd FROM checkout_requests");
$summary = $totalQuery->fetch(PDO::FETCH_ASSOC);




// --- Handle search query ---
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// --- Pagination settings ---
$records_per_page = 10;
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($current_page - 1) * $records_per_page;

// --- Build SQL ---
$sql = "SELECT * FROM checkout_requests";
$countSql = "SELECT COUNT(*) FROM checkout_requests";
$params = [];

if (!empty($searchTerm)) {
    $sql .= " WHERE 
        first_name LIKE :search OR 
        last_name LIKE :search OR 
        email LIKE :search OR 
        transaction_ref LIKE :search OR 
        amount LIKE :search";
    $countSql .= " WHERE 
        first_name LIKE :search OR 
        last_name LIKE :search OR 
        email LIKE :search OR 
        transaction_ref LIKE :search OR 
        amount LIKE :search";
    $params[':search'] = '%' . $searchTerm . '%';
}

$sql .= " ORDER BY id ASC LIMIT :limit OFFSET :offset";

// Prepare and bind limit/offset safely
$stmt = $pdo->prepare($sql);
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count total records
$countStmt = $pdo->prepare($countSql);
if (!empty($searchTerm)) {
    $countStmt->bindValue(':search', '%' . $searchTerm . '%');
}
$countStmt->execute();
$total_rows = $countStmt->fetchColumn();
$total_pages = ceil($total_rows / $records_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Checkout Requests</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2 class="mb-4">Checkout Requests</h2>
  <div class="d-flex justify-content-between mb-3">
    <h4>Welcome, Admin</h4>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
<div class="row mb-4">
  <div class="col-md-4">
    <div class="card text-white bg-primary mb-3">
      <div class="card-body">
        <h5 class="card-title">Total Transactions</h5>
        <p class="card-text fs-4"><?= $summary['total'] ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card text-white bg-success mb-3">
      <div class="card-body">
        <h5 class="card-title">Revenue (KES)</h5>
        <p class="card-text fs-4">KES <?= number_format($summary['total_kes']) ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card text-white bg-info mb-3">
      <div class="card-body">
        <h5 class="card-title">Revenue (USD)</h5>
        <p class="card-text fs-4">$<?= number_format($summary['total_usd']) ?></p>
      </div>
    </div>
  </div>
</div>


  
  <div class="d-flex justify-content-between mb-3">
      <!-- Export CSV button -->
  <a href="export_csv.php<?= !empty($searchTerm) ? '?search=' . urlencode($searchTerm) : '' ?>" class="btn btn-success">
    Export to CSV
  </a>
  <!-- Search Form -->
    <form method="GET" action="admin_dashboard.php" class="d-flex" role="search">
        <input type="text" name="search" class="form-control me-2" placeholder="Search..." value="<?= htmlspecialchars($searchTerm) ?>">
        <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>
  </div>

  <!-- Records Table -->
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Transaction Ref</th>
        <th>Name</th>
        <th>Email</th>
        <th>Amount</th>
        <th>Currency</th>
        <th>Phone</th>
        <th>City</th>
        <th>Country</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($requests) > 0): ?>
        <?php foreach ($requests as $row): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['transaction_ref'] ?></td>
            <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= $row['amount'] ?></td>
            <td><?= $row['currency'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= htmlspecialchars($row['city']) ?></td>
            <td><?= htmlspecialchars($row['country']) ?></td>
            <td><?= $row['created_at'] ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="10" class="text-center">No records found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <!-- Pagination Links -->
  <?php if ($total_pages > 1): ?>
    <nav>
      <ul class="pagination justify-content-center">
        <?php if ($current_page > 1): ?>
          <li class="page-item">
            <a class="page-link" href="?page=<?= $current_page - 1 ?>&search=<?= urlencode($searchTerm) ?>">&laquo; Prev</a>
          </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($searchTerm) ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
          <li class="page-item">
            <a class="page-link" href="?page=<?= $current_page + 1 ?>&search=<?= urlencode($searchTerm) ?>">Next &raquo;</a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  <?php endif; ?>
</div>
</body>
</html>
