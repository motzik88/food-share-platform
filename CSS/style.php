<?php header("Content-type: text/css; charset: UTF-8"); ?>
@font-face{
    font-family: "Tahoma", Georgia, Serif;
}
<?php session_start(); ?>
<?php
if (isset($_SESSION['gender'])) {
    if ($_SESSION['gender'] === 'male') {
        $colorGender = '#6495ED';
    } else {
        $colorGender = '#F08080';
    }
} else {
    $colorGender = 'orange';
}
if (isset($_SESSION['registered'])) {
    $yearBirth = substr($_SESSION['birthday'], 0, 4);
    if ($yearBirth < 1970) {
        //if you are old
        $fontSizeyear = '35px';
    } else {

        //if you are young
        $fontSizeyear = '15px';
    }
} else {
    //if you are not regisrtietd
    $fontSizeyear = '25px';
}
#check if TTL hasn't passed
if (isset($_SESSION['registered'])) {
    if (time() - $_SESSION['loginTime'] < 10) {
        $colorMenu = '-webkit-gradient(linear, left top, left bottom, from(red), to(yellow))';
    } else if (time() - $_SESSION['loginTime'] < 20) {
        $colorMenu = '-webkit-gradient(linear, left top, left bottom, from(red), to(blue))';
    } else if (time() - $_SESSION['loginTime'] < 30) {
        $colorMenu = '-webkit-gradient(linear, left top, left bottom, from(yellow), to(green))';
    } else {

        $colorMenu = '-webkit-gradient(linear, left top, left bottom, from(#333333), to(#111111))';
    }
} else {
    $colorMenu = '-webkit-gradient(linear, left top, left bottom, from(#333333), to(#111111))';
}
?>

/*--------------------------------------- menu-------------------------------------------------*/

body, h1, h2, h3, h4, h5, h6{
    font-family: "Tahoma", Georgia, Serif;
    padding: 0px;
    margin: 0px;
}

/*---------------------------------------index_css-------------------------------------------------*/

.wrapper{
    position: relative;
    width: 82.5%;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
    top: 60px;
    height: 583px;;
    overflow-y: hidden;
    overflow: hidden;
}
.background-image{
    width:50%;
    right: 200px;
	  height: 400px;

}
#imageDivBirth{
      right: 200px;
}
.birthdayCake{
margin-top: 5%;
}

.openMenu{
    position:fixed;
    right: 2.3%;
    width: 13%;
    top: 20%;
}
.kitzurim_container{
    position: relative;
    width: 100%;
    list-style-type: none;
    padding-right: 0;
    padding-left: 0;
    font-size: 16px;
    text-align: center;
}
.open_menu_container{
    position: relative;
    border: 1px solid Navy   ;
    margin-bottom: 10px;
    width:110%;
    height: 35px;
    vertical-align: middle;
    line-height: 2;
}
.open_me{
    position: fixed;
    top: 17%;
    background: rgba(100,0,100,0.5);
    font-size: 16px;
    height: 450px;
    width: 64.2%;
    display:none;
    right: 18.2%;
    color: white ;
}
.open_menu_link{
    text-decoration: none;
    width: 100%;
}
.open_menu_arrow{
    position: relative;
    float: left;
    left: 2%;
}
.scrollingBar{
    position: fixed;
    height: 250px;
    width: 13%;
    float: right;
    right: 2.3%;
    top: 65%;
    text-align: center;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    border: 1px solid black;
    text-decoration: none;
    overflow: hidden;

}

.scroll-up p:hover {
    animation-play-state: paused;
    text-decoration: underline;
}
.scroll-up p{
    position: fixed;
    height: 200px;
    width: 13%;
    margin: 0;
    line-height: 1;
    text-align: center;
    transform:translateY(100%);
    animation: scroll-up 4s linear infinite;
}

