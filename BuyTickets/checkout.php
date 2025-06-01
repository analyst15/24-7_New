<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <script>
    // Auto-fill country code and city
    window.onload = function () {
      fetch("https://ipapi.co/json/")
        .then(response => response.json())
        .then(data => {
          if (data) {
            if (data.country_calling_code) {
              document.getElementById("country_code").value = data.country_calling_code;
            }
            if (data.city) {
              document.getElementById("city").value = data.city;
            }
if (data.country_code) {
  document.getElementById("country").value = data.country_code; // e.g. "KE"
}

          }
        })
        .catch(error => console.warn("Geo IP failed:", error));
    };
  </script>
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <h2 class="mb-4 text-center">Checkout</h2>

      <form action="process_payment.php" method="post" class="card p-4 shadow-sm bg-white">

        <!-- Select Item -->
        <div class="mb-3">
          <label for="amount" class="form-label">Select Item</label>
          <select name="amount" id="amount" class="form-select" required>
            <optgroup label="Tickets (KES)">
              <option value="10000">Group of 5 Ticket - KES 10,000</option>
              <option value="50000">Corporate Ticket - KES 50,000</option>
              <option value="100000">Exhibition/Vendor - KES 100,000</option>
              <option value="200000">Brand Activation - KES 200,000</option>
            </optgroup>
            <optgroup label="Sponsorships (USD)">
              <option value="100000">Title Sponsorship - $100,000</option>
              <option value="50000">Presenting Sponsorship - $50,000</option>
              <option value="40000">Partnering Sponsorship - $40,000</option>
              <option value="30000">Associate Sponsorship - $30,000</option>
              <option value="20000">Supporting Sponsorship - $20,000</option>
            </optgroup>
          </select>
        </div>

        <!-- Name -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
          </div>
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <!-- Country -->
        <div class="mb-3">
          <label for="country" class="form-label">Country</label>
          <input type="text" name="country" id="country" class="form-control" required>
        </div>

        <!-- Country Code + Phone -->
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="country_code" class="form-label">Country Code</label>
            <input type="text" name="country_code" id="country_code" class="form-control" placeholder="+254" required>
          </div>
          <div class="col-md-8 mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" name="phone" id="phone" class="form-control" required>
          </div>
        </div>

        <!-- City -->
        <div class="mb-3">
          <label for="city" class="form-label">City</label>
          <input type="text" name="city" id="city" class="form-control" required>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-100">Proceed to Payment</button>

      </form>
    </div>
  </div>
</div>

</body>
</html>
