<!DOCTYPE html>
<?php session_start(); ?>
<html lang="he">
    <head>
        <title>תשלום</title>
        <?php header("Content-type: text/html; charset=utf-8"); ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="PNG image (.png)" href="media/top2.png">
        <link href="Css/w3.css" rel="stylesheet" type="text/css"/>
        <link href="Css/style.php" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <script src="js/newJS.js" type="text/javascript"></script>
        <?php

        if(isset($_POST['orderButton'])) { //the order is made
          if(isset($_SESSION['email'])) { //the order is made by a user
            $con = mysqli_connect("localhost", "root", "", "applepie");
            mysqli_set_charset($con, "utf8");
            //insert the order to the DB
            $oEmail = $_SESSION['email'];
            $dID = $_SESSION['payment_dID'];
            $dEmail = $_SESSION['payment_dEmail'];
            $dInstace = $_SESSION['payment_dInstace'];
            echo '<script>console.log("$dInstace: '.$dInstace.'" )</script>';
            $oDate = date("Y-m-d");
            echo '<script>console.log("$oDate: '.$oDate.'" )</script>';
            $oTime = date("H:i:s");
            echo '<script>console.log("$oTime: '.$oTime.'" )</script>';
            $pickDate = date("Y-m-d H:i:s", strtotime($_POST['deliveryDay']));
            echo '<script>console.log("$pickDate: '.$pickDate.'" )</script>';
            $pickTime = date("H:i:s");
            echo '<script>console.log("$pickTime: '.$pickTime.'" )</script>';
            $quantity = $_SESSION['quantity'];
            $changes = mysqli_real_escape_string($con, $_POST['oChanges']);
            $notes = mysqli_real_escape_string($con, $_POST['oNotes']);
            echo '<script>console.log("inputAutocompleteOrder: '.$_POST["inputAutocompleteOrder"].'" )</script>';
            $address = mysqli_real_escape_string($con, $_POST['inputAutocompleteOrder']);
            $totalPrice = $_SESSION['price']*$_SESSION['quantity'];


            //insert the orther into orders table
            $insertOrder = "INSERT INTO orders(oEmail, dID, dEmail,dInstace, oDate, oTime, pickDate, pickTime, quantity, changes, notes, address, totalPrice)"
                    . "VALUES ('$oEmail',$dID, '$dEmail',$dInstace,'$oDate', '$oTime', '$pickDate','$pickTime',$quantity,'$changes','$notes','$address',$totalPrice)";
            if (!mysqli_query($con, $insertOrder)) {
                die('Error: ' . mysqli_error($con));
                echo '<script>alert(' . "'הייתה בעיה בהכנסה של שאילתה לטבלת הזמנות'" . ')</script>';
            }


            //check how many portion the order has sold
            $sqlNumOfPortions = "SELECT orderQuant FROM dishinsearch WHERE dID = $dID AND dEmail = '$dEmail' AND dInstace = $dInstace";

            if (!mysqli_query($con, $sqlNumOfPortions)) {
                die('Error: ' . mysqli_error($con));
                echo '<script>alert(' . "' הייתה בעיה בבדיקה של כמות מנות שהמנה מכרה'" . ')</script>';
            }
            $row = mysqli_fetch_array(mysqli_query($con, $sqlNumOfPortions));
            $numOfPortions = $row[0] + $quantity;

            //upate number of porions the dish has sold
            $updateDishInSearch = "UPDATE dishinsearch SET orderQuant = $numOfPortions "
                                . " WHERE dID = $dID AND dEmail = '$dEmail' AND dInstace = $dInstace";

            if (!mysqli_query($con, $updateDishInSearch)) {
                die('Error: ' . mysqli_error($con));
                echo '<script>alert(' . "' הייתה בעיה בהכנסה של שאילתה הכנסה לעדכון כמות בטבלת מנות בחיפוש'" . ')</script>';
            }

            echo '<script>alert("ההזמנה התקבלה במערכת, בתאבון!")</script>';
            //שאילתה שתשלוף את ההזמנה האחרונה כך שנוכל להעלות אותם על פי סדרם
            echo '<script type="text/javascript">'
            . 'setTimeout(Redirect, 100);'
            . 'function Redirect() {'
            . 'window.location="index.php";}'
            . '</script>';
          }
        }

        ?>
        <script>
            $(document).ready(function () {
                $("#index").addClass("highlite");
            });
        </script>
    </head>
    <body dir="rtl">
      <?php require('menu.php'); ?>
      <?php require('login.php'); ?>
      <?php $_SESSION['timeout'] = time(); ?>
      <?php
      $product = $_SESSION['product'];
      $_SESSION['price'] = $product['price'];
      $_SESSION['quantity'] = $_POST['quantity'];
      //$chefsAddress = $product['address'];
      ?>

      <div class="w3-container w3-light-grey" id="rightDivPayment">
        <iframe  src="<?php echo $_POST['mapSRC'] ?>" id="iFrameMap"   allowfullscreen></iframe>
        <form method="post" action="orderPayment.php" name="orderPaymentForm" id="orderPaymentForm">
          <label class="w3-text-grey searchTitle" ><b>מספר מנות בהזמנה: <?php echo ($_POST['quantity']); ?></b></label><br>
          <label class="w3-text-grey searchTitle" ><b>מחיר כולל: </b><?php echo ($product['price']*$_POST['quantity']); ?> ש"ח</label>
          <br>
          <label class="w3-text-grey searchTitle" ><b> תאריך הזמנה</b></label><br>
          <?php
            echo '<input id="deliveryDay" class ="det w3-input w3-border w3-round"  type="date" value="' . $_POST['deliveryDay']. '" name="deliveryDay" disabled="true"><br><br> '
                . '<label class="w3-text-grey hourTitle"><b>  שעת הזמנה</b></label><br>'
                .'<input id="deliveryHour" class ="det w3-input w3-border w3-round"  type="time" value="' . $_POST['deliveryHour']. '" name="deliveryHour" disabled="true"><br><br> ';
          ?>
          <div>
            <?php
              if ($_POST['shipping']=='yes'){
                echo '<label class="w3-text-grey searchTitle" ><b> משלוח לכתובת:  </b></label><br>'
                   . '<input class="w3-border w3-round-large autocompleteInput" id="paymentAddress" name="inputAutocompleteOrder" value="' .$_POST['inputAutocompleteOrder'].'" disabled="true" type="text"></input>';

              }else{
                echo '<label class="w3-text-grey searchTitle" ><b> איסוף עצמי </b></label><br>';

              }
            ?>
            <br><br>
          </div>


          </div>

          <!--this table is none visible to the user, its just to calculate distance with the dish address-->

          <input type="hidden" name="mapSRC" id="mapSRC" value=""></input>
          <?Php
            echo '<input type="hidden" name="quantity" id="quantity" value="'.$_POST['quantity'].'"></input>'
                .'<input type="hidden" name="deliveryDay" id="deliveryDay" value="'.$_POST['deliveryDay'].'"></input>'
                .'<input type="hidden" name="deliveryHour" id="deliveryHour" value="'.$_POST['deliveryHour'].'"></input>'
                .'<input type="hidden" name="shipping" id="shipping" value="'.$_POST['shipping'].'"></input>'
                .'<input type="hidden" name="inputAutocompleteOrder" id="inputAutocompleteOrder" value="'.$_POST["inputAutocompleteOrder"].'"></input>'
                .'<input type="hidden" name="mapSRC" id="mapSRC" value="'.$_POST['mapSRC'].'"></input>';
          ?>
          <input type="hidden" name="orderSucces" id="orderSucces" value="yes"></input>
          <input type="submit" class ="submit orderDi" id="submitBtnPayment" value="אשר הזמנה">
        </form>
        </div>


      <?php
      //inserting in session variables for the option of going back and not buyng the dish
      $_SESSION['payment_dID'] = $product['dID'];
      $_SESSION['payment_dEmail'] = $product['dEmail'];
      $_SESSION['payment_dInstace'] = $product['dInstace'];


      echo '<div  class="productInfo_container">'
      . '<div  class="productInfo_header">'
      . '<a href="orderDish.php?status=back&page='.$_SESSION["page"].'" class="button" ><b>חזרה</b></a>'
      . '<h1 class="w3-center w3-wide">'
      . $product['dName'] //dish name
      . '</h1>'
      . '<h5><b>'
      . 'המנה מאת: </b>'
      . $product['Fname'] //chefs name
      . '</h5>'
      . '</div>'
      . '<hr>'
      . '<div class="productInfo_contect">'
      . '<div class="productInfo_contectImage">'
      . '<img src="data:image/jpeg;base64,'.base64_encode( $product['dPicture'] ).'"height="250" width="250" alt="">' //img
      . '</div>'
      . '<div class="productInfo_contectDescription">'
      . '<p><b>תיאור המנה: </b></p>'
      . '<p id="pDesc">' . $product['dDescription'] . '</p>'// description of the dish
      . '<p><b> שינוים שארצה לעשות:  </b></p>'
      . '<input type="text" size="50" placeholder= "אילו שינוים תרצה לבצע? " form="orderPaymentForm" id="oChanges" name="oChanges"></input>'// changes of the dish
      . '<p><b>   הערות לטבח:   </b></p>'
      . '<input type="text" size="50" placeholder="כאן יש הערות לטבח" form="orderPaymentForm" id="oNotes" name="oNotes"></input>'// notes of the dish
      . '<input type="submit" class="order-btn" value="אשר הזמנה"form="orderPaymentForm" name="orderButton" id="orderButton" ></input>'
      . '</div>'
      . '</div>'
      . '</div>';
      ?>

      <div class="footer">
          <strong> &COPY;</strong>
          רזולוציה מומלצת: 768*1366
      </div>
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdmACMDmBVH-ewHf-L2BBah6LYwBJ9Ma0&libraries=places&callback=initAutocomplete" async defer></script>

    </body>
</html>
