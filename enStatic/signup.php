<!DOCTYPE html>
<html>

<head>
  <!-- head meta data -->
  <?php include "../enIncludes/head-meta-data.inc.php"; ?>
  <!-- End of head meta data -->
  <link rel="stylesheet" type="text/css" href="../css/homePage.css">
  <link rel="stylesheet" type="text/css" href="../css/signup.css">


  <title>Sign up</title>
</head>

<body id="home" class="scrollspy">
  <!--  Start of Header Section-->
  <header class="main-header">
    <div class="primary-overlay">

      <!-- Navigation Bar -->
      <?php include "../enIncludes/navigation-bar.inc.php"; ?>
      <!-- End of Navigation Bar -->

      <!-- Showcase Panel -->
      <div class="showcase container" style="padding-top: 20px;">
        <!-- Section Background -->
        <div class="bgBox">
          <video id="bgVideo" autoplay="" loop="" muted="" style="width: 100%;">
            <source src="../img/background.mp4" type="video/mp4">
          </video>
        </div>
        <!-- Section Background END -->
        <div class="mainConetnt">
          <div class="signBox">
            <h1 class="title">Sign In</h1>
            <h5 style="text-align: center;">Welcome to CSCW Environment </h5>
            <div class="transparent ">
              <div class="row transparent">
                <div class="transparent">
                  <!-- 提交执行 handle-signup.php -->
                  <form method="POST" action="../php/handle-signup.php">
                    <div class="input-group">
                      <span class="input-group-addon glyphicon glyphicon-user" aria-hidden="true"></span>
                      <input type="text" class="form-control" placeholder="Account" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon glyphicon glyphicon-user" aria-hidden="true"></span>
                      <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon glyphicon glyphicon-lock" aria-hidden="true"></span>
                      <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon glyphicon glyphicon-lock" aria-hidden="true"></span>
                      <input type="password" class="form-control" placeholder="Confirm Password" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon glyphicon glyphicon-envelope" aria-hidden="true"></span>
                      <input type="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon glyphicon glyphicon-phone" aria-hidden="true"></span>
                      <input type="tel" class="form-control" placeholder="Telephone" aria-describedby="basic-addon1">
                    </div>

                    <input type="submit" value="Sign up" class="btn btn-lg active">
                  </form>
                  <div class="linkBtn">
                    <!-- <a href="#">Forget Password</a> -->
                    <a href="./login.php">Sign In</a>
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

  <script>
    $(function(){
      // 菜单栏点击事件
      $("#mainMenu li, #mobile_menu li").removeClass("active");
      $("#signUp, #signUp_m").addClass("active");
    })
    $(document).ready(function () {
      // 菜单栏
      // $("#mainMenu li, #mobile_menu li").removeClass("active");
      // $("#signUp, #signUp_m").addClass("active");


      // First name field
      $("#account").focus(function() {
        $("#account-label").addClass("active");
      });
      $("#account").focusout(function() {
        if ($("#account").val() == '') {
          $("#account-label").removeClass("active");
        }
      });


      // Email field
      $("#email").focus(function() {
        $("#email-label").addClass("active");
      });
      $("#email").focusout(function() {
        if ($("#email").val() == '') {
          $("#email-label").removeClass("active");
        }
      });

      // Username field
      $("#username").focus(function() {
        $("#username-label").addClass("active");
      });
      $("#username").focusout(function() {
        if ($("#username").val() == '') {
          $("#username-label").removeClass("active");
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

      // conPassword field
      $("#conpwd").focus(function() {
        $("#conpwd-label").addClass("active");
      });
      $("#conpwd").focusout(function() {
        if ($("#conpwd").val() == '') {
          $("#conpwd-label").removeClass("active");
        }
      });

      // Calendar Name field
      $("#phone").focus(function() {
        $("#phone-label").addClass("active");
      });
      $("#phone").focusout(function() {
        if ($("#phone").val() == '') {
          $("#phone-label").removeClass("active");
        }
      });
    });
  </script>
</body>


</html>
