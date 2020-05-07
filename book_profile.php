<?php
  //import modules from the header
  require_once 'header.php';

  $book_title = $_SESSION['book_title'];
  $book_author = $_SESSION['book_author'];
  $book_subject = $_SESSION['book_subject'];
  $book_result = queryMySQL("SELECT title,author,subject FROM books
                        WHERE title='$book_title' OR author='$book_author' OR subject='$book_subject'");
  $book_row = $book_result->fetch_assoc();
  $book_title = $book_row["title"];
  $book_author = $book_row["author"];
  $book_subject = $book_row["subject"];
  echo "<h3>Book Info</h3><br>".
       "<div style=\"background-color:Beige; border-style:ridge; border-color:Cornsilk; padding:15px;\">" .
       "<i><b>" . $book_title . "</b></i><br>" .
       "by " . "<i><b>" . $book_author . "</b></i><br>" .
       "(" . $book_subject . ")<br>" . "</div>";

  $book_review_result = queryMySQL("SELECT user,text FROM reviews
                        WHERE title='$book_title'");
  $review_num = 1;
  if ($book_review_result->num_rows) {
    while ($row = $book_review_result->fetch_assoc())
      echo "<br><br>" . "<h3>Review " . $review_num++ . " by " .
           "<a data-transition='slide' href='members.php?view=" .
           $row['user'] . "'>" . $row['user'] . "</a></h3>" .
           "<div style=\"background-color:Azure; border-style:ridge; border-color:Cornsilk; padding:15px;\">" .
           $row["text"] . "</div>";
  }

  if (isset($_POST['text'])) {        //update review to the database
    $text = $_POST['text'];
    $review_id = generateNewID(9);
    $user_str = sanitizeString($_SESSION['user']);
    queryMysql("INSERT INTO reviews VALUES('$user_str', '$book_title', '$text', '$review_id')");
    die("<br><br><br>One review submitted.
         <a data-transition='slide' href='book_profile.php?view=$current_user'>Click to confirm.</a>
         </div></body></html>");
  }

echo <<<_END
      <form data-ajax='false' method='post' action='book_profile.php' enctype='multipart/form-data'>
        <br><br><h3>Add you review here!</h3>
        <textarea name='text'></textarea><br>
        <input type='submit' value='Submit book review'>
      </form>
    </div><br>
  </body>
</html>
_END;
