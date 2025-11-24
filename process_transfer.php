<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

$account = isset($_POST['account']) ? trim($_POST['account']) : '';
$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;

if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 1000;
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
<head><meta charset="utf-8"><title>Transfer Done</title></head>
<body>
  <h1>Transfer Complete</h1>
  <p>Sent $<?php echo htmlentities($amount); ?> to <?php echo htmlentities($account); ?>.</p>
  <p><a href="index.php">Back to account</a></p>
</body>
</html>