@keyframes scroll-up {
    0%   {
        transform: translateY(100%);
    }
    100% {
        transform: translateY(0%);
    }
}
.scrollingBarTitle{
    position: fixed;
    height: 30px;
    width: 13%;
    float: right;
    right: 2.3%;
    top: 60%;
    text-align: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    border: 1px solid black;
    opacity: 0.95;
    filter: alpha(opacity=95);
    background: IndianRed  ;
    font-size: 20px;
    z-index: 50;
}
.hide_help{
    position: fixed;
    height: 60px;
    top: 60%;
    float: right;
    z-index: 50;
}
.textMrq{
    text-decoration: none;
}
.textMrq:hover{
    text-decoration: underline;
}
.mesaprim_open{
    width: 90%;
    margin-left: auto;
    margin-right: auto;

}

.mesaprim_open h2{
margin-bottom: 0;
margin-top: 0;
text-decoration: underline;
}
.mesaprim_open li{
    font-size: 85%;
    text-align: right;
    margin-bottom: 5px;
    margin-top: 5px;
	text-align: right;
	text-align: right;
}


.happyWinery_open{
    width: 90%;
    margin-left: auto;
    margin-right: auto;
    font-size: 90%;
    text-align: right;
}
.happyWinery_open h2, .happyWinery_open h3{
    text-align: center;
	text-decoration: underline;
}ext-align: center;
}
.goout_open{
    width: 60%;
    margin-left: auto;
    margin-right: auto;
}
.goout_open h2{
    text-decoration: underline;
}
.hazon_open{
    width: 90%;
    margin-left: auto;
    margin-right: auto;
    text-align: right;
}
.hazon_open p{
    margin-bottom: 5px;
    margin-top: 3px;
}
.hazon_open h4{
    margin-bottom: 0;
    margin-top: 0;
    text-decoration: underline;
}
.not_a_link{
    cursor: default;
}

/*---------------------------------------menu_css------------------------*/
li.menu{
    display: inline-block;
}

.navlist a{
    padding: 3px 15px 3px;
}
div.menu_pages{
    overflow: hidden;
    overflow-x: hidden;
    overflow-y: hidden;
    position: fixed;
    height: 70px;
    width: 100%;
    top: 0;
    left: 0;
    background:  <?php echo $colorMenu; ?>;
    font-size: 15px;
    z-index: 999;
    vertical-align: middle;
}
.container{
    position: relative;
    top:70px;
}
.navlist{
    vertical-align: middle;
    width: 85%;
    margin: 25px 0 0 0;
}
.navlist a:link, .navlist a:visited{
    color: white;
    text-decoration: none;
}
.navlist > li:hover > a{
    background-color: transparent;
border-top: 2px solid  <?php echo $colorGender; ?>;
border-bottom: 2px solid  <?php echo $colorGender; ?>;
}
#nav a.highlite{
    background-color: transparent;
    color: DeepSkyBlue ;
border-top: 2px solid <?php echo $colorGender; ?> ;
border-bottom: 2px solid <?php echo $colorGender; ?> ;
}
.logo{
    width: 15%;
    height: auto;
    float: left;
    position: fixed;
    left: 1.5%;
    top: 70px;
    z-index: 1000;
    padding-top: 0;
}
#footer{
    min-height: 100px;
    margin-top: 3%;
}
@viewport{
    zoom: 1.0;
    width: extend-to-zoom;
}

#side-stuff {
  position: fixed;
  float: right;
  width: 22%;
  top: 12%;
  display: block;
  height: auto;
  -webkit-box-shadow: 0 1px 2px #666666;
}

#session {
    position: fixed;
    cursor: pointer;
    display: inline-block;
    height: 40px;
    width: 180px;
    margin-right: auto;
    margin-left: auto;
    float: left;
    left: 2%;
    top: 400px;
    background-color: #202020;
}

a#signin-link {
    color: #bababa;
    position: relative;
    float: left;
    font-size: 10px;
    font-style: normal;
    margin-right: 4px;

}



