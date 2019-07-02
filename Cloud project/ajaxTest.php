<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://npmcdn.com/parse@1.9.2/dist/parse.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        var oldData;
        var currentPage = 1;
        var displayProduct = [];

        Parse.initialize("id6lNbpo6h0MJQNN1xsdY6EHfzCXrluly3GTzDax", "56q4YjR10vQ0U9gwmtYdpwJyXOsr91rBQkteohK9");
        Parse.serverURL = "https://parseapi.back4app.com";
        $(document).ready(
            initialize()
        )

        function initialize() {
            $.ajax({
                type: "GET",
                url: "https://parseapi.back4app.com/classes/TravelProduct",
                headers: {
                    "X-Parse-Application-Id": 'id6lNbpo6h0MJQNN1xsdY6EHfzCXrluly3GTzDax',
                    "X-Parse-REST-API-Key": 'v0jj9vDpEKpIBJWiIAJOXlbsEEokz3FtWWFS1T5l'
                },
                success: function (msg) {
                    $('#list').empty();
                    oldData = msg
                    displayProduct = [];
                    for (var i = 1; i <= Math.ceil(msg.results.length / 6); i++) {
                        var list = '<div class="divlistNumber"><a class="listNumber" href="javascript: flip(' + i + ');">' + i + '</a></div>';
                        $('#list').append(list);
                    }

                    for (var i = 0; i < 6; i++) {
                        $("#Name" + i).empty();
                        $("#Price" + i).empty();
                        $("#img" + i).attr('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
                    }

                    for (var i = 0; i < msg.results.length; i++) {
                        if (i >= ((currentPage - 1) * 6) && i <= (currentPage * 6 - 1)) {
                            var product = new Object();
                            product.Tag = msg.results[i].Tag;
                            product.productName = msg.results[i].productName;
                            product.productPrice = msg.results[i].productPrice;
                            product.brand = msg.results[i].brand;
                            product.description = msg.results[i].description;
                            product.location = msg.results[i].location;
                            displayProduct.push(product);
                            loadImage(product.Tag, product);
                        }
                    }
                    $('#itemBox0').removeClass('run-animation');
                    setTimeout(function () {
                        $('#itemBox0').addClass('run-animation');
                    }, 1);
                    $('#itemBox1').removeClass('run-animation');
                    setTimeout(function () {
                        $('#itemBox1').addClass('run-animation');
                    }, 1);
                    $('#itemBox2').removeClass('run-animation');
                    setTimeout(function () {
                        $('#itemBox2').addClass('run-animation');
                    }, 1);
                    $('#itemBox3').removeClass('run-animation');
                    setTimeout(function () {
                        $('#itemBox3').addClass('run-animation');
                    }, 1);
                    $('#itemBox4').removeClass('run-animation');
                    setTimeout(function () {
                        $('#itemBox4').addClass('run-animation');
                    }, 1);
                    $('#itemBox5').removeClass('run-animation');
                    setTimeout(function () {
                        $('#itemBox5').addClass('run-animation');
                    }, 1);

                    updateProduct();
                },
                error: function () {
                    initialize();
                }
            });
        }
        function loadImage(Tag, product) {
            $.ajax({
                async: true,
                type: "GET",
                url: "https://api.flickr.com/services/feeds/photos_public.gne?id=169277825@N05&method=flickr.photos.search&tags=" + Tag + "&format=json&jsoncallback=?",
                dataType: "json",
                success: function (data) {
                    product.productimage = data.items[0].media.m;
                    showProduct();
                },
                error: function () {
                }
            });
        }

        function showProduct() {
            for (var i = 0; i < displayProduct.length; i++) {
                $('#img' + i).attr('src', displayProduct[i].productimage);
                $("#Name" + i).html(displayProduct[i].productName);
                $("#Price" + i).html(displayProduct[i].productPrice);
            }
        }
        //---------------------------------------------------------------------------------------------------------//
        function updateProduct() {
            $.ajax({
                type: "GET",
                url: "https://parseapi.back4app.com/classes/TravelProduct",
                headers: {
                    "X-Parse-Application-Id": 'id6lNbpo6h0MJQNN1xsdY6EHfzCXrluly3GTzDax',
                    "X-Parse-REST-API-Key": 'v0jj9vDpEKpIBJWiIAJOXlbsEEokz3FtWWFS1T5l'
                },
                success: function (msg) {

                    if (JSON.stringify(oldData) !== JSON.stringify(msg)) {
                        $('#list').empty();
                        displayProduct = [];
                        for (var i = 1; i <= Math.ceil(msg.results.length / 6); i++) {
                            var list = '<div class="divlistNumber"><a class="listNumber" href="javascript: flip(' + i + ');">' + i + '</a></div>';
                            $('#list').append(list);
                        }

                        for (var i = 0; i < 6; i++) {
                            $("#Name" + i).empty();
                            $("#Price" + i).empty();
                            $("#img" + i).attr('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
                        }

                        for (var i = 0; i < msg.results.length; i++) {
                            if (i >= ((currentPage - 1) * 6) && i <= (currentPage * 6 - 1)) {
                                var product = new Object();
                                product.Tag = msg.results[i].Tag;
                                product.productName = msg.results[i].productName;
                                product.productPrice = msg.results[i].productPrice;
                                product.brand = msg.results[i].brand;
                                product.description = msg.results[i].description;
                                product.location = msg.results[i].location;
                                displayProduct.push(product);
                                loadImage(product.Tag, product);
                            }
                        }
                        oldData = msg;
                    }
                    setTimeout(updateProduct, 5000);
                },
                error: function () {
                    setTimeout(updateProduct, 5000);
                }
            });
        }
        //---------------------------------------------------------------------------------------------------------//
        function searchImage(Tag) {
            $.ajax({
                async: true,
                type: "GET",
                url: "https://api.flickr.com/services/feeds/photos_public.gne?id=169277825@N05&method=flickr.photos.search&tags=" + Tag + "&format=json&jsoncallback=?",
                dataType: "json",
                success: function (data) {
                    displayProduct = [];
                    for (var i = 0; i < data.items.length; i++) {
                        var tagSet = data.items[i].tags.slice(0, data.items[i].tags.indexOf(" "));
                        searchText(tagSet, data.items[i].media.m);//1000x , url
                    };
                },
                error: function () {
                }
            });
        }

        function searchText(tag, image) {
            $.ajax({
                type: "GET",
                url: "https://parseapi.back4app.com/classes/TravelProduct?where={\"Tag\":\"" + tag + "\"}",
                headers: {
                    "X-Parse-Application-Id": 'id6lNbpo6h0MJQNN1xsdY6EHfzCXrluly3GTzDax',
                    "X-Parse-REST-API-Key": 'v0jj9vDpEKpIBJWiIAJOXlbsEEokz3FtWWFS1T5l'
                },
                success: function (msg) {
                    
                   
                    $('#list').empty();
                    for (var i = 1; i <= Math.ceil(msg.results.length / 6); i++) {
                        var list = '<div class="divlistNumber"><a class="listNumber" href="javascript: flip(' + i + ');">' + i + '</a></div>';
                        $('#list').append(list);
                    }

                    for (var i = 0; i < 6; i++) {
                        $("#Name" + i).empty();
                        $("#Price" + i).empty();
                        $("#img" + i).attr('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
                    }

                    for (var i = 0; i < msg.results.length; i++) {
                        if (i >= ((currentPage - 1) * 6) && i <= (currentPage * 6 - 1)) {
                            var product = new Object();
                            product.Tag = msg.results[i].Tag;
                            product.productimage = image;
                            product.productName = msg.results[i].productName;
                            product.productPrice = msg.results[i].productPrice;
                            product.brand = msg.results[i].brand;
                            product.description = msg.results[i].description;
                            product.location = msg.results[i].location;
                            displayProduct.push(product);
                        }
                    }
                    showProduct();
                },
                error: function () {
                }
            });
        }
        //---------------------------------------------------------------------------------------------------------//
        function flip(pageNumber) {


            
            
            if ($("#searchArea").val() !== '') {
                currentPage = pageNumber
                searchImage($("#searchArea").val());
                
            }else{
                currentPage = pageNumber
                initialize();
            }
            
        }

        //---------------------------------------------------------------------------------------------------------//
        function inside(x) {
            $(x).css("border", "2px groove blue");
        }
        function outside(x) {
            $(x).css("border", "none");
        }

        function searchBtn() {


            if ($("#searchArea").val() !== '') {
                currentPage = 1;
                searchImage($("#searchArea").val());

            }else{
            
                initialize();
            }
        }
    </script>


    <style>
        div.container {
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            width: 100%;
        }

        div.itemBox {
            display: inline-block;
            width: 30%;
            background: #fefefe;
            margin-bottom: 5px;
            margin-top: 5px;
            border-radius: 10px;
            cursor: pointer;

        }

        div.itemBox img {
            width: 50%;
            margin-top: 10px;
            border-radius: 20%;
        }

        div.list {

            text-align: center;
margin-left: auto;
margin-right: auto;
text-align: center;
width: 100%;
height:40px;
        }

        .divlistNumber{
            display: inline-block;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            width:40px;
        }
    
        .listNumber {
            display: inline-block;
            width:40px;
            background-color: #e7e7e7;
            text-decoration:none;
            line-height:40px;
            border-radius: 50%;
            text-align: center;
            height:40px;
            color: #000000
        }


        .listNumber:hover {
            background-color: #a1db19;
        }

        .listNumber:active {
            background-color: #128cdd;
            color: #ffffff
        }

        .run-animation {
            animation: animateElement linear 3s;
            animation-iteration-count: 1;
        }

        @keyframes animateElement {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            text-align: center;
            border: 1px solid #888;
            width: 50%;
            z-index: 5;

        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container" id="container">
        <div class="itemBox" id="itemBox0" onclick="shareBox(0)" onmouseover="inside(this)" onmouseout="outside(this)">
            <img id="img0">
            <p id="Name0"></p>
            <p id="Price0"></p>
        </div>
        <div class="itemBox" id="itemBox1" onclick="shareBox(1)" onmouseover="inside(this)" onmouseout="outside(this)">
            <img id="img1">
            <p id="Name1"></p>
            <p id="Price1"></p>
        </div>
        <div class="itemBox" id="itemBox2" onclick="shareBox(2)" onmouseover="inside(this)" onmouseout="outside(this)">
            <img id="img2">
            <p id="Name2"></p>
            <p id="Price2"></p>
        </div>
        <div class="itemBox" id="itemBox3" onclick="shareBox(3)" onmouseover="inside(this)" onmouseout="outside(this)">
            <img id="img3">
            <p id="Name3"></p>
            <p id="Price3"></p>
        </div>
        <div class="itemBox" id="itemBox4" onclick="shareBox(4)" onmouseover="inside(this)" onmouseout="outside(this)">
            <img id="img4">
            <p id="Name4"></p>
            <p id="Price4"></p>
        </div>
        <div class="itemBox" id="itemBox5" onclick="shareBox(5)" onmouseover="inside(this)" onmouseout="outside(this)">
            <img id="img5">
            <p id="Name5"></p>
            <p id="Price5"></p>
        </div>
    </div>
    <div class="list" id="list">
    </div>

    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="productimage">
            <p id="productName"></p>
            <p id="productPrice"></p>
            <p id="brand"></p>
            <p id="description"></p>
            <p id="location"></p>
            <button onclick="shareDataToFacebook()" id="Sharedata" class="Sharedata" style="font-size:24px">Share <i
                    class="fa fa-facebook-square"></i></button>

        </div>

    </div>

    <script>
        var sharedata = {
            url: "https://live.staticflickr.com//65535//32858465157_c21f500cff_m.jpg"
        };
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        function shareBox(id) {
            $("#productimage").attr('src', displayProduct[id].productimage);
            sharedata['url'] = displayProduct[id].productimage;
            $("#productName").html("productName: " + displayProduct[id].productName);
            $("#productPrice").html("productPrice: " + displayProduct[id].productPrice);
            $("#brand").html("brand: " + displayProduct[id].brand);
            $("#description").html("description: " + displayProduct[id].description);
            $("#location").html("Location: " + displayProduct[id].location);
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


        //facebook setting 
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                getInfo();
            } else {
                // The person is not logged into your app or we are unable to tell.
                document.getElementById('status').innerHTML = 'Please log ' +
                    'into this app';
            }
        }

        function checkLoginState() {
            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });
        }


        window.fbAsyncInit = function () {
            FB.init({
                appId: '712986962449247',
                xfbml: true,
                version: 'v3.2'
            });
            FB.AppEvents.logPageView();

            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);

            });
        };
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) { return; }
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


        function getInfo() { //check login status
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function (response) {
                console.log('Successful login for: ' + response.name);

                document.getElementById('status').innerHTML =
                    'Hello , ' + response.name + '!';
            });
        }

        function logoutbt() {
            FB.logout(function (response) {
                document.getElementById('status').innerHTML =
                    'you are logouted';
            }, { scope: 'public_profile,email' });
        }


        function shareDataToFacebook() {
            //alert(sharedata['url']);

            share(sharedata);
        }
        function share(data) {
            FB.ui({
                method: 'share',
                display: 'popup',
                //href: 'https://live.staticflickr.com//65535//32858465157_c21f500cff_m.jpg',
                href: data.url,
            }, function (response) {
                if (response && !response.error_message) {
                    alert('Posting completed.');
                } else {
                    alert('Error while posting.');
                }
            });
        };
    </script>


</body>

</html>
