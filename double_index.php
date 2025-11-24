<?php

session_start();
if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 10000;
}


if (!isset($_COOKIE['csrf_token'])) {
    $token = bin2hex(random_bytes(32));
    setcookie('csrf_token', $token, 0, '/', '', false, false); 
} else {
    $token = $_COOKIE['csrf_token'];
}
$balance = $_SESSION['balance'];
?>
<!doctype html>
<html>
<head>
    <title>Bank (Double-Submit Cookie)</title></head>
<body>
  <h1>Bank (Double-Submit Cookie)</h1>
  <p>Balance: <strong>$<?php echo htmlentities($balance); ?></strong></p>

  <h2>Transfer money</h2>
  
  <form method="post" action="double_process_transfer.php" id="transferForm">
    <input type="hidden" name="csrf_token" id="csrf_token">
    <label>Recipient account: <input type="text" name="account" value="attacker" required></label><br>
    <label>Amount: <input type="number" name="amount" value="100" required></label><br>
    <button type="submit">Transfer</button>
  </form>

  <script>
    
    function getCookie(name) {
      const value = `; ${document.cookie}`;
      const parts = value.split(`; ${name}=`);
      if (parts.length === 2) return parts.pop().split(';').shift();
    }
    document.getElementById('csrf_token').value = getCookie('csrf_token') || '';
  </script>

  <p><em>Double-submit cookie: cookie + form field must match on server.</em></p>
</body>
</html>
