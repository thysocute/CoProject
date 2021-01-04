<div class="sideMenu">
  <h3 class="firstBar">User Management</h3>
  <ul class="secondBar" style="display: block;">
    <li><a href="../enStatic/userList.php">User List</a></li>
    <li><a href="../enStatic/userDevice.php">User Devices</a></li>
    <li><a href="../enStatic/personalInfo.php?account=<?php echo $_SESSION["account"];?>">Personal Information</a></li>
  </ul>
  <h3 class="firstBar">Team Mangement</h3>
  <ul class="secondBar" style="display: block;">
    <li><a href="../enStatic/myTeamList.php">My Team </a></li>
    <li><a href="../enStatic/createTeam.php">Creat Team</a></li>
    <li><a href="../enStatic/joinTeam.php">Join The Team</a></li>
  </ul>
  <h3 class="firstBar">Task Mangement</h3>
  <ul class="secondBar" style="display: block;">
    <li><a href="../enStatic/createTask.php">Creat Task</a></li>
    <li><a href="../enStatic/taskList.php">Task List</a></li>
    <!-- <li><a href="#">二级导航</a></li> -->
  </ul>
</div> <!-- class="sideMenu" end-->
