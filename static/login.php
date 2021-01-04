<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>

  <!-- head meta data -->
  <?php include "../includes/head-meta-data.inc.php"; ?>
  <!-- End of head meta data -->
  <link rel="stylesheet" type="text/css" href="../css/homePage.css">

  <title>login in</title>
</head>

<body>
  <!-- Start of Header Section-->
  <header class="main-header">
    <div class="primary-overlay">

      <!-- Navigation Bar -->
      <?php include "../includes/navigation-bar.inc.php"; ?>
      <!-- End of Navigation Bar -->

      <!-- Showcase Panel -->
      <div class="showcase container">
        <div class="bgBox">
          <video id="bgVideo" autoplay="" loop="" muted="" style="width: 100%;">
            <source src="../img/background.mp4" type="video/mp4">
          </video>
        </div>
        <div class="mainConetnt">
          <div class="loginBox">
            <h1 class="title">登  录</h1>
            <h5 style="text-align: center;">Welcome to CSCW Environment </h5>
            <div class="transparent">
              <div class="row transparent">
                <div class="transparent">
                  <!-- 提交执行handle-login.php -->
                  <form method="POST" action="../php/handle-login.php">
                    <div class="input-group">
                      <span class="input-group-addon glyphicon glyphicon-user" aria-hidden="true"></span>
                      <input type="text" name="account" class="form-control" placeholder="Account" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon glyphicon glyphicon-lock" aria-hidden="true"></span>
                      <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                    </div>
                    <!-- Added the onclick function to validate the form, onclick="validateFormLogin()"-->
                    <input id="submitButton" type="submit" value="登 录" class="btn btn-lg active">
                  </form>
                  <div class="linkBtn">
                    <a href="#">Forget Password</a>
                    <a href="./signup.php">Sign Up</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!--  End of Header Section -->


  <!-- Footer -->

  <!-- End of footer-->

  <script type="text/javascript">
    $(document).ready(function () {
       // 菜单栏
      $("#mainMenu li, #mobile_menu li").removeClass("active");
      $("#login, #login_m").addClass("active");

      // Email field
      $("#account").focus(function() {
        $("#account-label").addClass("active");
      });
      $("#account").focusout(function() {
        if ($("#account").val() == '') {
          $("#account-label").removeClass("active");
        }
      });

      // Password field
      $("#password").focus(function() {
        $("#password-label").addClass("active");
      });
      $("#password").focusout(function() {
        if ($("#password").val() == '') {
          $("#password-label").removeClass("active");
        }
      });
    });
</script>
</body>
</html>
