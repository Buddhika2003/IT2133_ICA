<?php

session_start();
if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 10000;
}


if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['csrf_token'];
$balance = $_SESSION['balance'];
?>
<!doctype html>
<html>
<head>
    <title>Bank (Fixed - Synchronizer Token)</title>
</head>
<body>
  <h1>Bank (Fixed - Synchronizer Token)</h1>
  <p>Balance: <strong>$<?php echo htmlentities($balance); ?></strong></p>

  <h2>Transfer money</h2>
  <form method="post" action="fixed_process_transfer.php">
    <input type="hidden" name="csrf_token" value="<?php echo htmlentities($token); ?>">
    <label>Recipient account: <input type="text" name="account" value="attacker" required></label><br>
    <label>Amount: <input type="number" name="amount" value="100" required></label><br>
    <button type="submit">Transfer</button>
  </form>

  <p><em>Server checks the CSRF token in the session before doing the transfer.</em></p>
</body>
</html>
