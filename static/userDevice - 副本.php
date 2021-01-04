<?php
    require_once('../includes/databaseConnection.php');
  session_start();
  require_once("../includes/checkLogin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../includes/head-meta-data.inc.php"; ?>
    <link rel='stylesheet' href='../css/index.css' />
    <link rel='stylesheet' href='../css/list.css' />
    <script type="text/javascript" src="../js/device.js"></script>
    <!-- <script type="text/javascript" src="../js/multiSelect.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="../css/taskList.css"> -->
    <style type="text/css">
        .updateBtn, .delBtn, .addBtn {
            color: #2bbbad;
            cursor: pointer;
        }
        .updateBtn:hover, .delBtn:hover, .addBtn:hover {
            color: blue;
        }
        .clearfix:after { 
            content:"\200B"; 
            display:block; 
            height:0; 
            clear:both; 
        } 
    </style>
    <!-- <script type="text/javascript">
      $(function() {
        alert("lll")
      })
    </script> -->
</head>
<body>
<header>
    <div>
      <!-- Navigation Bar -->
      <?php include "../includes/navigation-bar.inc.php"; ?>
      <!-- End of Navigation Bar -->
    </div>
</header>
<div class="container">
  <div class="row">
    <!-- 侧边栏 section-->
    <div class="col s12 m3">
        <?php include "../includes/index-left-menu.inc.php"; ?>
    </div><!-- 侧边栏 section end -->
      
    <!-- 任务列表展示 -->
    <div class="col s12 m9" id="jsCol">
      <div class="boxBackground">
        <div class="addInfoBox">
          <div class="BoxHead">
            <h5>添加设备</h5>
          </div> <!-- class="BoxHead" end-->
          <hr>
          <div class="BoxBody">
            <p id="deviceTips" class="errTips"></p>
            <form id="addDeviceForm" role="form" action="" 
                  method="post"  name="addDeviceForm">
              <div class="form-group">
                <label>设备类型</label>
                <select id="type" name="deviceType">
                    <option value="-1">请选择</option>
                </select>
              </div>
              <div class="form-group">
                <label>设备品牌</label>
                <select id="brand" name="deviceBrand"></select>
              </div>
              <div class="form-group">
                <label>设备型号</label>
                <select id="model" name="deviceModel"></select>
              </div>
              <div class="form-group">
                <button type="submit" id="deviceBtn" class="btn btn-default">提交</button>
              </div>
            </form>
          </div><!-- class="BoxBody" end-->
        </div><!-- class="addInfoBox" end-->
      </div><!-- class="boxBackground" end-->
      <div class="container">
        <!-- 右侧头部 -->
        <div>所在位置：<span>设备管理</span></div>
        <div class="searchBox">
          <form class="searchForm clearfix" action="">
            <div class="condition">
              <label>类型</label>
              <select>
                  <option value="PC">PC</option>
                  <option value="laptop">laptop</option>
                  <option value="tablet">tablet</option>
                  <option value="cellPhone">cellPhone</option>
              </select>
            </div>
            <div class="btnGroup">
              <button id="searchBtn" class="listBtn">查询</button>
            </div>
          </form>
        </div><!-- class="searchBox" end-->
        <div class="addBtnBox">
          <button id="addBtn" class="listBtn">添加</button>
        </div><!-- class="addBtnBox" end-->
        
        <table class="table table-striped">
          <thead>
            <tr>
                <th>序号</th>
                <th>设备类型</th>
                <th>设备品牌</th>
                <th>设备型号</th>
                <th>管理</th>
            </tr>
          </thead>
          <tbody>
            <!-- <div class="emptyTips" style="display: none; text-align: center;padding-top: 50px;">   
                您暂时还没有加入任何团队，请前往创建团队或者加入团队！
            </div> -->
            <?php include '../php/getDevices.php'; ?>
          </tbody>
        </table>
      </div><!-- class="container" end -->

    </div> <!-- class="col" end -->
  </div> <!-- class="row" end -->
</div> <!-- class="container" end -->


<!-- <script type="text/javascript" src="../js/multiSelect.js"></script> -->
<!-- <script type="text/javascript" src="../js/multiSelect.js"></script> -->


</body>
</html>