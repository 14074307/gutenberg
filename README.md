# gutenberg
My repository of the web app Gutenberg Club.

This is an social-networking web app mostly for learning purposes. 
In it, you can sign up for an account, customize your profile, search for about one tenth of the books in gutenberg.org, 
review those books, read other people's reviews, and browse other users' all past book reviews.

Setup for local use:
1. Download, unzip and put the unzipped gutenberg-master folder in your local document root.
2. In your MySQL server, create a database called gutenberg_club, a user called gutenberg_user with password gutenberg, 
   and grant all rights to gutenberg_club to gutenberg_user.
3. Run localhost/gutenberg-master/setup.php in your favourite browser and wait for around five minutes.
4. Run localhost/gutenberg-master/index.php to start using the app.
