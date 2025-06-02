<?php
// ---------------- DB CONNECTION ----------------
$host = "localhost";
$db = "checkout";
$user = "root";
$pass = "";

// Connect to DB
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// ---------------- FORM DATA ----------------
$amount = $_POST['amount'];
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$country = $_POST['country'];
$countryCode = $_POST['country_code'];
$city = $_POST['city'];
$phone = preg_replace('/\D/', '', $_POST['phone']);
$fullPhone = $countryCode . $phone;
$currency = ($amount >= 10000 && $amount < 1000000) ? "KES" : "USD";
$transactionRef = uniqid("TXN_");

// ---------------- SAVE TO DATABASE ----------------
$stmt = $conn->prepare("INSERT INTO checkout_requests 
    (amount, currency, first_name, last_name, email, phone, country, city, transaction_ref) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("dssssssss", $amount, $currency, $firstName, $lastName, $email, $fullPhone, $country, $city, $transactionRef);

if (!$stmt->execute()) {
    die("Database Error: " . $stmt->error);
}
$stmt->close();

// ---------------- DPO CONFIG ----------------
$companyToken = "8D3DA73D-9D7F-4E09-96D4-3D44E7A83EA3"; // Test account
$serviceType = "69836"; // or "86280"
$serviceDescription = "Flight";
$serviceDate = date('Y-m-d');

// ---------------- DPO XML REQUEST ----------------
$xml = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<API3G>
    <CompanyToken>{$companyToken}</CompanyToken>
    <Request>createToken</Request>
    <Transaction>
        <PaymentAmount>{$amount}</PaymentAmount>
        <PaymentCurrency>{$currency}</PaymentCurrency>
        <CompanyRef>{$transactionRef}</CompanyRef>
        <RedirectURL>https://24-7.co.ke/BuyTickets/payment_success.php</RedirectURL>
        <BackURL>https://24-7.co.ke/BuyTickets/payment-cancelled.php</BackURL>
        <CallbackURL>https://yourdomain.com/BuyTickets/dpo_ipn_handler.php</CallbackURL>
        <CompanyRefUnique>0</CompanyRefUnique>
        <PTL>15</PTL>
        <customerFirstName>{$firstName}</customerFirstName>
        <customerLastName>{$lastName}</customerLastName>
        <customerEmail>{$email}</customerEmail>
        <customerPhone>{$fullPhone}</customerPhone>
        <customerCity>{$city}</customerCity>
        <customerCountry>{$country}</customerCountry>
    </Transaction>
    <Services>
        <Service>
            <ServiceType>{$serviceType}</ServiceType>
            <ServiceDescription>{$serviceDescription}</ServiceDescription>
            <ServiceDate>{$serviceDate}</ServiceDate>
        </Service>
    </Services>
</API3G>
XML;

// ---------------- SEND TO DPO ----------------
$ch = curl_init('https://secure.3gdirectpay.com/API/v6/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/xml']);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

if (!$response) {
    die("DPO Connection failed.");
}

$xmlResponse = simplexml_load_string($response);
if ($xmlResponse->Result != '000') {
    die("DPO Error: " . $xmlResponse->ResultExplanation);
}

// ---------------- REDIRECT TO PAYMENT ----------------
$token = $xmlResponse->TransToken;
$paymentURL = "https://secure.3gdirectpay.com/payv3.php?ID=" . $token;

header("Location: " . $paymentURL);
exit;
?>
