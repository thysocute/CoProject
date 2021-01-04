<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>

  <!-- head meta data -->
  <?php include "../includes/head-meta-data.inc.php"; ?>
  <!-- End of head meta data -->
  <link rel="stylesheet" type="text/css" href="../css/login.css">

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
        <div class="row">
          <div class="col s12 main-text">
            <h5>Welcome to CSCW Environment </h5>
            <h1>登录</h1>
            <div class="container transparent ">
              <div class="row transparent">
                <div class="col s12 m6 offset-m3 transparent">
                  <!-- 提交执行handle-login.php -->
                  <form method="POST" action="./handle-login.php">
                    <div class="input-field">
                      <input type="text" id="account" name="account">
                      <label for="account" id="account-label">账号：</label>
                    </div>
                    <div class="input-field">
                      <input type="password" id="password" name="password">
                      <label for="password" id="password-label">密码：</label>
                    </div>
                    <!-- Added the onclick function to validate the form, onclick="validateFormLogin()"-->
                    <input id="submitButton" type="submit" value="登 录" class="btn btn-large btn-extend">
                  </form>
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
  <footer class="page-footer blue-grey darken-1">
    <?php include "../includes/footer.inc.php"; ?>
  </footer>
  <!-- End of footer-->

  <script type="text/javascript">
    $(document).ready(function () {
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