#signin-dropdown {
    display: none;
    background-color: #202020;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    box-shadow: 0 1px 2px #666666;
    position: relative;
    height: 150px;
    top: 250px;
}

#enter_pos{
    position: relative;
    top: 10px;
    right: 45px;
    font-size: 15px;
    padding: 3px 0 3px;
    color: white;
}
#signin-dropdown form {
    cursor: pointer;
    padding: 10px;
    text-align: right;
}

#signin-dropdown .textbox span {
    color: #BABABA;
}
fieldset {
    border: none;
}

form.signin {
    display: block;
    padding-bottom: 7px;
    width: 180px;
}

form.signin .textbox span {
    display: block;
}

form.signin , form.signin span {
    font-size: 11px;
    line-height: 18px;
}
input{
    margin-bottom: 10px;
}
form.signin .textbox input {
    border-bottom: 1px solid #333;
    border-left: 1px solid #000;
    border-right: 1px solid #333;
    border-top: 1px solid #000;
    -webkit-border-radius: 3px;
    padding: 6px 6px 4px;
}
.connect{
    right: 10px;
}
.button {
    border-color: #444;
    background-color: #444;
    border-width: 1px;
    border-radius: 4px;
    color: white;
    cursor: pointer;
    display: inline-block;
    padding: 4px 7px;
    margin: 0;
    font-size: 12px;
	top: 400px;
}
#signin-link:link{
    text-decoration: none;
}
#enter_pos:active{
    background-color: transparent;
    border-top: 2px solid orange;
    border-bottom: 2px solid orange;
}
#enter_pos:hover{
    background-color: transparent;
    border-top: 2px solid orange;
    border-bottom: 2px solid orange;
}
.email{
    color: black;
}
.active-links{
    position: fixed;
    left: 2%;
    top: 200px;
}
.submit{
    position: relative;
    margin-left: auto;
    margin-right: auto;
    top: 5px;
    background: url("media/button.png") ,left top;
    cursor:pointer;
    width: 100px;
    height:27px;
    border-radius: 3px;
    outline:0;
    color:white;
    font-size: 14px;
}
.submit:hover{
    box-shadow: inset 0 0 0 1px #27496d,0 5px 15px #193047;
}
.submit:active{
    box-shadow: inset 0 0 0 1px #27496d, inset 0 5px 30px #193047;
}
.left_button{
    float:left;
}
.footer{
    float: left;
    position: fixed;
    top:95%;
    left: 2%;
}
.welcomeUser{
color: white;
position: fixed;
float: left;
width: 180px;
display: block;
height: 40px;
background: -webkit-gradient(linear, left top, left bottom, from(#333333), to(#111111));
-webkit-box-shadow: 0 1px 2px #666666;
left: 2%;
top: 230px;
z-index: 999;
margin-top:100px;
}
/*log out link*/
.welcomeUser button{
color: white;
vertical-align: middle;
margin-top:8px;
}
/*-------------------------------------------------about_css-------------------------------------------------*/
.about_content{
position:relative;
width: 80%;
top: 35px;
right:2%;
}

.about_txt_container{
    width: 60%;
    position:relative;
}
.about_text{
    font-size: 18px;
    margin: 20px;
}
.about_winery{
    float: left;
    border-radius: 100px;
    height: 300px;
}

.newImageAbout{
	border-radius:50px;
  border-radius: 100px;
  height: 300px;
}
/*-------------------------------------------------products_css-------------------------------------------------*/
.searchFilters {
    width: 22%;
    position: fixed;
    top: 12%;
    right: 1%;

}
.searchTitle{
  text-align: right;
}

#autocomplete{
  width: 100%;
}

#searchKM{
  float: right;
  height: 28px;
}
#advSearch{
    display:none;
}


