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
    <div class="col-xs-3 col-sm-3 col-md-2">
        <?php include "../includes/index-left-menu.inc.php"; ?>
    </div><!-- 侧边栏 section end -->
      
    <!-- 任务列表展示 -->
    <div class="col-xs-9 col-sm-9 col-md-10" style="height: 100%;" id="jsCol">
      <div class="boxBackground">
        <div class="addInfoBox">
          <div class="BoxHead clearfix">
            <h4 style="float: left;">添加设备</h4>
            <span id="CancelAddBtn" class="glyphicon glyphicon-remove delectIcon"></span>
          </div> <!-- class="BoxHead" end-->
          <hr>
          <div class="BoxBody">
            <p id="deviceTips" class="errTips"></p>
            <form id="addDeviceForm" role="form" action="" 
                  method="post"  name="addDeviceForm">
              <div class="form-group">
                <label>设备类型</label>
                <select id="type" class="selectStyle" name="deviceType">
                    <option value="-1">请选择</option>
                </select>
              </div>
              <div class="form-group">
                <label>设备品牌</label>
                <select id="brand" class="selectStyle" name="deviceBrand"></select>
              </div>
              <div class="form-group">
                <label>设备型号</label>
                <select id="model" class="selectStyle" name="deviceModel"></select>
              </div>
              <div class="form-group">
                <button type="submit" id="addDeviceBtn" class="btn submitBtn">提 交</button>
              </div>
            </form>
          </div><!-- class="BoxBody" end-->
        </div><!-- class="addInfoBox" end-->
      </div><!-- class="boxBackground" end-->
      <div >
        <!-- 右侧头部 -->
        <ol class="breadcrumb">
          <li>所在位置：</li>
          <li>用户管理</li>
          <li class="active">用户设备</li>
        </ol>
        <!-- 添加设备 Section -->
        <div class="searchBox">
          <form class="searchForm clearfix" action="">
            <div class="condition">
              <label for="deviceSearch">类型</label>
              <select class="selectStyle" id="deviceSearch">
                  <option value="PC">PC</option>
                  <option value="laptop">laptop</option>
                  <option value="tablet">tablet</option>
                  <option value="cellPhone">cellPhone</option>
              </select>
            </div>
            <div class="btnGroup">
              <button id="searchBtn" class="listBtn">查 询</button>
            </div>
          </form>
        </div><!-- class="searchBox" end-->
        <div class="addBtnBox">
          <button id="addBtn" class="listBtn">添 加</button>
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