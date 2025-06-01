<?php
// You can fetch details from the GET parameters if DPO returns any
// For now, we just display a static success message

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container text-center py-5">
        <div class="alert alert-success mt-5" role="alert">
            <h1 class="display-4">🎉 Payment Successful!</h1>
            <p class="lead">Thank you for your purchase. Your transaction has been completed.</p>
        </div>
        <a href="index.html" class="btn btn-primary mt-3">Return to Homepage</a>
    </div>
</body>
</html>
