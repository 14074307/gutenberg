<?php
  require_once 'header.php';
  if (isset($_SESSION['user'])) {
    destroySession();
    echo "<br><div class='center'>You are logged out.
    <a data-transition='slide' href='index.php'>Click here</a>
    to refresh.</div>";
  }
  else
    echo "<div class='center'>You are not logged in yet</div>";
?>
    </div>
  </body>
</html>