input.form-btn {
    background-color: #898e8f;
    background-image: -webkit-linear-gradient(bottom,#0f92cf,#13acf3);
    background-image: linear-gradient(0deg,#0f92cf 0,#13acf3);
    border: 0 none!important;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    height: 35px;
    padding: 0 10px;
    text-shadow: 0 0 1px rgba(0,0,0,.6);
    width: 80px;
    margin: auto;
    display:block;
    font-family: FontAwesome, 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
#secondSearchButton{
    display:block;
}
.advancedSearch{
  cursor: pointer;
}


#autocomplete{
  width: 100%;
}
#searchKM{
  float: right;
  height: 28px;
}

.filterProducts{
position: fixed;
top: 20%;
right: 5%;
}
.filterProducts ul{
list-style: none;
}

.products_container{
    /* השטח עליו משתרעים מסגרות המוצרים*/
    position: relative;
    width: 70%;
    left: 10%;
    float: left;
    margin-top: 3%
}
.products_container h4{

    text-align: center;
}

#photo-gridID{
  list-style-type: none;
}
.photo-grid figure {
    width: 160px;
    height: 120px;
    overflow: hidden;
    position: relative;
}
.photo-grid figcaption {
    background: rgba(0,0,0,0.8);
    color: white;
    display: table;
    height: 100%;
    left: 0;
    opacity: 0;
    position: absolute;
    right: 0;
    top: 0;
    z-index: 100;
}
.photo-grid figure:hover figcaption {
    opacity: 1;
}

.photo-grid img {
    height: auto;
    transition: all 300ms;
    max-width: 100%;
}

.photo-grid figure:hover img {
    transform: scale(1.4);
}
.photo-grid figcaption p {
    display: table-cell;
    font-size:0.3cm;
    position: relative;
    top: -40px;
    width: 289px;
    transition: all 300ms ease-out;
    vertical-align: middle;
}
.photo-grid figcaption {
    display: table;
    height: 100%;
    opacity: 0;
    position: absolute;
    top: 0;
    -webkit-transition: all 300ms;
    -webkit-transition-delay: 100ms;
    z-index: 100;
}
.photo-grid li:hover figcaption p {
    -webkit-transform: translateY(40px);
}
.tableContainer th{
text-decoration: underline;
}
.tableContainer{
    border: 2px solid;
    text-align:center;
}
.quantity{
margin-right: 8px;
}

.productWrapper{
border: 1px solid;
margin-top: 1%;
margin-left: 20%;
}
.productWrapper article{
margin-right: 3%;
margin-left: 3%;
}
.productWrapper a{
margin-right: 10%;
}
.productWrapper header{
font-size: 125%;
font-weight: bold;
margin-right: 40%;
margin-top: 2%;
}

.productWrapper h2{
font-weight: bold;
text-align: center;
margin-top: 1%;
}
.productWrapper h3{
text-align: center;
}
.orderDi{
margin-right: 40%;
top: 0px;
}
#orderDi{
margin-right: 40%;
top: 0px;
}
#orderDiqo{
margin-right: 40%;
top: 0px;
}


.infoPic{
width: 6%;
margin-left: auto;
margin-right: 35%;
}
.productPic{
width: 23%;
height: auto;
float: left;
margin-left: 5%;
}
.productAmount{
width: 10%;
}
.addItem{
margin-right: 2%;
top: 0px;
}

.toTheLeftMovePage{
float:left;
margin-left:15%;
width: 5%;
height: auto;
}

.toTheRightMovePage{
margin-right:7%;
width: 5%;
height: auto;
}
#address{
  display: block;
}
/*-------------------------------------------------back_to_top_css-------------------------------------------------*/
a.back-to-top {
    display: none;
    width: 100px;
    height: 60px;
    text-indent: -9999px;
    position: fixed;
    z-index: 999;
    right: 13px;
    bottom: 30px;
    background: orange url(media/up2.png) no-repeat center 1%;
    border-radius: 30px;
}

/*-------------------------------------------------gallery_css-------------------------------------------------*/

