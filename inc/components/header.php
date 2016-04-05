<?php
/**
 * Created by PhpStorm.
 * User: mars
 * Date: 4/3/16
 * Time: 11:14 AM
 */
?>
<header class="navbar navbar-custom navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand">Geocoder</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <form id="floating-panel" class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <!--  <input type="text" class="form-control" placeholder="Search Place">-->
                    <input id="address" class="form-control" type="textbox" value="Juja,Kenya">
                </div>
                <!-- <button id="submit" type="submit" class="btn btn-default">Search</button>-->
                <input id="submit" type="button" class="btn btn-primary" value="Search Place">
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="index.php"><span
                            class="glyphicon glyphicon-home"></span>&nbsp;Home</a>
                </li>
                <li><a href="help.php"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Help</a></li>
                <li><a href="contact.php"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Contact</a></li>
            </ul>
        </nav>
    </div>
</header>
