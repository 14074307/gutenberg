<!DOCTYPE HTML>
<html>
  <head>
    <title>Setup the database</title>
  </head>
  <body>

<?php
  //import the library of functions
  require_once 'functions.php';

  createTable('books',
              'title VARCHAR(500),
              author VARCHAR(500),
              subject VARCHAR(500),
              INDEX(author(100))');

  //create table to store members
  createTable('members',
              'user VARCHAR(16),
              pass VARCHAR(16),
              INDEX(user(6))');

  //create table to store user profiles
  createTable('profiles',
              'user VARCHAR(16),
              text VARCHAR(4096),
              INDEX(user(6))');

  createTable('reviews',
              'user VARCHAR(16),
              title VARCHAR(500),
              text VARCHAR(5000),
              id CHAR(9),
              INDEX(id(9))');

  readBooks();

?>

    The database has been set up.
    About one tenth of the book titles from <a href="http://www.gutenberg.org/">gutenberg</a> could now be searched.
  </body>
</html>
