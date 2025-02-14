<?php
require_once 'app/conf.php';
require_once 'app/functions.php';
startSession();
// ----------------------------------------------------------------------------
// CONTROLLER
// ----------------------------------------------------------------------------
$msg = handlePostRequest();

if (!isset($_SESSION['access']) || $_SESSION['access'] !== true) {
    displayPageForm($msg);
    die();
}
// ----------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="mesa.png">   
    <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title><?= APP_TITLE ?></title>    
  </head>
  <body>
     <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-5 border rounded p-4 text-center">
                    <h1 class="text-center"><span class="text-info"><?= APP_TITLE ?></h1> 
                    <p class="text-center"> | <?= APP_SUBTITLE ?> | <form action="" method="post"><input type="hidden"  id="form" name="form" value="signout"><input class="btn btn-danger" type="submit" value="sign out" /><form></p>                    
                </div>
                <!-- Navigation -->
                <h3 class="mb-4"><u>Available services</u></h3>
                <a class="btn btn-info" href="" target="_blank">First Service</a>                
                <hr>
            </div>
        </div>
    </div>
    <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>