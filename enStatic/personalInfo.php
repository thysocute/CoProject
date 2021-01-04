<?php
    require_once('../includes/databaseConnection.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../enIncludes/head-meta-data.inc.php"; ?>
    <link rel='stylesheet' href='../css/index.css' />
    <!-- <link rel="stylesheet" type="text/css" href="../css/createTask.css"> -->
     
</head>
<body>
<header>
  <div>
    <!-- Navigation Bar -->
    <?php include "../enIncludes/navigation-bar.inc.php"; ?>
    <!-- End of Navigation Bar -->
  </div>
</header>
<div class="container">
  <div class="row">
    <!-- 侧边栏 section-->
    <div class="col-xs-3 col-sm-3 col-md-2">
        <?php include "../enIncludes/index-left-menu.inc.php"; ?>
    </div><!-- 组员 section end -->
    
    <!-- 关系图展示 -->
    <div class="col-xs-9 col-sm-9 col-md-10">
      <div class="container">
      <!-- 右侧头部 -->
        <ol class="breadcrumb">
            <li>Location：</li>
          <li>User Management</li>
            <li class="active">Personal Information</li>
        </ol>

        <!-- 标题 -->
        <div class="partTitle">
          <h4>New Task</h4>
        </div>
          
        <div class='rows'>
          wwww
            
        </div>
      </div>
    </div>
  </div> <!-- class="row" end -->
</div> <!-- class="container" end -->
<script type="text/javascript">
  window.onload = function(){
    var oDeviceInfo = document.getElementById("deviceInfo");
    oDeviceInfo.innerHTML = getDeviceType();
    // isPC = IsPC();
  }
  // 获取当前设备类型
  function getDeviceType() {
    var uAInfo = navigator.userAgent;
    // 判断设备类型
    if(uAInfo.match(/Android/i)) {
        return "Android";
    } else if(uAInfo.match(/webOS/i)) {
        return "webOS";
    } else if(uAInfo.match(/iPhone/i)){
        return "iPhone";
    } else if(uAInfo.match(/iPad/i)){
        return "iPad";
    } else if(uAInfo.match(/iPod/i)){
        return "iPod";
    } else if(uAInfo.match(/BlackBerry/i)){
        return "BlackBerry";
    } else if(uAInfo.match(/Windows Phone/i)){
        return "Windows Phone";
    } else {
        return "PC";
    }
  }

</script>
</body>
</html>