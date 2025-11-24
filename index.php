<?php

session_start();
if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 10000; 
}
$balance = $_SESSION['balance'];
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Vulnerable Bank</title>
</head>
<body>
  <h1>Vulnerable Bank (CSRF)</h1>
  <p>Balance: <strong>$<?php echo htmlentities($balance); ?></strong></p>

  <h2>Transfer money</h2>
  <form method="post" action="process_transfer.php">
    <label>Recipient account: <input type="text" name="account" value="attacker" required></label><br>
    <label>Amount: <input type="number" name="amount" value="100" required></label><br>
    <button type="submit">Transfer</button>
  </form>

  <p><em>Note: This form has <strong>no CSRF protection</strong>.</em></p>
</body>
</html>
