<!-- Start of Navigation bar-->

<div class="navbar-fixed" id="navbar-switch">
  <nav id="navbar" class="navbar" style="">
    <div class="container">
      <div class="nav-wrapper clearfix" style="position: relative;">
        <!-- <a href="http://localhost:9001/">协同编辑</a> -->
        <!-- <a href="../static/relationship.php" class="brand-logo">  协同工作环境</a> -->
       <div class="row">
          <div class="col-md-3">
            <a href="../static/relationship.php" class="brand-logo"> 
              <img src="../img/logo.png" style="height: 55px;" />
            </a>
          </div>
          
          <ul id="mainMenu" class="part-nav nav-css nav nav-tabs col-md-9">
            <?php if (isset($_SESSION["username"]) && $_SESSION["username"] != "") {
              echo '<li id="user"><a href="../static/relationship.php"  >' . $_SESSION['username'] . '</a></li>';
              echo '<li ><a href="../php/logout.php" id="logOutButton">退出</a></li>';
              echo '<li id="coChat"><a href="../static/communication.php">通讯管理</a></li>';
              echo '<li id="coSchedule"><a href="../static/calendar.php">日程管理</a> </li>';
              echo '<li id="coEdit"><a href="../static/coEdit.php">协同编辑</a></li>';
              // echo '<li id="coVisual"><a href="../static/coVisual.php">协同过程可视化</a></li>';
              echo '<li id="coVisual"><a href="../static/coDraw.php">Co-Draw</a></li>';
              echo '<li id="coVisual"><a href="../static/coVisual.php">Co-Visual</a></li>';
              echo '<li id="coVUI"><a href="http://172.16.16.249:8080/">VSCT</a></li>';
              $url=$_SERVER['PHP_SELF'];
              $urls=preg_split("/\//", $url);
              echo '<li id="en"><a href="../enStatic/'.$urls[3].'">English</li>';
            } else {
              echo '<li id="login"><a href="../static/login.php" class="btn blue">登录</a></li>';
              echo '<li id="signUp"><a href="../static/signup.php">注册</a></li>';
              // echo '<li><a href="../index.php#contact">联系我们</a></li>';
              // echo '<li><a href="../index.php">首页</a></li>';
            }
            ?>
          </ul>
        </div>
        <span id="menu_logo" class="menu-logo" onclick="showMenu()"></span>
        <div id="menu" class="menu">
          <span id="menu_angle" class="menu-angle"></span>
          <ul id="mobile_menu" class="mobile-menu" >
            <?php if (isset($_SESSION["username"]) && $_SESSION["username"] != "") {
              echo '<li id="user_m"><a href="../static/relationship.php">' . $_SESSION['username'] . '</a></li>';
              // echo '<ul class="nav navbar-nav">'
              echo '<li id="coVUI_m"><a href="../static/coVUI.php">VSCT</a></li>';
              echo '<li id="coVisual_m"><a href="../static/coVisual.php">Co-Visual</a></li>';
              echo '<li id="coVisual_m"><a href="../static/coDraw.php">Co-Visual</a></li>';
              // echo '<li id="coVisual_m"><a href="../static/coVisual.php">协同过程可视化</a></li>';
              // echo '<li><a href="../static/coEdit.php">协同编辑</a></li>';
              echo '<li id="coEdit_m"><a href="../static/coEdit.php">协同编辑</a></li>';
              echo '<li id="coSchedule_m"><a href="../static/calendar.php">日程管理</a> </li>';
              echo '<li id="coChat_m"><a href="../static/communication.php">通讯管理</a></li>';
              // echo '<li><a href="http://49.233.193.226:8000/">通讯管理</a></li>';
              // echo '</ul>'
              echo '<li ><a href="../php/logout.php" id="logOutButton">退出</a></li>';
              
            } else {
              // echo '<li><a href="../index.php">首页</a></li>';
              // echo '<li><a href="../index.php#contact">联系我们</a></li>';
                      
              echo '<li id="login_m"><a href="../static/signup.php">注册</a></li>';
              echo '<li id="signUp_m" style="background-color: #2bbbad;"><a href="../static/login.php" >登录</a></li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</div>

<!-- Log out function -->
<script type="text/javascript">
  function showMenu(){
    $("#menu").slideToggle("fast");
  }

</script>
