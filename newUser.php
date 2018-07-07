<!DOCTYPE html>
<?php session_start(); ?>
<!--דף הרשמת משתמש חדש-->
<html lang="he">
    <head>
        <?php
        #allowing Hebrew
        header("Content-type: text/html; charset=utf-8");

        $con = mysqli_connect("localhost", "root", "", "applepie");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        ?>
        <title>הצטרפו אלינו!</title>
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
                $("#newUser").addClass("highlite");
            });
        </script>
    </head>
	<body  dir="rtl">
        <?php require('menu.php'); ?>

        <div class="signInNewUser" id="signInNewUser" >
          <div class="w3-container">
            <h2>הצטרף לקהילה!</h2>
          </div>
          <h4 >  בלה בלה הינה קהילה של אוהבי אוכל.
            מסביבנו יש הרבה אנשים עם מתכונים מדהימים, כל מה שאתה צריך לעשות כדי למצוא אותם, זה לחפש את אותם טעמים.
            בתור משתמש תוכל למצוא ארוחות ביתיות נהדרות, עם מגע אישי, במחיר סביר ביותר.
            בתור טבח תוכל להנות מדרך נוחה להתפרנס, בלי ההוצאות המיותרות של פתיחת מסעדה, בית קפה, קונדיטוריה, או מעדניה.
            גם הטבחים וגם הסועדים נהנים מהחיבור בין אוהבי אוכל. </h4>
            <form class="w3-container newUserForm_pos" name="formNewUser" id="formNewUser" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <table class="w3-table userDetailsR">
                    <tr>
                        <td class="tdNewUser" >
                            <label  for="username">שם משתמש: </label>
                            <input id="userName" type="text" class="newUserInput w3-input w3-select w3-border w3-round" name="username" minlength="6" required>
                        </td>
                        <td class="tdNewUser">
                            <label for="password">סיסמא: </label>
                            <input id="password" class="newUserInput w3-input w3-select w3-border w3-round" type="password" name="password" minlength="6" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdNewUser">
                            <label for="PImage">תמונת פרופיל:</label>
                            <input id="PImage" type="file" class="newUserInput w3-input w3-select w3-border w3-round" name="PImage" accept=".jpeg" title="נדרשת תמונת פרופיל" required>
                        </td>
                        <td class="tdNewUser">
                            <label for="first_mail">מייל: </label>
                            <input id="first_mail" class="newUserInput w3-input w3-select w3-border w3-round" type="email" name="mail" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="First_Name">שם פרטי: </label>
                            <input id="First_Name" type="text"class="newUserInput w3-input w3-select w3-border w3-round" name="fname" required>
                        </td>
                        <td>
                            <label for="last_Name">שם משפחה: </label>
                            <input id="last_Name" type="text"class="newUserInput w3-input w3-select w3-border w3-round" name="lname" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="dateofBirth">תאריך לידה: </label>
                            <input id="dateofBirth" type="date"class="newUserInput w3-input w3-select w3-border w3-round" name="bdate" min="1950-01-01" max="1998-12-31" required>
                        </td>
                        <td>
                            <label for="phoneNumber">מספר טלפון: </label>
                            <select name="phoneStart" required>
                                <option></option>
                                <option value="050" >050</option>
                                <option value="052" >052</option>
                                <option value="053" >053</option>
                                <option value="054" >054</option>
                                <option value="058" >058</option>
                                <option value="04" >04</option>
                                <option value="06" >06</option>
                                <option value="08" >08</option>
                                <option value="09" >09</option>
                            </select>
                            <input id="phoneNumber" type="text" name="phoneNumber" pattern="\d{7}" maxlength="7" title="על המספר להיות בעל 7 ספרות" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="w3-text-balck" for="advertasing">לקבלת תוכן פרסומי סמן תיבה זו</label>
                            <input class="checkAd" class="newUserInput w3-input w3-select w3-border w3-round" id="advertasing" name="advertasing" type="checkbox" checked>
                        </td>
                        <td>
                            <label for="Man">זכר</label> <input type="radio" name="gender" value="male" checked>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <label for="female">נקבה</label> <input type="radio" name="gender" value="female">
                        </td>
                    </tr>

                </table>

                <table class="w3-table userDetailsR">
                  <tr>
                    <th>
                      המטבחים האהובים עלי:
                    </th>
                  </tr>

                  <tr>
                    <td>
                      <label for="china">סיני</label>
                      <input  class="w3-check " type="checkbox" name="categories[]" value="china"><br>
                    </td>
                    <td>
                      <label for="francia">צרפתי</label>
                      <input type="checkbox" name="categories[]" value="francia"><br>
                    </td>
                    <td>
                      <label for="india">הודי</label>
                      <input type="checkbox" name="categories[]" value="india"><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="israel">ישראלי</label>
                      <input type="checkbox" name="categories[]" value="israel" class="right"><br>
                    </td>
                    <td>
                      <label for="italia">איטלקי</label>
                      <input type="checkbox" name="categories[]" value="italia"><br>
                    </td>
                    <td>
                      <label for="mexico">מקסיקני</label>
                      <input type="checkbox" name="categories[]" value="mexico"><br>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <label for="sudAmerica">דרום אמריקאי</label>
                      <input type="checkbox" name="categories[]" value="sudAmerica"><br>
                    </td>
                    <td>
                      <label for="thilandia">תאילנדי</label>
                      <input type="checkbox" name="categories[]" value="thilandia"><br>
                    </td>
                    <td>
                      <label for="otroC">אחר</label>
                      <input type="checkbox" name="categories[]" value="otroC"><br>
                    </td>
                  </tr>

                  <tr>
                    <th>
                      האלרגיות שלי:
                    </th>
                  </tr>

                  <tr>
                    <td>
                      <label for="glutenFree">ללא גלוטן</label>
                      <input type="checkbox" name="types[]" value="glutenFree"><br>
                    </td>
                    <td>
                      <label for="kosher">כשר</label>
                      <input type="checkbox" name="types[]" value="kosher"><br>
                    </td>
                    <td>
                      <label for="lactoseFree">ללא לקטוז</label>
                      <input type="checkbox" name="types[]" value="lactoseFree"><br>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <label for="organic">אורגני</label>
                      <input type="checkbox" name="types[]" value="organic"><br>
                    </td>
                    <td>
                      <label for="penautFree">ללא בוטנים</label>
                      <input type="checkbox" name="types[]" value="penautFree"><br>
                    </td>
                    <td>
                      <label for="vegan">טבעוני</label>
                      <input type="checkbox" name="types[]" value="vegan"><br>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <label for="vegeterian">צמחוני</label>
                      <input type="checkbox" name="types[]" value="vegeterian"><br>
                    </td>
                    <td>
                      <label for="otroT">אחר</label>
                      <input type="checkbox" name="types[]" value="otroT"><br>
                    </td>
                    <td>
                      <label for="spicy">רמת חריפות: </label>
                      <select name="spicy" required>
                          <option></option>
                          <option value="1" >ללא חריף</option>
                          <option value="2" >מעט חריף</option>
                          <option value="3" >שים לי קצת בפיתה</option>
                          <option value="4" >פנק אותי</option>
                          <option value="5" >תשבור אותי</option>
                      </select>
                    </td>
                  </tr>

                </table>
                <br><br>

                <input class ="submit" id="register" type="submit" value="להרשמה" onclick="return checkFildes()">
            </form>

        </div>
        <a href="#" class="back-to-top"></a>

        <div class="footer">
            <strong> &COPY;</strong>
            רזולוציה מומלצת: 768*1366
        </div>
        <?php

        if (count($_POST) != 0) { //סופר אם אחד מהשדות שונה מאפס
            mysqli_set_charset($con, "utf8");
            $userName = htmlspecialchars($_REQUEST['username']);
            $password = $_REQUEST['password'];
            $email = filter_var($_REQUEST['mail'], FILTER_SANITIZE_EMAIL);
            $mail = filter_var($email, FILTER_VALIDATE_EMAIL);

            /* ראה ערכים תקינים של מיילים בדף וורד המצורף    */
            $fname = filter_var($_REQUEST['fname'], FILTER_SANITIZE_STRING);
            $lname = filter_var($_REQUEST['lname'], FILTER_SANITIZE_STRING);
            //$PImage = $_REQUEST['PImage'];
            $imagetmp=addslashes (file_get_contents($_FILES['PImage']['tmp_name']));
            $takedate = $_REQUEST['bdate'];
            $date = date("Y-m-d H:i:s", strtotime($takedate));
            $birthdate = substr($date, 0, 10);

            $phoneStart = $_REQUEST['phoneStart'];

            $phoneNumber = filter_var($_REQUEST['phoneNumber'], FILTER_VALIDATE_INT);

            $ad = 'off';

            if (isset($_REQUEST['advertasing'])) {
                $ad = 'on';
            }

            $gender = $_POST['gender'];


            $userCategories = array("china"=>0, "francia"=>0, "india"=>0, "israel"=>0, "italia"=>0, "mexico"=>0, "sudAmerica"=>0, "thilandia"=>0, "otroC"=>0);
            $userTypes = array( "glutenFree"=>0, "kosher"=>0, "lactoseFree"=>0, "organic"=>0, "penautFree"=>0, "vegan"=>0, "vegeterian"=>0, "otroT"=>0);
            $spicy = $_REQUEST['spicy'];


            if(isset($_REQUEST['categories'])){
              $helpArr1 = $_POST['categories'];
              if(!empty($helpArr1)){
                $N = count($helpArr1);
                for($i=0; $i < $N; $i++)
                {
                  $userCategories[$helpArr1[$i]] = 1;
                }
              }
            }

            if(isset($_REQUEST['types'])){
              $helpArr2 = $_POST['types'];
              if(!empty($helpArr2)){
                $D = count($helpArr2);
                for($i=0; $i < $D; $i++)
                {
                  $userTypes[$helpArr2[$i]] = 1;
                }
              }
            }

            //מכניסים לתוך משתנה את התוצאה של פונקציית סלקט ואז מפעילים אותה עלידי פקודת מייאסקיולי

            $checkMail = "SELECT * FROM users WHERE Email='" . $mail . "'";
            $mailRow = mysqli_fetch_array(mysqli_query($con, $checkMail));
            //כאן בודקים האם קיים כבר משתמש רשום עם אותו מייל
                if (!($mail === $mailRow['mail'])) {

                        $insertSql = "INSERT INTO users (UserName, Fname, Lname, Email, Password, Bday, PhoneStart, PhoneNumber, Advertising, Gender, Image) "
                                . "VALUES ('$userName', '$fname', '$lname', '$mail', '$password', '$birthdate', $phoneStart, $phoneNumber, '$ad', '$gender', '$imagetmp')";

                        $insertSql1 = "INSERT INTO types (tEmail, picante, vegeterian, vegan, kosher, organic, lactoseFree, glutenFree, penautFree, other) "
                                . "VALUES ('$mail', $spicy, $userTypes[vegeterian], $userTypes[vegan], $userTypes[kosher], $userTypes[organic], $userTypes[lactoseFree], $userTypes[glutenFree], $userTypes[penautFree], $userTypes[otroT])";

                        $insertSql2 = "INSERT INTO categories (cEmail, italia, mexico, china, israel, thailandia, sudAmerica, india, francia, otro) "
                                . "VALUES ('$mail', $userCategories[italia], $userCategories[mexico], $userCategories[china], $userCategories[israel], $userCategories[thilandia], $userCategories[sudAmerica], $userCategories[india], $userCategories[francia], $userCategories[otroC])";

                        if (!mysqli_query($con, $insertSql)) {
                            die('Error: ' . mysqli_error($con));
                            echo '<script>alert(' . "'הייתה בעיה'" . ')</script>';
                        } else {

                          if (!mysqli_query($con, $insertSql1)) {
                              die('Error: ' . mysqli_error($con));
                              echo '<script>alert(' . "'הייתה בעיה'" . ')</script>';
                          } else {

                            if (!mysqli_query($con, $insertSql2)) {
                                die('Error: ' . mysqli_error($con));
                                echo '<script>alert(' . "'הייתה בעיה'" . ')</script>';
                            } else {

                            echo '<script>alert(' . "'נרשמת בהצלחה'" . ')</script>';
                            $_SESSION['timeout'] = time();
                            $_SESSION['canOrder'] = "yes";
                            $_SESSION['registered'] = "yes";
                            $_SESSION['firstName'] = $fname;
                            $_SESSION['lastName'] = $lname;
                            $_SESSION['birthday'] = $birthdate;
                            $_SESSION['username'] = $userName;
                            $_SESSION['email'] = $email;
                            $_SESSION['gender'] = $gender;
                            $_SESSION['loginTime'] = time();
                        }
                      }
                    }
                        mysqli_close($con);

                        //הדף עובר אחרי שנייה לדף אינדקס
                        echo '<script type="text/javascript">'
                        . 'setTimeout(Redirect, 1000);'
                        . 'function Redirect() {'
                        . 'window.location="index.php";}'
                        . '</script>';

                } else {
                    echo '<script>alert(' . "'המייל כבר קיים במערכת'" . ')</script>';
                }
        } else {
            return false;
        }
        ?>

    </body>
</html>
