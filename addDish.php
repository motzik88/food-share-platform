<!DOCTYPE html>
<?php session_start() ?>
<html lang="he">
    <head>
        <title>העלאת מנה</title>
        <?php header("Content-type: text/html; charset=utf-8");
        $con = mysqli_connect("localhost", "root", "", "applepie");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="PNG image (.png)" href="media/top2.png">
        <link href="Css/w3.css" rel="stylesheet" type="text/css"/>
        <link href="Css/style.php" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="js/newJS.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $("#addDish").addClass("highlite");
            });
        </script>
    </head>
    <body dir="rtl">
        <?php require('menu.php'); ?>
        <?php require('login.php'); ?>
        <?php $_SESSION['timeout'] = time(); ?>

        <div class="signInNewUser" id="signInNewUser" >
          <div class="w3-container">
            <h2> שמחים שבחרת להעלות מנה :) </h2>
            <h4>קצת פרטים עליה ואפשר להתחיל לבשל</h4>
          </div>


            <form id="dishForm" class="w3-container newUserForm_pos" name="formNewUser"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"enctype="multipart/form-data">
                <table class="w3-table dishDetailsR">
                    <tr>
                        <td>
                          <label for="autocomplete">כתובת לאיסוף: </label>
                          <input id="autocomplete" placeholder="הכנס כתובת" name="autocomplete"
                          onFocus="initAutocomplete('autocomplete')" type="text" required></input>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dName">שם המנה: </label>
                            <input id="dName" type="text" name="dName" minlength="2" required>
                        </td>
                        <td>
                            <label for="dPicture">תמונת המנה: </label>
                            <input id="dPicture" type="file" name="dPicture" accept=".jpeg" title="נדרשת תמונת פרופיל" required>
                        </td>
                    </tr>
                    <tr>
                        <td >
                          <label for="dDescription">תיאור המנה: </label>
                          <textarea id="dDescription" name="dDescription" class="w3-input w3-border w3-round" rows="3" required ></textarea>
                        </td>
                        <td>
                            <label for="dChanges">שינויים אפשריים: </label>
                            <textarea id="dChanges" name="dChanges" class="w3-input w3-border w3-round" rows="3" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                          <label for="minQuant">כמות מינימלית להזמנה:</label>
                          <input id="minQuant" type="text" name="minQuant" pattern="\d*"  title="על המספר להיות בעל ספרות"  required>
                        </td>
                        <td>
                            <label for="maxQuant">כמות מקסימלית להזמנה: </label>
                            <input id="maxQuant" type="text" name="maxQuant" pattern="\d*"  title="על המספר להיות בעל ספרות" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                          <label for="tillDate">עד מתי ניתןן להזמין</label>
                          <input id="tillDate" type="date" name="tillDate" min="2018-01-01" required>
                        </td>
                        <td>
                            <label for="dPrice">מחיר: </label>
                            <input id="dPrice" type="text" name="dPrice" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dSize">גודל המנה: </label>
                            <input id="dSize" type="text" name="dSize" required>
                        </td>
                    </tr>
                </table>

                <table class="w3-table dishDetailsL">
                  <tr >
                    <th>
                      באילו ימים ניתן להזמין:
                    </th>
                  </tr>

                  <tr>
                    <td >
                      <label for="sunday">ראשון</label>
                      <input type="checkbox" name="days[]" value="sunday"><br>
                    </td>
                    <td >
                      <label for="monday">שני</label>
                      <input type="checkbox" name="days[]" value="monday"><br>
                    </td>
                    <td >
                      <label for="tuesday">שלישי</label>
                      <input type="checkbox" name="days[]" value="tuesday"><br>
                    </td>
                  </tr>
                  <tr>
                    <td >
                      <label for="wednesday">רביעי</label>
                      <input type="checkbox" name="days[]" value="wednesday"><br>
                    </td>
                    <td >
                      <label for="thursday">חמישי</label>
                      <input type="checkbox" name="days[]" value="thursday"><br>
                    </td>
                    <td >
                      <label for="friday">שישי</label>
                      <input type="checkbox" name="days[]" value="friday"><br>
                    </td>
                  </tr>

                  <tr>
                    <td >
                      <label for="saturday">שבת</label>
                      <input type="checkbox" name="days[]" value="saturday"><br>
                    </td>
                  </tr>

                  <tr >
                    <th>
                      קטגוריות המנה:
                    </th>
                  </tr>

                  <tr>
                    <td >
                      <label for="china">סיני</label>
                      <input type="checkbox" name="categories[]" value="china"><br>
                    </td>
                    <td >
                      <label for="francia">צרפתי</label>
                      <input type="checkbox" name="categories[]" value="francia"><br>
                    </td>
                    <td >
                      <label for="india">הודי</label>
                      <input type="checkbox" name="categories[]" value="india"><br>
                    </td>
                  </tr>
                  <tr>
                    <td >
                      <label for="israel">ישראלי</label>
                      <input type="checkbox" name="categories[]" value="israel"><br>
                    </td>
                    <td >
                      <label for="italia">איטלקי</label>
                      <input type="checkbox" name="categories[]" value="italia"><br>
                    </td>
                    <td >
                      <label for="mexico">מקסיקני</label>
                      <input type="checkbox" name="categories[]" value="mexico"><br>
                    </td>
                  </tr>

                  <tr>
                    <td >
                      <label for="sudAmerica">דרום אמריקאי</label>
                      <input type="checkbox" name="categories[]" value="sudAmerica"><br>
                    </td>
                    <td >
                      <label for="thilandia">תאילנדי</label>
                      <input type="checkbox" name="categories[]" value="thilandia"><br>
                    </td>
                    <td >
                      <label for="otroC">אחר</label>
                      <input type="checkbox" name="categories[]" value="otroC"><br>
                    </td>
                  </tr>

                  <tr>
                    <th>
                      סוג המנה:
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

                <input class ="submit" id="addDish" type="submit" value="פרסם מנה">
            </form>

        </div>
        <a href="#" class="back-to-top"></a>

        <div class="footer">
            <strong> &COPY;</strong>
            רזולוציה מומלצת: 768*1366
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdmACMDmBVH-ewHf-L2BBah6LYwBJ9Ma0&libraries=places&callback=initAutocomplete"async defer></script>
        <?php
        if (count($_POST) != 0) { //סופר אם אחד מהשדות שונה מאפס
            mysqli_set_charset($con, "utf8");

            $dName = filter_var($_REQUEST['dName'], FILTER_SANITIZE_STRING);
            $dDescription = filter_var($_REQUEST['dDescription'], FILTER_SANITIZE_STRING);
            $dChanges = filter_var($_REQUEST['dChanges'], FILTER_SANITIZE_STRING);
            $dSize =filter_var($_REQUEST['dSize'], FILTER_SANITIZE_STRING);


            $takedate = $_REQUEST['tillDate'];
            $tillDate = date("Y-m-d H:i:s", strtotime($takedate));
            $minQuant = $_REQUEST['minQuant'];
            $maxQuant = $_REQUEST['maxQuant'];
            $dPrice = $_REQUEST['dPrice'];


            $dishDays = array("sunday"=>0, "monday"=>0, "tuesday"=>0, "wednesday"=>0, "thursday"=>0, "friday"=>0, "saturday"=>0);
            $dishCategories = array("china"=>0, "francia"=>0, "india"=>0, "israel"=>0, "italia"=>0, "mexico"=>0, "sudAmerica"=>0, "thilandia"=>0, "otroC"=>0);
            $dishTypes = array( "glutenFree"=>0, "kosher"=>0, "lactoseFree"=>0, "organic"=>0, "penautFree"=>0, "vegan"=>0, "vegeterian"=>0, "otroT"=>0);
            $spicy = $_REQUEST['spicy'];

            if(isset($_REQUEST['days'])){
              $helpArr2 = $_POST['days'];
              if(!empty($helpArr2)){
                $K = count($helpArr2);
                for($i=0; $i < $K; $i++)
                {
                  $dishDays[$helpArr2[$i]] = 1;
                }
              }
            }
            if(isset($_REQUEST['categories'])){
              $helpArr1 = $_POST['categories'];
              if(!empty($helpArr1)){
                $N = count($helpArr1);
                for($i=0; $i < $N; $i++)
                {
                  $dishCategories[$helpArr1[$i]] = 1;
                }
              }
            }

            if(isset($_REQUEST['types'])){
              $helpArr3 = $_POST['types'];
              if(!empty($helpArr3)){
                $D = count($helpArr3);
                for($i=0; $i < $D; $i++)
                {
                  $dishTypes[$helpArr3[$i]] = 1;
                }
              }
            }

            $userAddress =$_REQUEST['autocomplete'];
            $userMail = $_SESSION['email'];
            $mail = filter_var($userMail, FILTER_VALIDATE_EMAIL);
            $dishNum = "SELECT COUNT(*) FROM `dishes` WHERE dEmail ='" . $mail . "'";
            $userDishes = mysqli_fetch_array(mysqli_query($con, $dishNum));
            $userNumOfDishes = $userDishes[0] +1;
            $imagetmp=addslashes (file_get_contents($_FILES['dPicture']['tmp_name']));
            $insertSql = "INSERT INTO dishes (dID, dEmail, dName, dDescription, dChanges, dSize, dPicture) "
                    . "VALUES ($userNumOfDishes, '$mail', '$dName', '$dDescription', '$dChanges', '$dSize', '$imagetmp')";

            $insertSql3 = "INSERT INTO dishinsearch (dID, dEmail,dInstace, price, minQuant, maxQuant, orderQuant, tillDay, sunday, monday, tuesday, wednesday, thursday, friday, saturday, address, active) "
                    . "VALUES ($userNumOfDishes, '$mail',1 , '$dPrice', '$minQuant', '$maxQuant', 0, '$tillDate', $dishDays[sunday], $dishDays[monday], $dishDays[tuesday], $dishDays[wednesday], $dishDays[thursday], $dishDays[friday], $dishDays[saturday], '$userAddress', 1)";


            $insertSql1 = "INSERT INTO types (tEmail, dID, picante, vegeterian, vegan, kosher, organic, lactoseFree, glutenFree, penautFree, other) "
                    . "VALUES ('$mail', $userNumOfDishes, $spicy, $dishTypes[vegeterian], $dishTypes[vegan], $dishTypes[kosher], $dishTypes[organic], $dishTypes[lactoseFree], $dishTypes[glutenFree], $dishTypes[penautFree], $dishTypes[otroT])";

            $insertSql2 = "INSERT INTO categories (cEmail, dID, italia, mexico, china, israel, thailandia, sudAmerica, india, francia, otro) "
                    . "VALUES ('$mail', $userNumOfDishes, $dishCategories[italia], $dishCategories[mexico], $dishCategories[china], $dishCategories[israel], $dishCategories[thilandia], $dishCategories[sudAmerica], $dishCategories[india], $dishCategories[francia], $dishCategories[otroC])";

            if (!mysqli_query($con, $insertSql)) {
                die('Error: ' . mysqli_error($con));
                echo '<script>alert(' . "'הייתה בעיה'" . ')</script>';
            } else {

              if (!mysqli_query($con, $insertSql3)) {
                  die('Error: ' . mysqli_error($con));
                  echo '<script>alert(' . "'הייתה בעיה'" . ')</script>';
              } else {

                if (!mysqli_query($con, $insertSql2)) {
                    die('Error: ' . mysqli_error($con));
                    echo '<script>alert(' . "'הייתה בעיה'" . ')</script>';
                } else {
                  if (!mysqli_query($con, $insertSql1)) {
                      die('Error: ' . mysqli_error($con));
                      echo '<script>alert(' . "'הייתה בעיה'" . ')</script>';
                  } else {
                    echo '<script>alert(' . "'המנה עלתה בהצלחה!'" . ')</script>';
                  }
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
            return false;
        }
        ?>

    </body>
</html>
