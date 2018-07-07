users<!DOCTYPE html>
<?php session_start(); ?>
<!--דף פרטים אישיים של המשתמש-->
<html lang="he">
    <head>
        <?php
        #allowing Hebrew
        header("Content-type: text/html; charset=utf-8");
        $con = mysqli_connect("localhost", "root", "", "applepie");
        mysqli_set_charset($con, "utf8");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_set_charset($con, "utf8");
        ?>
        <title>הפרופיל שלי</title>
        <meta charset= "utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="PNG image (.png)" href="media/top2.png">
        <link href="Css/w3.css" rel="stylesheet" type="text/css"/>
        <link href="Css/style.php" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <script src="js/newJS.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $("#myProfile").addClass("highlite");
            });
        </script>
    </head>
    <body  dir="rtl">
        <?php require('menu.php'); ?>
        <?php require ('login.php'); ?>
        <?php $_SESSION['timeout'] = time(); ?>
        <div class="myProfileContainer">

            <?php

            if (isset($_SESSION['username'])) {
                $userMail = $_SESSION['email'];
                $mail = filter_var($userMail, FILTER_VALIDATE_EMAIL);

                $select_image="select Image from users where Email='$mail'";
                $var=mysqli_fetch_array(mysqli_query($con, $select_image));

                echo '<h2>שלום ' . $_SESSION['username'] . '</h2>';

                $passChange = false;
                $viewOrders = false;
                if (count($_POST) != 0) {
                    if (isset($_POST['changePassword'])) {
                        $passChange = true;
                        echo '<form class="w3-container" name="formNewUser"  method="post" action="' . $_SERVER["PHP_SELF"] . '">'
                        . '<table>'
                        . '<tr>'
                        . '<td>'
                        . '<label for="password">סיסמא ישנה: </label>'
                        . '<br>'
                        . '<input id="password" type="password" name="oldPassword" required>'
                        . '</td>'
                        . '</tr>'
                        . '<tr>'
                        . '<td>'
                        . '<label for="password">הכנס סיסמא חדשה: </label>'
                        . '<br>'
                        . '<input id="password" type="password" name="newPassword" minlength="6" required>'
                        . '</td>'
                        . '</tr>'
                        . '<tr>'
                        . '<td>'
                        . '<label for="password">הכנס סיסמא חדשה שנית: </label>'
                        . '<br>'
                        . '<input id="password" type="password" name="newPasswordAgain" minlength="6" required>'
                        . '</td>'
                        . '</tr>'
                        . '</table>'
                        . '<input class ="submit" name="confirmPassChange" type="submit"  value="אישור">'
                        . '</form>';
                    }
                    if (isset($_POST['viewOrders'])) {
                        mysqli_set_charset($con, "utf8");
                        $viewOrders = true;
                        $today = substr(date("Y-m-d"), 0, 10);
                        $nowTime = date("h:i:sa");
                        $usersorderssql = "SELECT oID, oDate, totalPrice, pickDate, pickTime FROM orders
                                WHERE oEmail ='" . $_SESSION['email'] . "' ORDER BY pickDate";
                        $usersorders = mysqli_query($con, $usersorderssql);

                        $row = mysqli_fetch_array($usersorders);
                        if ($row != null) {
                            echo '<form method="get" action="' . $_SERVER["PHP_SELF"] . '">'
                            . '<table style="width:50%">'
                            . '<tr>'
                            . '<td>'
                            . 'מספר הזמנה'
                            . '</td>'
                            . '<td>'
                            . 'תאריך הזמנה'
                            . '</td>'
                            . '<td>'
                            . 'תאריך אכילה'
                            . '</td>'
                            . '<td>'
                            . 'מחיר'
                            . '</td>'
                            . '</tr>';
                            echo '<tr>'
                            . '<td>'
                            . $row[0]
                            . '</td>'
                            . '<td>'
                            . $row[1]
                            . '</td>'
                            . '<td>'
                            . $row[3]
                            . '</td>'
                            . '<td>'
                            . $row[2]
                            . '</td>';
                            if($row[3] > $today|| ($row[3] == $today  && $row[4] >=$nowTime)){
                            echo
                              '<td>'
                            . '<input type="submit" id="' . $row[0] . '" onclick="changeValue(' . $row[0] . ')" class="submit" value="הסר" name="O">'
                            . '</td>'
                            . '</tr>';
                            }
                            else{
                            echo '</tr>';
                            }
                            while ($row = mysqli_fetch_array($usersorders)) {
                                echo '<tr>'
                                . '<td>'
                                . $row[0]
                                . '</td>'
                                . '<td>'
                                . $row[1]
                                . '</td>'
                                . '<td>'
                                . $row[3]
                                . '</td>'
                                . '<td>'
                                . $row[2]
                                . '</td>';
                                if($row[3] > $today|| ($row[3] == $today  && $row[4] >=$nowTime)){
                                  echo
                                    '<td>'
                                  . '<input type="submit" id="' . $row[0] . '" onclick="changeValue(' . $row[0] . ')" class="submit" value="הסר" name="O">'
                                  . '</td>'
                                  . '</tr>';
                                }
                                else{
                                echo '</tr>';
                                }
                            }
                            echo '</table>'
                            . '</form>';
                        } else {
                            echo '<h5>אין לך הזמנות פעילות</h5>';
                            echo '<p>הנך מעובר לדף הקודם באופן אוטומטי, אנא המתן.</p>';
                            echo '<img src="media/Loading.gif" alt="loading...">';
                            echo '<script type="text/javascript">'
                            . 'setTimeout(Redirect, 4000);'
                            . 'function Redirect() {'
                            . 'window.location="myProfile.php";}'
                            . '</script>';
                        }
                    }
                }
                if (!$passChange && !$viewOrders) {
                    echo '<img src="data:image/jpeg;base64,'.base64_encode( $var['Image'] ).'" height="250" width="250" alt="תמונת פרופיל"/>';
                    echo '<form class="w3-container" name="formNewUser"  method="post" action="' . $_SERVER["PHP_SELF"] . '">'
                    . '<input class ="submit" type="submit" value="שנה סיסמא" name="changePassword">'
                    . '<br>'
                    . '<input class = "submit" type = "submit" value = "צפה בהזמנות" name = "viewOrders">'
                    . '</form>';
                }
            }
            ?>

        </div>
        <?php
        if (isset($_POST['confirmPassChange'])) {
            mysqli_set_charset($con, "utf8");

            $passwordd = $_REQUEST['oldPassword'];
            $newPass = $_REQUEST['newPassword'];
            $newPassAgain = $_REQUEST['newPasswordAgain'];
            //מכניסים לתוך משתנה את התוצאה של פונקציית סלקט ואז מפעילים אותה עלידי פקודת מייאסקיולי
            $checkUser = "SELECT `Password` FROM users WHERE Email='" . $mail . "'";
            $userOldPass = mysqli_fetch_array(mysqli_query($con, $checkUser));

            if (!mysqli_query($con, $checkUser)) {
                die('Error: ' . mysqli_error($con));
                echo '<script>alert(' . "'נמצאה בעייה'" . ')</script>';
            }

            echo"<script>console.log('$mail');</script>";
            if ($passwordd === $userOldPass[0]) {
                if ($newPass === $newPassAgain) {
                    $updatesql = 'UPDATE users SET `Password` = "' . $newPass
                            . '" WHERE Email = "' . $mail . '"';
                    if (!mysqli_query($con, $updatesql)) {
                        die('Error: ' . mysqli_error($con));
                        echo '<script>alert(' . "'נמצאה בעייה'" . ')</script>';
                    }
                    echo '<script>alert(' . "'החלפת הסיסמאות בוצעה בהצלחה.'" . ')</script>';
                    mysqli_close($con);
                } else {
                    echo '<script>alert(' . "'הסיסמאות אינן תואמות, אנא הזן בשנית.'" . ')</script>';
                }
            } else {
                echo '<script>alert(' . "'הסיסמא הישנה אינה נכונה, אנא נסה שנית.'" . ')</script>';
            }
        }

        if (isset($_GET['O'])) {
            mysqli_set_charset($con, "utf8");
            $id = $_GET['O'];
            $deletePIO = "DELETE FROM orders WHERE oID = " . $id;
            //$resultPIO = mysqli_query($con, $deletePIO);
            //$deleteO = "DELETE FROM orders WHERE orderID = " . $id;
            if (!mysqli_query($con, $deletePIO)) {
                die('Error: ' . mysqli_error($con));
                echo '<script>alert(' . "'נמצאה בעייה'" . ')</script>';
            } else {
                echo '<script>alert(' . "'מחיקת ההזמנה בוצעה בהצלחה'" . ')</script>';
            }
            echo '<script type="text/javascript">'
            . 'setTimeout(Redirect, 500);'
            . 'function Redirect() {'
            . 'window.location="myProfile.php";}'
            . '</script>';
            mysqli_close($con);
        }
        ?>

        <div class="footer">
            <strong> &COPY;</strong>
            רזולוציה מומלצת: 768*1366
        </div>
    </body>
</html>
