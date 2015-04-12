<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Test BeFound</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="./css/bootstrap.css" media="screen">
  <link rel="stylesheet" href="https://bootswatch.com/assets/css/bootswatch.min.css">
  <link rel="stylesheet" href="./css/perso.css">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <style>
  .compassContainer{
    transform-origin: 50% 50%;
    -webkit-transform-origin: 50% 50%;
    -moz-transform-origin: 50% 50%;
  }

  .block_img{
    margin-left: auto;
    margin-right: auto;
    display: block;
  }
  </style>
  <script src="./js/jquery-1.11.2.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/validator.js"></script>
  <?php require_once 'dbaccess.php'; ?>
  <body onload="init()">
    <div class="container">
      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h1>BeFound</h1>
            <p class="lead">Pour savoir où sont mes coupains</p>
          </div>
        </div>
      </div>
<!-- Compass
  ================================================== -->
  <div class="row">
    <div class="col-lg-12">
      <div class="bs-component">
        <div class="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <?php
              if (isset($_SESSION['id'])) {
                require_once 'compass.php';
              }else{
                require_once 'login.php';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
