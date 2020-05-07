<?php
  //import modules from the header
  require_once 'header.php';

  if (!$loggedin) die("</div></body></html>");  //guest can't view members
  if (isset($_GET['view'])) {
    $view = sanitizeString($_GET['view']);

    if ($view == $user) $name = "Your";
    else $name = "$view's";

    echo "<h3>$name Profile</h3>";
    showProfile($view);
    showReviews($view);
    die("</div></body></html>");
  }

  //retrieve other users from the database
  $result = queryMysql("SELECT user FROM members ORDER BY user");
  $num = $result->num_rows;

  echo "<h3>Other Members</h3><ul>";

  for ($j = 0 ; $j < $num ; ++$j) {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['user'] == $user) continue;
    echo "<li><a data-transition='slide' href='members.php?view=" .
    $row['user'] . "'>" . $row['user'] . "</a>";
  }
?>
    </ul></div>
  </body>
</html>
