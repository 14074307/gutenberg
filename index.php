<?php
  session_start();

  //import elements from the header
  require_once 'header.php';

  //welcome message
  echo "<br><br><div class='center'>Welcome to Gutenberg Club! ";

  //print according to logged-in status
  if ($loggedin) echo "Hi $user";
  else echo 'Please sign up / log in to use the site';

echo <<<_END
    </div><br>
    </div>
  </body>
</html>
_END;

?>
