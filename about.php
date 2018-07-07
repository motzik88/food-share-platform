<!DOCTYPE html>
<?php session_start() ?>
<html lang="he">
    <head>
        <title>אודות </title>
		    <?php header("Content-type: text/html; charset=utf-8"); ?>
        <link rel="icon" type="PNG image (.png)" href="media/top2.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="Css/w3.css" rel="stylesheet" type="text/css"/>
        <link href="Css/style.php" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script src="js/newJS.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $("#about").addClass("highlite");
            });
        </script>
    </head>
    <body dir = rtl>
		    <?php require('menu.php'); ?>
        <?php require('login.php'); ?>
        <?php $_SESSION['timeout'] = time(); ?>
        <?php
		    if (isset($_SESSION['gender'])) {
            if ($_SESSION['gender'] === 'male') {
                $imageGender = 'media/foodmale.jpg';
            } else {
                $imageGender = 'media/foodfemale.jpg';
            }
        } else {
            $imageGender = 'media/foodundifined.jpg';
        }
        ?>
        <script>
        //push to buy by user in about
        function pushToBuy() {
            var gender = "<?php echo $_SESSION['gender'] ?>";
            var userName = "<?php echo $_SESSION['firstName'] ?>";

            if (gender === "male") {
                alert("היי " + userName + " לחץ על דף הבית כדי לחפש ולהזמין מנות");
            } else {
                alert("היי " + userName + "לצחי על דף הבית כדי לחפש ולהזמין מנות");
            }
        }
        </script>

        <div id = "body" class= "about_content">
          <div>
            <h1 calss="w3-center w3-opacity ">אודות</h1>
          <div>
          <table>
            <tr>
              <td>
                <div>
                  <span class = "">
                    <img src= "media/Sharing.jpg" class = "about_winery" alt="תמונה של אוכל בשותף">
                  </span>

                </div>
              </td>
              <td>
                <div>
                  <span>
                    <img src = "<?php echo $imageGender; ?>" onmouseover = "pushToBuy()" class = "newImageAbout" alt="אודות אתר">
                  </span>
                </div>
              </td>
            </tr>
            <tr>
              <div class="w3-container w3-text-black">
              </div>
              <div class=" w3-container " >
                <p class="about_txt">אנחנו קהילה של אוהבי אוכל. אנו רוצים לתת במה לאוהבי הבישול ולחבר אליהם את חובבי האוכל אשר רוצים לטעום מטעמים מיוחדים מדי יום.</p>
                <p class="about_txt">בתור שף תוכל לפתוח עמוד ובו תפרסם את כל המנות המדהימות של המטבח שלך ולחסוך את עלויות פתיחת מסעדה.</p>
                <p class="about_txt">בתור משתמש כל שנשאר לך לעשות זה לחפש את אותם מטעמים ביתיים ולבחור במנה המתאימה לך.</p>
                <p class="about_txt">גם הטבחים וגם הסועדים נהנים מהחיבור בין אוהבי אוכל.</p>
              </div>
            </tr>
          </table>
        </div>
        <a href="#" class="back-to-top"></a>
        <div class="footer">
            <strong> &COPY;</strong>
           רזולוציה מומלצת 1080*1920
        </div>
    </body>
</html>