.gallery_container{
    position: relative;
    top: 70px;
    right: 3%;
}
.picture_gallery_content{
width: 50%;
cursor: pointer;
}
.picture_gallery_content ul{
list-style-type: none;
}
.picture_gallery_content li{
    position: relative;
    float: right;
    left: 2%;
    width: 180px;
    display: block;
    margin-right:20px;
    margin-bottom: 20px;
}
.picture_gallery_content img{
-webkit-transition: all .2s ease-out;
}
.picture_gallery_content img:hover{
    -webkit-transition: all .2s ease-out;
    box-shadow: 10px 10px 10px rgba(0,0,0,0.5);
}

.gallery_container img{
border-radius: 8px;
}
.big_pic{
    width: 30%;
    height: 40%;
    float:left;
    position: fixed;
    left: 18%;
    top: 20%;
}
.small_pics_design{
    width: 150px;
    height: 110px;
}

/*-------------------------------------------------contact---------------*/

.contact_container{
    width: 75%;
    position: relative;
    top: 70px;
    right: 8%;
}
.make_contact{
margin-bottom: 0;
}
.contact_address{
font-weight: bold;
font-size: <?php echo $fontSizeyear; ?>;
}

.contact_details{
    padding: 0px 5px 0px 0px;
    vertical-align: top;
}

.fax_pic{
    position: relative;
    top: 10px;
}
.fax_number{
    position: relative;
    top: 10px;
    right: 5px;
}
.mail_pic{
    position: relative;
    top: 20px;
}
.mail_add{
    position: relative;
    right: 6px;
    top: 18px;

}

.msg-wrapper{
	width: 50%;
}
p {
	margin: 0 0 0 0;
	height: 35px;
}
.det{
	max-width: 50%;
	margin-top: 5px;
	margin-bottom: 5px;
  float: right;
  max-height: 35px;
  padding-top:1px;
  padding-bottom:1px;
  display: inline-block;
}

textarea{
	max-width: 80%;
}
/*-------------------------------------------------payment_css-------------------------------------------------*/
.payment_container{
    font-size: 14px;
    width: 76%;
    position: relative;
    top: 80px;
    right: 8%;
	font-weight: bold;
}

.creditCard{
	width: 50px;
	height: 40px;
}
.creditCardRadio{
	position: relative;
	top: -1px;
	right: 16px;
}
.visa{
	position: absolute;
	width: 50px;
}
.master{
	position: absolute;
	width: 50px;
	right:100px;
}
.diners{
	position: absolute;
	width: 50px;
	right: 200px;
}
.american{
	position: absolute;
	width: 50px;
	right:300px;
}
.paymet_inputSize{
	max-width: 25%;
	margin-top: 5px;
	margin-bottom: 5px;
}
.paymet_selectorSize{
	max-width: 12%;
	margin-top: 5px;
	margin-bottom: 5px;
	float: right;
}
/*------------------------------------------------tanks------------------*/
.move {
    position: relative;
    -webkit-animation: mymove 5s infinite; /* Chrome, Safari, Opera */
    animation: mymove 5s infinite;
    height: 120px;
}
@-webkit-keyframes mymove {
	from {right: 0px;}
	to {right: 300px;}
}
.thankYouContainer{
	margin-top: 5%;
	margin-right: 5%;
}
/*-------------------------------------------------new_user_css-------------------------------------------------*/
.signInNewUser{
    position:relative;
    top: 90px;
    width: 65%;
    right:10%;
}
.newUserForm_pos{
	position: relative;
	top:30px;
}
select{
	float: left;
	min-height: 22px;
	margin-bottom: 5px;
	margin-top: 5px;
}
.newUserForm_pos input{
	float: left;
	max-height: 22px;
	margin-bottom: 5px;
	margin-top: 5px;
}
#phoneNumber{
	max-width: 120px;
}
#dateofBirth{
	width: 173px;
}
.leftCell{
	padding-left: 20px;
}
.checkAd{
	margin-left: 40%;
}
/*-------------------------------------------------order_tour_css-------------------------------------------------*/
.order_tour_container{
    position: relative;
    width: 70%;
    right: 5%;
}

