<?php
  $dbhost = 'localhost';             //access database via localhost
  $dbname = 'gutenberg_club';        //database of site users
  $dbuser = 'gutenberg_user';        //mysql user for the db
  $dbpass = 'gutenberg';             //mysql password for the db

  //set up the connection
  $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($connection->connect_error) die("Fatal Error");

  //create table to store info of a user
  function createTable($name, $query) {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
  }

  //query the database
  function queryMysql($query) {
    global $connection;
    $result = $connection->query($query);
    //if (!$result) die("Fatal Error");
    return $result;
  }

  //security function to prevent javascript-mysql injections
  function sanitizeString($var) {
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if (get_magic_quotes_gpc())
      $var = stripslashes($var);
    return $connection->real_escape_string($var);
  }

  //destroy session to log user out
  function destroySession() {
      $_SESSION=array();
      if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');
      session_destroy();
  }

  //show profile of site user
  function showProfile($user) {
    echo "<div style=\"background-color:Beige; border-style:ridge; border-color:Cornsilk; padding:15px;\">";
    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
    if ($result->num_rows) {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
    }
    else echo "<p>No User Profile yet</p><br>";
    echo "</div>";
  }

  function showReviews($user) {
    $review_result = queryMysql("SELECT title,text FROM reviews WHERE user='$user'");
    if ($review_result->num_rows) {
      echo "<h3>Past book reviews:</h3>";
      while ($review_row = $review_result->fetch_assoc()) {
        echo "<div style=\"background-color:Azure; border-style:ridge; border-color:Cornsilk; padding:15px;\">Review of " .
              $review_row["title"] . "<br>" .
              $review_row["text"] . "</div><br>";
      }
    }
    else echo "<p>No book reviews yet</p><br>";
  }

  function readBooks() {
    $books = [];
    $handle = fopen("bulk_pg.ldj", "r");
    $i = 1;
    if ($handle) {
      while (($line = fgets($handle)) !== false) {
        if ($i++ % 2 == 0) {
          $book = json_decode($line, $assoc = TRUE);
          array_push($books, $book);
        }
      }
    }
    for ($i = 0; $i < 6000; $i++) {
      $title = $books[$i]['title'];
      $authors = "";
      for ($j = 0; $j < count($books[$i]['authors']); $j++) {
        $authors .= stripcslashes($books[$i]['authors'][$j]);
        $authors .= "; ";
      }
      $subjects = "";
      for ($k = 0; $k < count($books[$i]['subjects']); $k++) {
        $subjects .= stripcslashes($books[$i]['subjects'][$k]);
        $subjects .= "; ";
      }
      queryMysql("INSERT INTO books VALUES('$title', '$authors', '$subjects')");
    }
  }

  function generateNewID($length) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  }

?>
