<!DOCTYPE html>
<html>

<head>
  <!-- head meta data -->
  <?php include "../includes/head-meta-data.inc.php"; ?>
  <!-- End of head meta data -->

  <link rel="stylesheet" type="text/css" href="../css/signup.css">


  <title>Sign up</title>
</head>

<body id="home" class="scrollspy">
  <!--  Start of Header Section-->
  <header class="main-header">
    <div class="primary-overlay">

      <!-- Navigation Bar -->
      <?php include "../includes/navigation-bar.inc.php"; ?>
      <!-- End of Navigation Bar -->

      <!-- Showcase Panel -->
      <div class="showcase container">
        <div class="row">
          <div class="col s12 main-text">
            <h5>Welcome to Calendar</h5>
            <h1>注册</h1>
            <div class="container transparent ">
              <div class="row transparent">

                <div class="col s12 m6 offset-m3 transparent">
                  <!-- 提交执行 handle-signup.php -->
                  <form method="POST" action="./handle-signup.php">
                    <div class="input-field">
                      <input type="text" id="account" name="account">
                      <label for="account" id="account-label">账号：</label>
                    </div>
                    <div class="input-field">
                      <input type="text" id="username" name="username">
                      <label for="username" id="username-label">姓名：</label>
                    </div>
                    <div class="input-field">
                      <input type="password" id="password" name="password">
                      <label for="password" id="password-label">密码：</label>
                    </div>
                    <div class="input-field">
                      <input type="password" id="conpwd" name="conpwd">
                      <label for="conpwd" id="conpwd-label">验证密码：</label>
                    </div>
                    <div class="input-field">
                      <input type="email" id="email" name="email">
                      <label for="email" id="email-label">电子邮箱：</label>
                    </div>
                    <div class="input-field">
                      <input type="tel" id="phone" name="phone">
                      <label for="phone" id="phone-label">电话号码：</label>
                    </div>
                    <input type="submit" value="Sign up" class="btn btn-large purple btn-extend">
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

  <script>
    $(document).ready(function () {
      // Init Sidenav
      $('.button-collapse').sidenav();

      // Init Scrollspy
      $('.scrollspy').scrollSpy()

      // ScrollFire 滚动条显示
     /* const options = [
        {
          selector: '.main-text', offset: 0, callback: function (el) {
            M.fadeInImage($(el));
          }
        },
        {
          selector: '.navbar-fixed', offset: 1500, callback: function () {
            $('nav').removeClass('transparent');
            $('nav').addClass('blue-grey darken-4');
          }
        },
      ];

      M.scrollFire(options);*/

    });

    $(document).ready(function () {
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
