<?php
session_start();
session_destroy();
header('Location: index.php'); // going to the main page
?>
