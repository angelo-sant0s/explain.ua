<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="0;url=pages/index.html">
    <title>SB Admin 2</title>
    <script language="javascript">
        window.location.href = "pages/index.php"
    </script>
</head>
<body>
<?php

  require_once "connections/connection.php";
  $link = new_db_connection();

  ?>
Go to <a href="pages/index.php">/pages/index.html</a>
</body>
</html>
