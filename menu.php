<?php

echo '<div id = "header" class = "menu">'
 . '<div id = "menu" class = "menu_pages">'
 . '<ul id = "nav" class = "navlist">'
 . '<li class = "menu"><a href="index.php" id="index">דף הבית</a></li>'
 . '<li class = "menu"><a href="about.php" id="about">אודות</a></li>';
if (isset($_SESSION['registered'])) {
    echo '<li class = "menu"><a href="addDish.php" id="addDish">העלאת מנה</a></li>';
}
echo '<li class = "menu"><a href="contact.php" id="contact">צור קשר</a></li>';
if (!isset($_SESSION['registered'])) {
    echo '<li class = "menu"><a href="newUser.php" id="newUser">הירשם</a></li>';
}
if (isset($_SESSION['registered'])) {
    echo '<li class = "menu"><a href="myProfile.php" id="myProfile">כניסה לאזור האישי</a></li>';
}
echo '</ul>'
 . '</div>'
 . '</div>'
 . '<a href="index.php"><img src="media/logo.png" class = "logo" alt="ברוכים הבאים"></a>';
?>
