<!DOCTYPE html>
<?php session_start() ?>
<html lang="he">
    <head>
        <?php header("Content-type: text/html; charset=utf-8"); ?>
        <title>חיפוש</title>
        <link rel="icon" type="PNG image (.png)" href="media/top2.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="Css/w3.css" rel="stylesheet" type="text/css"/>
        <link href="Css/style.php" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <script src="js/newJS.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $("#index").addClass("highlite");
            });
        </script>
    </head>

    <body dir = "rtl">
        <?php require('menu.php');?>
        <?php require('login.php'); ?>
        <?php $_SESSION['timeout'] = time(); ?>
        <?php



        if (isset($_SESSION['registered'])) {
            $today = date("m-d");
            $yourDay = $_SESSION['birthday'];
            $yourDay = substr($yourDay, 5);
            if ((strcmp("$today", "$yourDay") == 0)) {

                echo '<div class="w3-container w3-center"><img class="birthdayCake background-image " src="media/birthday.gif" alt="ברוכים הבאים "></div>';
            };
        };

        $con = mysqli_connect("localhost", "root", "", "applepie");
        #openning the connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_set_charset($con, "utf8");


        //take the information needed to fill the search preview (start from the min distance to max)

        if (isset($_POST['firstSearchButton']) || isset($_POST['secondSearchButton']) ) { /*<------------------------------------make a js function that when the secont search button is pressed then the 'advance' = 'yes' and if the first seach button is presed then 'advance' = 'no'*/
          unset($_SESSION['disranceArray']);
          if(isset($_POST['secondSearchButton'])){
            //prepre the advance search parameters in string for the sql
            //create empty strings
            $whereSTRpref = "";
            $whereSTRcat = "";
            $whereSTRspi = "";
            $whereSTR = ""; //create "WHERE" strings for the sql query

            if(isset($_POST['selectFoodType'])){//take the food categorie if inserted
              $categories = $_POST['selectFoodType'];
              $whereSTRcat = 'categories.'.$categories. ' = 1 ';
            };

            if(isset($_POST['pref'])){
              $alerges = $_POST['pref']; //take the preferences if inserted
              if(!empty($alerges)){
                $N = count($alerges);
                for($i=0; $i < $N; $i++){
                  $whereSTRpref .= 'types.'.$alerges[$i]. ' = 1 ' ;
                  if($i!=($N-1)){
                    $whereSTRpref .= 'and ';
                  };
                };
              };
            };

            if(isset($_POST['hot_level'])){
              if($_POST['hot_level']!=""){//take the spicy level if inserted
                $spicy = $_POST['hot_level'];
                $whereSTRspi = 'types.picante = ' .$spicy;
              };
            };

            //unite the where strings if not empty
            if($whereSTRcat != ""){
              $whereSTR .=  $whereSTRcat;
              if($whereSTRpref != ""){
                $whereSTR .= 'and '. $whereSTRpref;
                if($whereSTRspi != ""){
                  $whereSTR .= 'and '.$whereSTRspi;
                }
              }elseif ($whereSTRspi != "") {
                $whereSTR .= 'and '.$whereSTRspi;
              }
            }elseif($whereSTRpref != ""){
              $whereSTR .= $whereSTRpref;
              if($whereSTRspi != ""){
                $whereSTR .= 'and '.$whereSTRspi;
              }
            }elseif($whereSTRspi != ""){
              $whereSTR .= $whereSTRspi;
            };
            $whereSTR = mysqli_real_escape_string($con, $whereSTR);
            if($whereSTR != ""){
              $sqlFull = "SELECT ad.dID, ad.dEmail, ad.dInstace, ad.price,ad.address,  dishes.dName, dishes.dPicture, users.Fname, ad.orderQuant, ad.maxQuant "
                       . "FROM (SELECT * FROM dishinsearch WHERE tillDay > CURRENT_DATE() and orderQuant < maxQuant) as ad JOIN dishes on ad.dID "
                       . "= dishes.dID and ad.dEmail = dishes.dEmail LEFT JOIN types on dishes.dID = types.dID and dishes.dEmail "
                       . "= types.tEmail LEFT JOIN categories on dishes.dID = categories.dID and dishes.dEmail = categories.cEmail join users on types.tEmail = users.Email "
                       . "WHERE " .$whereSTR."";
                       echo '<script>console.log("if adv sheilta" )</script>';
                       echo '<script>console.log("'.$whereSTR.'" )</script>';
            }else{
              $sqlFull = "SELECT ad.dID, ad.dEmail, ad.dInstace, ad.price, ad.address ,dishes.dName, dishes.dPicture, users.Fname, ad.orderQuant, ad.maxQuant "
                       . "FROM (SELECT * FROM dishinsearch WHERE tillDay > CURRENT_DATE() and orderQuant < maxQuant) as ad JOIN dishes on ad.dID "
                       . "= dishes.dID and ad.dEmail = dishes.dEmail LEFT JOIN types on dishes.dID = types.dID and dishes.dEmail "
                       . "= types.tEmail LEFT JOIN categories on dishes.dID = categories.dID and dishes.dEmail = categories.cEmail join users on types.tEmail = users.Email";
                       echo '<script>console.log("else adv sheilta" )</script>';
            };

            $_SESSION['advance'] = 'yes'; //-------------------------see if needed
            $querySqlFull = mysqli_query($con, $sqlFull);

          }elseif(isset($_POST['firstSearchButton'])){//prepare the sql query for the siple search
            unset($_SESSION['disranceArray']);
            $sqlFull = "SELECT ad.dID, ad.dEmail, ad.dInstace, ad.price,ad.address , dishes.dName, dishes.dPicture, users.Fname, ad.orderQuant, ad.maxQuant FROM "
                    .  "(SELECT * FROM dishinsearch WHERE tillDay > CURRENT_DATE() and orderQuant < maxQuant) as ad JOIN dishes on ad.dID = dishes.dID and ad.dEmail = dishes.dEmail join users on dishes.dEmail = users.Email";


              $_SESSION['advance'] = 'no';//-------------------------see if needed
              $querySqlFull = mysqli_query($con, $sqlFull);
              echo '<script>console.log("elseif adv sheilta" )</script>';
          }
        }
        //first time in page => run the query
        elseif(count($_GET) == 0){
          $sqlFull = "SELECT ad.dID, ad.dEmail, ad.dInstace, ad.price,ad.address , dishes.dName, dishes.dPicture, users.Fname, ad.orderQuant, ad.maxQuant "
                   . "FROM (SELECT * FROM dishinsearch WHERE tillDay > CURRENT_DATE() and orderQuant < maxQuant) as ad JOIN dishes on ad.dID = "
                   . "dishes.dID and ad.dEmail = dishes.dEmail join users on dishes.dEmail = users.Email";
          $querySqlFull = mysqli_query($con, $sqlFull);
          echo '<script>console.log("simple sheilta" )</script>';
        }
        //echo '<script>console.log("'.$sqlFull.'" )</script>';

        $distanceArray = array();//---------------------------------------------see if need to be created outside the if/while

        //if $_get is empty => is the first time on search or the user search with the button (post method)
        echo '<script>console.log("'.count($_GET).'" )</script>';
        if(count($_GET) == 0){//calculate distance -> insert dID, dEmail, dInstance and distance to an array orderd by distance
          echo '<script>console.log("im am in the get == 0" )</script>';
          $insertIndex = 0;
          while ($row = mysqli_fetch_array($querySqlFull)) {
            $addressOrigin = $row['address'];
            echo '<script>console.log("'.$addressOrigin.'" )</script>';
            if(isset($_REQUEST['inputAutocomplete'])){
              $addressDestination = $_POST['inputAutocomplete'];
              echo '<script>console.log("$addressDestination: '.$addressDestination.'" )</script>';
            }else{
              $addressDestination = "מצדה 1, באר שבע, ישראל"; //check if it works
            }

            echo '<script>console.log("$addressDestination: '.$addressDestination.'" )</script>';

            $from = urlencode($addressOrigin);
            echo '<script>console.log("$from: '.$from.'" )</script>';
            $to = urlencode($addressDestination);
            echo '<script>console.log("$to: '.$to.'" )</script>';
            $data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to");
            $data = json_decode($data);
            //echo '<script>console.log("$data: '.$data.'" )</script>';
            $time = 0;
            $distance = 0;
            foreach($data->rows[0]->elements as $road) {
              $distance += $road->distance->text;
            };


            $distanceCalculated = $distance;
            echo '<script>console.log("$distanceCalculated: '.$distanceCalculated.'" )</script>';
            //$distance = calcDistance($addressOrigin, $addressDestination); //---------------------------------------------------צריך להכין את הפונקציה הזאת
            //$distance=10-$insertIndex;
            //insert the result in an Associative array inside an index array
            //header('Content-type: image/jpeg, image/gif, image/PNG');
            $distanceArray[$insertIndex] = array('dish'=> array('dID'=> $row['dID'], 'dEmail'=>$row['dEmail'], 'Fname'=>$row['Fname'], 'dInstace'=>$row['dInstace'], 'dName'=>$row['dName'], 'price'=> $row['price'], 'dPicture'=>$row['dPicture'], 'orderQuant'=>$row['orderQuant'], 'maxQuant'=>$row['maxQuant'] ), 'distance'=>$distanceCalculated);
            $insertIndex = $insertIndex + 1; // incress the index insertation

          };

          //order array of distances
          if(!empty($distanceArray)){
            usort($distanceArray, function ($a,$b){
                      $disA = $a['distance'];
                      $disB = $b['distance'];
                      return $disA - $disB;}
            );


            //errase from the distance array dishes that distance > radius (default = 30km)

            if(isset($_POST['searchKm'])){
              $radius = $_POST['searchKm'];
              echo '<script>console.log("radius = '.$radius.'" )</script>';
            }else {
              $radius = 50;
            };
          };

          //take off the dishes that the distance is grater than the radius (50 for default)
          if(!empty($distanceArray)){
            foreach ($distanceArray as $i => $v) {
              if ($v['distance'] > $radius) {
                  unset($distanceArray[$i]);
              };
            };
            $_SESSION['disranceArray'] = $distanceArray;
          }else{
            $_SESSION['disranceArray'] = array();
            };
        };


        (count($_GET) == 0) ? $page = 1 : $page = $_GET['page'];
        #setting the page number

        $rowSpan = 3;
        $startRow = $rowSpan * ($page - 1);

        $totalRows = count($_SESSION['disranceArray']);

        $lastPage = ceil($totalRows / $rowSpan);


        echo '<div class="products_container">'
        . '<br>'
        . '<ul class="photo-grid" id="photo-gridID">';
        echo '<h1>';
        if(empty($distanceArray) && (count($_GET)==0)) {
                echo 'אין מנות להציג';
        }else{
            echo ' תוצאות החיפוש הן: ';
          };
        echo '</h1>';
        for ($counter = $startRow ; $counter<($startRow+3) && $counter<$totalRows;$counter++) {
            $tempRow = $_SESSION['disranceArray'][$counter]['dish'];
            #fetching each row as assoc and numeric array
            echo '<li>'
            . '<form method="post" action="orderDish.php">'
            . '<div class="productWrapper"><article>'
            . '<img class="productPic" src="data:image/jpeg;base64,'.base64_encode( $tempRow['dPicture'] ).'" height="230" width="250" alt="dish image goes here!">' //dish image
            . '<h2>'
            . $tempRow['dName'] //dish name
            . '</h2>'
            . '<h3>'
            . $tempRow['Fname'] //chefs name
            . '</h3>'
            . '<p>'
            . '<strong>מחיר: </strong>' . $tempRow['price'] . ' ש"ח'// price
            . '</p>'
            . '<p>'
            . '<b>כמות: </b>' . $tempRow['maxQuant'] . '/ '.$tempRow['orderQuant'].' <br> '
            . '<b>מרחק: </b> ' . $_SESSION['disranceArray'][$counter]['distance'] . ' ק"מ'
            . '<input type="hidden" name="dID" value="'.$tempRow['dID'].'">'//------------------------------------------------------dish ID
            . '<input type="hidden" name="dEmail" value="'.$tempRow['dEmail'].'">'//------------------------------------------------------chef email
            . '<input type="hidden" name="dInstace" value="'.$tempRow['dInstace'].'">'//------------------------------------------------------dish instance
            . '<input type="hidden" name="currPage" value="'.$page .'">'//------------------------------------------------------current page
            . '</p>'
            . '</article>'
            . '<input type="submit" class ="submit orderDi" id="orderDiqo" value="הזמן">'
            . '</div>'
            . '</form>'
            . '</li>';
        }

        #set the nav arrows
        if(!empty($distanceArray) || !empty($_SESSION['disranceArray']) ) {
          $url = $_SERVER["PHP_SELF"];

          $backPage = $page - 1;
          $nextPage = $page + 1;
          if ($page != 1) {
              echo "<a href='" . $url . "?page=1'><img src='media/arrow-right-double.png' class='toTheRightMovePage'></a>";
              echo "<a href='" . $url . "?page=" . $backPage . "'><img src='media/arrow-right.png' class='toTheRightMovePage'></a>";
          }
          if ($page != $lastPage) {
              echo "<a href='" . $url . "?page=" . $lastPage . "'><img src='media/arrow-left-double.png' class='toTheLeftMovePage'></a>";
              echo "<a href='" . $url . "?page=" . $nextPage . "'><img src='media/arrow-left.png' class='toTheLeftMovePage'></a>";
          }
        };
        mysqli_close($con);
        echo '</ul>'
        . '</div>';


        ?>
        <form method ="post" id="searchForm" action="index.php">
            <div class="w3-container w3-light-grey" id="side-stuff">
              <h3 class="w3-center">חיפוש לפי מרחק</h3>

              <label class="w3-text-grey searchTitle" ><b> כתובת</b></label>
              <br>
              <div id="locationField">
                <input class="w3-border w3-round-large" id="autocomplete" name="inputAutocomplete" required placeholder= "הכתובת שלך" onFocus="initAutocomplete('autocomplete')" type="text"></input>
              </div>
              <label class="w3-text-grey searchTitle" ><b>בחר מרחק מקסימלי</b></label>
              <br>
              <select form="searchForm" id="searchKM" required name="searchKm"  class=" w3-border w3-round-large  ">
                <option data-default="" disabled="disabled" selected="" value="30">רדיוס</option>
                <option value="1">1 ק"מ</option>
                <option value="2">2 ק"מ</option>
                <option value="5">5 ק"מ</option>
                <option value="10">10 ק"מ</option>
                <option value="20">20 ק"מ</option>
                <option value="40">40 ק"מ</option>
                <option value="50">50 ק"מ</option>
                <option value="80">80 ק"מ</option>
                <option value="100">100 ק"מ</option>
                <option value="120">120 ק"מ</option>
                <option value="140">140 ק"מ</option>
                <option value="160">160 ק"מ</option>
              </select>
              <br><br>

            <input type="submit" class="form-btn" value="&#xf002;" name="firstSearchButton" id="firstSearchButton" ></input>

              <h3 class="advancedSearch w3-center" id="advText"  >חיפוש מתקדם </h3>
              <div id="advSearch" > <!--style="display:none;"-->
                <select form="searchForm" name="selectFoodType" class="w3-border w3-round-large w3-select">
                  <option value="" disabled selected> קטגוריה</option>
                  <option value="italia"> איטלקי </option>
                  <option value="mexico"> מקסיקני </option>
                  <option value="china"> סיני </option>
                  <option value="israel"> ישראלי </option>
                  <option value="thailandia">תאילנדי </option>
                  <option value="sudAmerica">דרום אמריקאי </option>
                  <option value="india"> הודי </option>
                  <option value="francia"> צרפתי </option>
                  <option value="otro"> אחר</option>
                </select>
                <table>
                  <tr>
                    <td> <input class="w3-check" type="checkbox" name="pref[]" value="kosher"><span class="lineCheck">&nbsp; כשר </span></td>
                    <td> <input class="w3-check" type="checkbox" name="pref[]" value="vegeterian"><span class="lineCheck" >&nbsp; צימחוני </span></td>
                  </tr>
                  <tr>
                    <td> <input class="w3-check" type="checkbox" name="pref[]" value="glutenFree"><span class="lineCheck">&nbsp; ללא גלוטן  </span></td>
                    <td> <input class="w3-check" type="checkbox" name="pref[]" value="vegan"><span class="lineCheck">&nbsp; טבעוני </span></td>
                  </tr>
                  <tr>
                    <td> <input class="w3-check" type="checkbox" name="pref[]" value="lactoseFree"><span class="lineCheck">&nbsp; ללא לקטוז </span></td>
                    <td> <input class="w3-check" type="checkbox" name="pref[]" value="penautFree"><span class="lineCheck">&nbsp; ללא בוטנים </span></td>
                  </tr>
                </table>
                <br>

                <select  form="searchForm" class="w3-select w3-border w3-round-large" name="hot_level">
                  <option value="" disabled selected>רמת חריפות</option>
                  <option value="1">לא חריף</option>
                  <option value="2">קצת חריף</option>
                  <option value="3">חריף</option>
                  <option value="4"> חריף אש</option>
                  <option value="5"> חריף מוגזם</option>
                </select>

                <br><br>
                <input type="submit" class="form-btn" value="&#xf002;" name="secondSearchButton" id="secondSearchButton"></input>
                <br>
                <input type="hidden" name="isAdvSearch" id="isAdvSearch" value="no"></input><!--this input is to set if the seach is adv or regular-->
              </div>
           </form>

        <input type="hidden" name="hidden_input_dis" id="hidden_input_dis" value=""></input>
        <!--script must appear inside current html document-->

        <script>
            var amountScrolled = 150;
            $(window).scroll(function () {
                if ($(window).scrollTop() > amountScrolled) {
                    $('a.back-to-top').fadeIn('slow');
                } else {
                    $('a.back-to-top').fadeOut('slow');
                }
            });
            $('a.back-to-top').click(function () {
                $('html, body').animate({scrollTop: 0}, 700);
                return false;
            });


        </script>
        <div class="footer">
            <strong> &COPY;</strong>
            רזולוציה מומלצת: 768*1366
        </div>


        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&key=AIzaSyBdmACMDmBVH-ewHf-L2BBah6LYwBJ9Ma0&libraries=places&callback=initAutocomplete" async defer></script>
    </body>
</html>
