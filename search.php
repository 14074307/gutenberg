<?php
  require_once 'header.php';

  $current_user = $_SESSION['user'];

  $book_title = $book_author = $book_subject = "";
  $error = "";

  if (isset($_POST['book_title']))
    $book_title = sanitizeString($_POST['book_title']);
  if (isset($_POST['book_author']))
    $book_author = sanitizeString($_POST['book_author']);
  if (isset($_POST['book_subject']))
    $book_subject = sanitizeString($_POST['book_subject']);

  if ($book_title == "" && $book_author == "" && $book_subject == "")
    $error = 'You must enter at least one field.';
  else {
    $result = queryMySQL("SELECT title,author,subject FROM books
                          WHERE title='$book_title' OR author='$book_author' OR subject='$book_subject'");
    if ($result->num_rows == 0)
      $error = "No book found.";
    else {
      $_SESSION['book_title'] = $book_title;
      $_SESSION['book_author'] = $book_author;
      $_SESSION['book_subject'] = $book_subject;
      die("One book found.
          <a data-transition='slide' href='book_profile.php?view=$current_user'>See the result.</a>
          </div></body></html>");
    }
  }

echo <<<_END
        <form method='post' action='search.php'>
          <div data-role='fieldcontain'>
            <label></label>
            Search books by any of these fields:
          </div>
          <div data-role='fieldcontain'>
            <label>Title</label>
            <input type='text' maxlength='100' name='book_title' value='$book_title'>
            </div>
          <div data-role='fieldcontain'>
            <label>author</label>
            <input type='text' maxlength='100' name='book_author' value='$book_author'>
          </div>
          <div data-role='fieldcontain'>
            <label>subject</label>
            <input type='text' maxlength='100' name='book_subject' value='$book_subject'>
          </div>
          <div data-role='fieldcontain'>
            <label></label>
            <input data-transition='slide' type='submit' value='Search'>
          </div>
        </form>
      </div>
    </body>
  </html>
_END;

?>
