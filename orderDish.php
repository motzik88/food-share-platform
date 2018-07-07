<!DOCTYPE html>
<?php session_start(); ?>
<html lang="he">
    <head>
        <title>הזמנה</title>
        <?php header("Content-type: text/html; charset=utf-8");?>
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

        function getProduct() {
            $con = mysqli_connect("localhost", "root", "", "applepie");
            mysqli_set_charset($con, "utf8");
            if (isset($_GET['status'])) {
              $dID = $_SESSION['payment_dID'];
              $dEmail = ' "'. $_SESSION["payment_dEmail"] . '"' ;
              $dInstace = $_SESSION['payment_dInstace'];
              unset($_SESSION['payment_dID']);
              unset($_SESSION['payment_dEmail']);
              unset($_SESSION['payment_dInstace']);
              return $_SESSION['product'];
            }else{
              $dID = $_POST['dID'];
              echo '<script>console.log("$_POST[dID]: '.$_POST['dID'].'" )</script>';
              $dEmail = $_POST['dEmail'];
              echo '<script>console.log("$_POST[dEmail]: '.$_POST['dEmail'].'" )</script>';
              $dInstace = $_POST['dInstace'];
              echo '<script>console.log("$_POST[dInstace]: '.$_POST['dInstace'].'" )</script>';
            }

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $sql = "SELECT ad.dID, ad.dEmail, ad.dInstace, ad.price,ad.address , dishes.dName, dishes.dPicture, users.Fname, ad.orderQuant, ad.maxQuant, "
                     . " ad.minQuant, ad.tillDay, types.picante, dishes.dDescription, dishes.dChanges, dishes.dSize, ad.sunday, ad.monday, ad.tuesday, ad.wednesday, ad.thursday, ad.friday, ad.saturday "
                     . "FROM (SELECT * FROM dishinsearch WHERE dishinsearch.dID = $dID and dishinsearch.dEmail = '$dEmail'  and dishinsearch.dInstace = $dInstace) as ad "
                     . "JOIN dishes on ad.dID = dishes.dID and ad.dEmail = dishes.dEmail LEFT JOIN types on dishes.dID = types.dID and dishes.dEmail "
                     . "= types.tEmail join users on types.tEmail = users.Email ";
            $row = mysqli_fetch_array(mysqli_query($con, $sql));
            mysqli_close($con);
            return $row;
        }
        ?>
        <script>
            $(document).ready(function () {
                $("#index").addClass("highlite");
            });
        </script>
    </head>
    <body dir="rtl">
      <?php
        if(!isset($_SESSION['canOrder'])){
          echo '<script type="text/javascript">'
          . 'alert("קודם כל תתחבר חבר");'
          . 'setTimeout(Redirect, 0);'
          . 'function Redirect() {'
          . 'window.location="index.php";}'
          . '</script>';
        }?>
      <?php require('menu.php'); ?>
      <?php require('login.php'); ?>
      <?php $_SESSION['timeout'] = time(); ?>
      <?php
      $product = getProduct();


      $_SESSION['product'] = $product;

      $days = array('sunday'=>$product['sunday'], 'monday'=>$product['monday'],'tuesday'=>$product['tuesday'],'wednesday'=>$product['wednesday'],'thursday'=>$product['thursday'],'friday'=>$product['friday'],'saturday'=>$product['saturday']);
      $chefsAddress = $product['address'];
      echo '<script>console.log("before: '.$chefsAddress.'" )</script>';
      //$chefsAddress = ilan($chefsAddress);//'<script>encodeURIComponent($chefsAddress)</script>';
      echo '<script>console.log("after: '.$chefsAddress.'" )</script>';

      function whatDay($day){
        switch($day){
          case "sunday":
            return "ימי ראשון";
            break;
          case "monday":
            return "ימי שני";
            break;
          case "tuesday":
            return "ימי שלישי";
            break;
          case "wednesday":
            return "ימי רביעי";
            break;
          case "thursday":
            return "ימי חמישי";
            break;
          case "friday":
            return "ימי שישי";
            break;
          case "saturday":
            return "ימי שבת";
            break;
          };
      };
      function howSpicy($picante){
        switch($picante){
          case "1":
            return "ללא חריף";
            break;
          case "2":
            return "מעט חריף";
            break;
          case "3":
            return "שים קצת בפיתה";
            break;
          case "4":
            return "פנק אותי";
            break;
          case "5":
            return "תשבור אותי";
            break;
          };
      };
      ?>
      <div class="w3-container w3-light-grey" id="rightDivOrder">
        <iframe  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyACLIUNjDwdgZm5KqdZXEqTslr_2Shvvc4&q=" id="iFrameMap"   allowfullscreen></iframe>
        <form method="post" action="orderPayment.php" name="orderDishForm" id="orderDishForm">
          <label class="w3-text-grey searchTitle" ><b>מחיר: </b><?php echo $product['price']; ?> ש"ח</label>
          <br>
          <label class="w3-text-grey searchTitle" ><b>ימים אפשריים:</b></label><br>
          <label class="w3-text-grey searchTitle" >
            <?php //insert here the days that the dish is available
            foreach ($days as $key => $value) {
              if($value == 1){
                $daySTR = whatDay($key);
                echo "" . $daySTR . "<br>";
              };
            };
            ?>
          </label>
          <label class="w3-text-grey searchTitle" ><b> תאריך</b></label><br>
          <?php echo '<input id="deliveryDay" class ="det w3-input w3-border w3-round"  type="date" min="'.date("Y-m-d").'" max="'.$product['tillDay'].'" name="deliveryDay" required><br><br>'?>
          <label class="w3-text-grey hourTitle"><b>  שעה</b></label><br>
          <input id="deliveryHour" class ="det w3-input w3-border w3-round" type="time" name="deliveryHour" required><br><br>
          <div>
            <label class="w3-text-grey searchTitle" ><b>מספר מנות בהזמנה</b></label><br>
            <?php //insert here the options for the select input of number of portions
              echo '<select required title="כמות" name="quantity" class="det w3-input w3-select w3-border w3-round" required> '
                 . '<option value="">בחר</option> ';
                for($i = $product['minQuant'] ; $i < $product['maxQuant']-$product['orderQuant'] ;$i++) {

                  if($i>1){
                    echo  '<option value=' .$i. '>' .$i . ' מנות </option>';
                  }else{
                    echo  '<option value=' .$i. '>מנה </option>';
                  }
              };
              ?>
            </select><br><br>
            <input type="radio" name="shipping" id="pickupRadio" onchange="shippingJS()" value="no"> <label class="w3-text-black">איסוף עצמי</label>
            <input type="radio" name="shipping" id="deliveryRadio" onchange="shippingJS()" value="yes" checked><label class="w3-text-black"> משלוח</label><br>
          </div>
          <div id="addressOrderInput">
            <label class="w3-text-grey clientName"><b>כתובת למשלוח</b></label>
            <div id="locationFieldOrder">
              <input class="w3-border w3-round-large autocompleteInput" id="autocompleteOrder"  name="inputAutocompleteOrder" placeholder= "הכתובת שלך" onFocus="initAutocomplete('autocompleteOrder')" type="text"></input>
            </div>
            <!--<input id="clientAdress" class ="det w3-input w3-border w3-round" type="text" name="CAdress" title="נדרשים תוים של אותיות בלבד" required>-->
          </div>

          <!--this table is none visible to the user, its just to calculate distance with the dish address-->
          <?php echo '<input type="hidden" name="prodHot_Level" id="prodHot_Level" value="'.howSpicy($product['picante']).'"></input>'//<!--this input is used to send the hot level of the product to the payment-->?>
          <input type="hidden" name="mapSRC" id="mapSRC" value=""></input>


          <input type="submit" class ="submit orderDi" id="submitBtnOrder" value="הזמן">
        </form>
        </div>


      <?php
        if (isset($_GET['status'])) {
          $page = $_SESSION['page'];
        }else{
          $page = $_POST['currPage'];
          $_SESSION['page'] = $page;
          echo '<script>console.log("$page: '.$page.'" )</script>';
          echo '<script>console.log("$_SESSION[page]: '.$_SESSION["page"].'" )</script>';
        }
        echo '<script>console.log("$page2: '.$page.'" )</script>';
        echo '<div  class="productInfo_container">'
        . '<div  class="productInfo_header">'
        . '<a href="index.php?page=' . $page . '" class="button" ><b>חזרה</b></a>'
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
        . '<p><b> שינויים אפשריים: </b></p>'
        . '<p id="pChang">' . $product['dChanges'] . '</p>'// changes of the dish
        . '<p><b> גודל המנה: </b>' . $product['dSize'] . '</p>'// size of the dish
        . '<p><b> רמת חריפות: </b>' . howSpicy($product['picante']) . '</p>'// hot_level of the dish
        . '<p><b> כמות מינימלית להזמנה: </b>' . $product['minQuant'] . '</p>'// min portions to order
        . '</div>'
        . '</div>'
        . '</div>';
      ?>
  <script type="text/javascript">
    window.onpageshow = init;
    function init() {
        var addres = ""+<?php echo "'.$chefsAddress.'"; ?>;
        document.getElementById('iFrameMap').src = ""+document.getElementById('iFrameMap').src + addres;
        document.getElementById('mapSRC').value = document.getElementById('iFrameMap').src;
        console.log(""+document.getElementById('iFrameMap').src);
    }

  </script>
  <div class="footer">
      <strong> &COPY;</strong>
      רזולוציה מומלצת: 768*1366
  </div>

      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdmACMDmBVH-ewHf-L2BBah6LYwBJ9Ma0&libraries=places&callback=initAutocomplete" async defer></script>
    </body>
</html>
