<?php
  //import modules from the header
  require_once 'header.php';

  //retrieve profile from the databse
  if (!$loggedin) die("</div></body></html>");
    echo "<h3>Your Profile</h3>";
  $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");


  if (isset($_POST['text'])) {        //update profile to the database
    $text = sanitizeString($_POST['text']);
    $text = preg_replace('/\s\s+/', ' ', $text);
    if ($result->num_rows)
      queryMysql("UPDATE profiles SET text='$text' where user='$user'");
    else queryMysql("INSERT INTO profiles VALUES('$user', '$text')");
  }
  else {
    if ($result->num_rows) {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      $text = stripslashes($row['text']);
    }
    else $text = "";
  }

  //to prevent injections
  $text = stripslashes(preg_replace('/\s\s+/', ' ', $text));

  showProfile($user);

echo <<<_END
      <form data-ajax='false' method='post' action='profile.php' enctype='multipart/form-data'>
        <h3>Introduce yourself:</h3>
        <textarea name='text'>$text</textarea><br>
        <input type='submit' value='Save Profile'>
      </form>
    </div><br>
  </body>
</html>
_END;