.ordgenized_tour{
	margin-top:7%;
	width: 30%;
}
.tour_picture{
	position:relative;
	margin-right: 40%;
    float: right;
	bottom:200px;
}

.circle{
	border-radius: 50px;
}

.order_tour_btn_pos{
    position: absolute;
    top: 110%;
    left: 80%;
}
/*-------------------------------------------------product_info_css-------------------------------------------------*/
.productInfo_container{
	width: 50%;
	margin-right: 28%;
	margin-top: 7%;
}

.productInfo_contect{
	margin-top: 2%;
}
.productInfo_contect p{
	width: 30%;
}
.productInfo_contectImage{
  float: left;
  width: 30%;
  height: auto;
}
.productInfo_contectDescription{

}
#pDesc{
  margin-right:5em;
}

#pChang{
  margin-right:5em;
}

.productInfo_header a{
	width: 10%;
	float: left;
	color: white;
	margin-top:10%;
	text-align: center;
	text-decoration: none;
  vertical-align:middle;
}


/*------------------------------------------------myPro-----------------*/
.myProfileContainer{
	position: relative;
	top: 90px;
	margin-right: 10%;
}

.numberSize{
    max-width: 25%;
    max-height: 30px;
    margin-top: 5px;
    margin-bottom: 5px;
}

.submit{
    position: relative;
    margin-left: auto;
    margin-right: 5%;
    background: url("media/button.png") ,left top;
    cursor:pointer;
    width: 100px;
    height:27px;
    border-radius: 3px;
    outline:0;
    color:white;
}
.submit:hover{
    box-shadow: inset 0 0 0 1px #27496d,0 5px 15px #193047;
}
.submit:active{
    box-shadow: inset 0 0 0 1px #27496d, inset 0 5px 30px #193047;
}


/*-------------------------------------------------- orderDish  --------------------------------------*/

#iFrameMap{
  margin-top: 20px;
  padding: 0;
  border: none;
  width: 100%;
  height: 200;
  frameborder:0;
}
#rightDivOrder{
  margin-top: 0;
  display: block;
  width: 26%;
  position: relative;
  float: right;
  top:55px;
  height: auto;
  -webkit-box-shadow: 0 1px 2px #666666;

}

#submitBtnOrder{
  right:22%;
}
#submitBtnPayment{
  right:22%;
}

.autocompleteInput{
  width:100%;
}

hr{
  color: rgb(9, 5, 22);
  background-color: rgb(9, 5, 22);
  height: 5px;
}

input.order-btn {
    background-color: rgb(0, 0, 0);
    letter-spacing: 3px;
    font-weight: bold;
    border: 0 none!important;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    height: 35px;
    padding: 0 10px;
    text-shadow: 0 0 1px rgba(0,0,0,.6);
    width: 50%;
    margin: auto;
    display:block;
    font-family: FontAwesome, 'Helvetica Neue', Helvetica, Arial, sans-serif;
}

table.userDetailsR td { text-align: right; width: 33%; }
table.userDetailsL td { text-align: left; width: 33%; }
table.userDetails th { text-align: right; }
table.userDetails input { text-align: right; }

  table.dishDetailsR td { text-align: right; width: 33%; }
  table.dishDetailsL td { text-align: left; width: 33%; }
  table.dishDetails th { text-align: right; }
  table.dishDetails input { text-align: right; }
  .right { text-align: right; }


  #rightDivPayment{
    margin-top: 0;
    display: block;
    width: 26%;
    position: relative;
    float: right;
    top:55px;
    height: auto;
    -webkit-box-shadow: 0 1px 2px #666666;
  }


.newUserInput{
	max-width: 100%;
	margin-top: 5px;
	margin-bottom: 5px;
  float: right;
  max-height: 40px;
  padding-top:1px;
  padding-bottom:1px;
  display: inline-block;
}
