<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Tourist attraction</title>

  <link href="styles/home.css" rel="stylesheet" type="text/css">
  <link href="styles/openModel.css" rel="stylesheet" type="text/css">
  <link href="styles/Footer.css" rel="stylesheet" type="text/css">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
    body,
    html {
      height: 100%;
      margin: 0;
    }

    #offer {
      background-image: url("images/airphane.png");
    }
  </style>
  <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
  <!--<script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>-->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!--load Flickr Images-->
  <script type="text/javascript">
    
    

    $(document).ready(function () {
      loadImage();


    });//end ready

    function loadImage() {
      $(document).ready(function () {
        var URL = "https://api.flickr.com/services/feeds/photos_public.gne";
        var ID = "?id=169277825@N05";
        var jsonFormat = "&format=json&jsoncallback=?";
        var ajaxURL = URL + ID + jsonFormat;
        var imageArea = $('#photos');
        var imageArea2 = $('#photos2');
        imageArea.html("");//clear image
        imageArea2.html("");

        $.getJSON(ajaxURL, function (data) {
          for (var i = 0; i < data.items.length; i++) {
            var img = $("<img />");
            if (i % 2 == 0) {
              img.attr("src", data.items[i].media.m).appendTo("#photos");
              $("<h2>" + data.items[i].title + "</h2>").appendTo("#photos");
              //$(".productName").text("fuck!");
            } else {
              img.attr("src", data.items[i].media.m).appendTo("#photos2");
              $("<h2>" + data.items[i].title + "</h2>").appendTo("#photos2");
            }
          }

        }); // end get JSON
      }); // end ready
    }

    function searchImage() {
      $(document).ready(function () {


        //		   var URL = "https://api.flickr.com/services/feeds/photos_public.gne";
        //		   var ID = "?id=169277825@N05";
        //		   var jsonFormat = "&format=json&jsoncallback=?";
        var text = document.getElementById("search").value;


        var imageArea = $('#photos');
        var imageArea2 = $('#photos2');
        imageArea.html("");//clear image
        imageArea2.html("");


        var ajaxURL = "https://api.flickr.com/services/feeds/photos_public.gne?id=169277825@N05&method=flickr.photos.search&tags=" + text + "&format=json&jsoncallback=?";

        $.getJSON(ajaxURL, function (data) {
          for (var i = 0; i < data.items.length; i++) {
            var img = $("<img />");
            if (i % 2 == 0) {
              img.attr("src", data.items[i].media.m).appendTo("#photos");
              $("<h2>" + data.items[i].title + "</h2>").appendTo("#photos");
              //sharedata["url"] = data.items[i].link;
              //$(".productName").text("fuck!");
            } else {
              img.attr("src", data.items[i].media.m).appendTo("#photos2");
              $("<h2>" + data.items[i].title + "</h2>").appendTo("#photos2");
            }
          }

        });
      }); // end ready
    }

    


  </script>




</head>

<body>

  <div id="mainWrapper">
    <header>
      <!-- This is the header content. It contains Logo and links -->
      <div id="logo">
        <!-- Company Logo text -->
       <img src="img/ivestar.png" id="logo">
       

      </div>
      

      <div id="headerLinks">


   <div id="navbar">
		<div id="navbar-right">
			<a class="active" href="index.php">Home</a>
			<a href="Chat.html">Community</a>
    </div>
  </div> 

        <div id="status">Welcome</div>
        <!-- <div id="dodo"></div> -->
        
        <!-- <button onclick="getInfo()">Get Info</button> -->

        <div id="fb-root"></div>
        <!--this is also login button, but is code style button-->
        <script async defer crossorigin="anonymous"
          src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2&appId=712986962449247&autoLogAppEvents=1"></script>
        <div class="fb-login-button" scope="public_profile,email" onlogin="checkLoginState();" data-width=""
          data-size="medium" data-button-type="login_with" data-auto-logout-link="true" data-use-continue-as="false">
        </div>


        <!--</a><a href="#" title="Cart">Cart</a>-->
      </div>

    </header>
  </div>


  <section id="offer"></section>

  <div class="bg-text">
    <h2>500 Travel Products Every Year</h2>
    <p>IVE Star is one of the leading travel and tourism companies in Hong Kong. IVE Star serves more than ten thousand
      passengers per year and provides more than
    </p>
  </div>

  


    
  <div id="mainSecondWrapper">
    <div id="content">
      <div id="searchbox">
        <input type="text" id="searchArea" placeholder="Search all resouces">
        <form action="check.php" method="post" enctype="multipart/form-data">
          <label for="chooseimage">
            <img src="img/camera.png" width="70" height="50" />
          </label>
          <input type="file" id="chooseimage" name="image" accept="image/*" class="form-control"
            onchange="form.submit()">
        </form>
      </div>
      <button type="submit" onClick= "searchBtn()" id="searchImage" class="searchImage">Search</button>
    </div>
  </div>


  <div id="mainWrapper">
   

  <?php
    include "ajaxTest.php";
  ?>

    <footer>
      <!-- This is the footer with default 3 divs -->

      <div>
          <p><i class="fa fa-map-marker"></i>
					<span>   Location: Sha Tin, New Territories</span></br></br></br>
          <i class="fa fa-envelope"></i>
          Email:2019projectdb@gmail.com</p></a>
      
      </div>

      <div>
        <p>IVE Star was established in 2000. IVE Star is one of the leading travel and tourism companies in Hong Kong.</p>
        <p class="footer-company-name">IVE Star Company &copy; 2019</p>

      </div>
 

      <div class="footerlinks">
        <p><a href="#header" title="Link">Home Page</a></p>
        <p><a href="Chat.html" title="Link">Community</a></p>
      

      </div>

      

    </footer>
  </div>

  <a href="#logo"><button id="topbtn" title="Go to top">Top</button></a>

</body>

</html>