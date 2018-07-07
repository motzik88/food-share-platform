
<?php

function logIn() {
    $con = mysqli_connect("localhost", "root", "", "applepie");
    mysqli_set_charset($con, "utf8");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql = "SELECT * FROM users WHERE Email='" . $_REQUEST['email'] . "'";
    $row = mysqli_fetch_array(mysqli_query($con, $sql));


    function takeBirthDay($fullDate) { //ilan -> check if this function works right with our code
        $birthdate = $fullDate;// substr($fullDate, 0, 5);
        return $birthdate;
    }

    mysqli_close($con);
    if ($_REQUEST['password'] === $row['Password']) {
        $_SESSION['canOrder'] = "yes";
        $_SESSION['timeout'] = time();
        $_SESSION['registered'] = "yes";
        $_SESSION['firstName'] = $row['Fname'];
        $_SESSION['lastName'] = $row['Lname'];
        $_SESSION['birthday'] = $row['Bday'];
        $_SESSION['email'] = $row['Email'];
        $_SESSION['gender'] = $row['Gender'];
        $_SESSION['username'] = $row['UserName'];
        $_SESSION['loginTime'] = time();
        echo "<script>window.location.reload();</script>";//check what is this
    } else {
        return false;
    }
}

#time to leave set to 3600 seconds
$TTL = 3600;
#check if TTL hasn't passed //check the signout if we need it!
if (isset($_REQUEST['signout']) || (isset($_SESSION['registered']) && time() - $_SESSION['timeout'] > $TTL)) {
    #session_unset();
    session_destroy();
    echo "<script>window.location.reload();</script>";
}
if (!isset($_SESSION['registered'])) {//anonymous session
    echo ' <div id="side-stuff">'
    . '<div class="active-links">'
    . '<a id = "signin-link" href = "#">'
    . '<div id = "session">'
    . '<span id = "enter_pos">'
    . ' היכנס לחשבון'
    . '</span>'
    . '</div>'
    . '</a>'
    . '<div id = "signin-dropdown">'
    . '<form class = "signin" method="post"'
    . 'action ="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">'
    . '<fieldset class = "textbox">'
    . '<label for = "email" class = "email">'
    . '<input id = "email" name = "email" placeholder = "מייל" " type = "text" autocomplete = "on">'
    . '</label>'
    . '<label for = "password">'
    . '<input id = "password" name = "password" placeholder = "סיסמא" type = "password">'
    . '</label>'
    . '</fieldset>'
    . '<fieldset class = "connect">'
    . '<button class = "button" type = "submit">התחבר</button>'
    . '<a href="newUser.php"><button class = "button left_button" type = "button">הירשם</button></a>'
    . '</fieldset>'
    . '</form>'
    . '</div>'
    . '</div>'
    . '</div>';
    if (isset($_REQUEST['email'])) {
        if (!logIn()) {
            echo "<script>alert('פרטי המשתמש אינם נכונים ביייייי');</script>";
        }
    }
} else {
    echo '<script>console.log("firstName: '.$_SESSION['firstName'].'" )</script>';
    echo 'user is loged in!!'.'<div class="welcomeUser"> שלום ' . $_SESSION['firstName']
    .  '<a href="logout.php"><button class ="button left_button" type = "button">התנתק</button></a></div>';
}

//. $_SESSION['email']
