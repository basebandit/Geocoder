<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="Geocoder">
    <meta name="author" content="devmars">
    <title>Geocoder</title>

    <!-- Bootstrap CSS file -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bootstrap-theme.min.css" rel="stylesheet"/>
    <link href="css/geocoder.css" rel="stylesheet">
</head>
<body>

<?php require_once('inc/components/header.php'); ?>

<div class="row">
    <div id="sidebar">
        <!--<div class="col-xs-3">-->

        <h4 class="text-center">Upload your csv</h4>
        <hr/>
        <!--status message will appear here-->
        <div class="status"></div>
        <form class="pure-form" action="upload.php" enctype="multipart/form-data" method="post">

            <div class="upload">
                <a onclick="select_file()" class="pure-button">Choose a Image</a>
                <input id="image" type="file" name="image">
            </div>
            <input class="pure-button pure-button-primary" type="submit" value="Upload!">
        </form>
        <!--progress bar-->
        <div class="progress">
            <div class="bar"></div>
            <div class="percent">0%</div>
        </div>
        <hr/>
    </div>
    <div id="map-canvas">
        <!-- <div class="col-xs-9">-->
        <div class="google-map-canvas" id="map"></div>
    </div>
</div>
<!-- end template -->

<?php require_once('inc/components/footer.php'); ?>
<!-- Jquery and Bootstrap Script files -->
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/upload.js"></script>
<script type="text/javascript" src="js/geocode.js"></script>


<!--        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNi-Ho19wQQZDzgr7eOPsdg3yNEdFEmx8&callback=initMap&libraries=geometry">
        </script>-->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNi-Ho19wQQZDzgr7eOPsdg3yNEdFEmx8&libraries=geometry&callback=initMap"
    async defer></script>
<script type="text/javascript">
    // select file function only for styling up input[type="file"]
    function select_file() {
        document.getElementById('image').click();
        return false;
    }
</script>
</body>
</html>