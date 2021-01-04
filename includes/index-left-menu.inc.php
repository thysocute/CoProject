<div class="sideMenu">
  <h3 class="firstBar">用户管理</h3>
  <ul class="secondBar" style="display: block;">
    <li><a href="../static/userList.php">用户列表</a></li>
    <li><a href="../static/userDevice.php">用户设备</a></li>
    <li><a href="../static/personalInfo.php?account=<?php echo $_SESSION["account"];?>">个人信息</a></li>
  </ul>
  <h3 class="firstBar">团队管理</h3>
  <ul class="secondBar" style="display: block;">
    <li><a href="../static/myTeamList.php">我的团队</a></li>
    <li><a href="../static/createTeam.php">创建团队</a></li>
    <li><a href="../static/joinTeam.php">加入团队</a></li>
  </ul>
  <h3 class="firstBar">任务管理</h3>
  <ul class="secondBar" style="display: block;">
    <li><a href="../static/createTask.php">新建任务</a></li>
    <li><a href="../static/taskList.php">任务列表</a></li>
    <!-- <li><a href="#">二级导航</a></li> -->
  </ul>
  <h3 class="firstBar">会议管理</h3>
  <ul class="secondBar" style="display: block;">
    <li><a href="../static/createMeeting.php">新建会议</a></li>
    <li><a href="../static/MeetingList.php">会议列表</a></li>
    <!-- <li><a href="#">二级导航</a></li> -->
  </ul>
</div> <!-- class="sideMenu" end-->
