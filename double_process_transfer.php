<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

$posted_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
$cookie_token = isset($_COOKIE['csrf_token']) ? $_COOKIE['csrf_token'] : '';

if (empty($posted_token) || empty($cookie_token) || !hash_equals($cookie_token, $posted_token)) {
    http_response_code(403);
    exit('CSRF token missing or mismatch');
}

$account = isset($_POST['account']) ? trim($_POST['account']) : '';
$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;

if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 10000;
}

if ($amount <= 0) {
    exit('Invalid amount');
}

if ($amount > $_SESSION['balance']) {
    exit('Insufficient funds');
}

$_SESSION['balance'] -= $amount;
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="style.css">

    <title>Transfer Done (Double-Submit)</title>
</head>
<body>
  <h1>Transfer Complete (Double-Submit)</h1>
  <p>Sent $<?php echo htmlentities($amount); ?> to <?php echo htmlentities($account); ?>.</p>
  <p><a href="double_index.php">Back to account</a></p>
</body>
</html>
