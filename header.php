<?php //
  session_start();

  //import all the required modules
echo <<<_INIT
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset='utf-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
      <link rel='stylesheet' href='style.css'>
      <script src='javascript_functions.js'></script>
      <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
      <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

_INIT;

  //import the library of functions
  require_once 'functions.php';

  //check if logged in
  if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $loggedin = TRUE;
  }
  else $loggedin = FALSE;

echo <<<_MAIN
      <title>Gutenberg Club: Welcome</title>
    </head>
    <body>
      <div data-role='page'>
        <div data-role='header'>
          <div id='logo' class='center'><img id='gutenberg' src='gutenberg.png'></div>
        </div>
        <div data-role='content'>

_MAIN;

    //print the elements for a logged-in user
    if ($loggedin) {
echo <<<_LOGGEDIN
      <div class='center'>
        <a data-role='button' data-inline='true' data-icon='home'
          data-transition="slide" href='members.php?view=$user'>Home</a>
        <a data-role='button' data-inline='true'
          data-transition="slide" href='members.php'>Memebrs</a>
        <a data-role='button' data-inline='true'
          data-transition="slide" href='profile.php'>Edit Profiles</a>
        <a data-role='button' data-inline='true'
          data-transition="slide" href='search.php'>Search Books</a>
        <a data-role='button' data-inline='true'
          data-transition="slide" href='logout.php'>Log out</a>
      </div>

_LOGGEDIN;

    //print the elements for a guest
    } else {
echo <<<_GUEST
      <div class='center'>
        <a data-role='button' data-inline='true' data-icon='home'
          data-transition="slide" href='index.php'>Home</a>
        <a data-role='button' data-inline='true' data-icon='plus'
          data-transition="slide" href='signup.php'>Sign Up</a>
        <a data-role='button' data-inline='true' data-icon='check'
          data-transition="slide" href='login.php'>Log In</a>
      </div>

_GUEST;
    }
?>
