<!DOCTYPE html>
<?php session_start() ?>
<html lang="he">
    <head>
        <title>צרו עימנו קשר</title>
        <?php header("Content-type: text/html; charset=utf-8"); ?>
        <meta charset="UTF-8">
        <link rel="icon" type="PNG image (.png)" href="media/top2.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="Css/w3.css" rel="stylesheet" type="text/css"/>
        <link href="Css/style.php" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="js/newJS.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $("#contact").addClass("highlite");
            });
        </script>
    </head>
    <body dir = "rtl">
        <?php require('menu.php'); ?>
        <?php require ('login.php'); ?>
        <?php $_SESSION['timeout'] = time(); ?>
        <div class = "container">
          <h1 class = "make_contact">צור קשר</h1>
          <table>
              <tr>
                  <td class="contact_address details">
                      <h3>נשמח לעמוד לרשותכם בכל עת</h3>
                      <p class="address">כתובתנו:</p>
                      <p>באר שבע</p>
                      <table class = "det_wrapper">
                          <tr>
                              <td>
                                  <img src="media/phone.png" alt="טלפון" />
                              </td>
                              <td>
                                  <strong>טלפון:</strong> 0523555356
                              </td>
                          </tr>
                          <tr>
                              <td class= "fax_pic">
                                  <img src="media/fax.png" alt="פקס" />
                              </td>
                              <td class="fax_number">
                                  <strong>פקס: </strong> 08-9851213
                              </td>
                          </tr>
                          <tr>
                              <td class="mail_pic">
                                  <img src="media/mail.png" alt="דואר אלקטרוני" />
                              </td>
                              <td class="mail_add">
                                  <strong>דוא"ל: </strong>lior456@gmail.com
                              </td>
                          </tr>
                      </table>
                  </td>
                  <td>
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109136.97103921864!2d34.860927450489335!3d31.261422309585615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15026640029f8777%3A0x8dee8012deb5dd8!2z15HXkNeoINep15HXog!5e0!3m2!1siw!2sil!4v1513532496473" width="500" height="400"  style="border:0; right:100px; position:relative; float:left;"></iframe>
                  </td>
              </tr>
          </table>

          <div class = "msg-wrapper">
              <form id="makeContact" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  <input id="fullName" name="fullName" type="text" class="det w3-input w3-border w3-round" placeholder="שם מלא" required><br>
                  <br><input id="customerPhone" name="customerPhone" type="text" class="w3-input w3-border w3-round det" placeholder="טלפון" pattern="\d{10}" maxlength="10" title="על המספר להיות בעל 10 ספרות" required><br>
                  <br><textarea id="customerContent" name="customerContent" class="w3-input w3-border w3-round" rows="3" placeholder = "הערות" required></textarea>
                  <input class = "submit" type="submit" value="שלח פניה" name="contact">
              </form>
          </div>
      </div>


        <?php
        $con = mysqli_connect("localhost", "root", "", "applepie");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        if (isset($_POST['contact']) != 0 ) {
            mysqli_set_charset($con, "utf8");
            //אם מולא השדה

            $fname = filter_var($_REQUEST['fullName'], FILTER_SANITIZE_STRING);
            $phoneNumberr = $_REQUEST['customerPhone'];
            $contentCustomer = filter_var($_REQUEST['customerContent'], FILTER_SANITIZE_STRING);
            // insert into content db
            $insertSql = "INSERT INTO contacts(Fname, phoneNum, textContact)"
                    . 'VALUES ("' . $fname . '","' . $phoneNumberr . '","' . $contentCustomer . '")';
            if (!mysqli_query($con, $insertSql)) {
                die(' Error: ' . mysqli_error($con));
                echo ' < script>alert(' . "'זוהתה בעיה'" . ' ) </script>';
            } else {
                echo '<script>alert(' . "'פרטי הפנייה נקלטו במערכת.אנו עושים את מירב המאמצים בכדי לענות לך בהקדם.'" . ')</script>';
                echo '<script type="text/javascript">'
                . 'setTimeout(Redirect, 1000);'
                . 'function Redirect() {'
                . 'window.location="index.php";}'
                . '</script>';
            }
            mysqli_close($con);
        }
        ?>
        <a href="#" class="back-to-top"></a>

        <div class="footer">
            <strong> &COPY;</strong>
            רזולוציה מומלצת: 768*1366
        </div>
    </body>
</html>
