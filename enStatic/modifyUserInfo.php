<?php
    require_once('../includes/databaseConnection.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../enIncludes/head-meta-data.inc.php"; ?>
    <link rel='stylesheet' href='../css/index.css' />
    <link rel="stylesheet" type="text/css" href="../css/createTask.css">
     
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
      <h5>Improve Personal Information</h5>
      <hr/>
      <div class='rows'>
      <?php include '../php/getUserInfo.php'; ?>
      <form role="form" action="../php/getUserInfo.php?account=<?php echo $_SESSION["account"];?>" method="post"  name="taskForm">
      <div class="form-group">
        <label>Account:</label>
        <input type="text" class="form-control"  name="account" 
              id="account" disabled="disabled" value='<?php echo $results[0]["account"]; ?>'>
      </div>
      <div class="form-group">
        <label>Name:</label>
        <input type="text" class="form-control"  name="name" 
          id="name" placeholder="Please enter your name" value="<?php echo $results[0]["username"]; ?>">
      </div>
      <div class="form-group">
        <label>Phone Number:</label>
        <input type="tel" class="form-control"  name="tel" 
          id="tel" placeholder="Please enter your mobile phone number" value="<?php echo $results[0]["phone"]; ?>">
      </div>
      <div class="form-group">
        <label>E-mail:</label>
        <input type="email" class="form-control"  name="email" 
          id="email" placeholder="Please enter your email address" value="<?php echo $results[0]["email"]; ?>">
      </div>
      <div class="form-group">
          <!-- <input type="hidden" value="" name="partTeamVal" id="partTeamVal"> -->
        <label>My Device:</label>
        <ol>
          <?php 
            if (count($deviceArr)) {
              foreach ($deviceArr as $value) {
                echo ' <li data-id="'.$value['deviceId'].'">'.$value['deviceName'].'</li>';
              }
            } else {
              echo "请添加设备";
            } 
          ?> 
        </ol>

        
      </div>
      <div class="form-group">
          <!-- <input type="hidden" value="" name="partTeamVal" id="partTeamVal"> -->
        <label>Add Device:</label>
        <select>
          <option value="PC">PC</option>
          <option value="Android">Android</option>
          <option value="iPhone">iPhone</option>
          <option value="iPad">iPad</option>
          <option value="webOS">webOS</option>
          <option value="iPod">iPod</option>
          <option value="BlackBerry">BlackBerry</option>
          <option value="Windows Phone">Windows Phone</option>
        </select>
        
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
      </form>
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