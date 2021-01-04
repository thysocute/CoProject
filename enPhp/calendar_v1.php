<?php
	require_once('../includes/databaseConnection.php');
	session_start();
/**
 * Created by Qian.
 * User: 
 * Date: 2020/4/3
 * Time: 上午8:20
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "../enIncludes/head-meta-data.inc.php"; ?>
	<!-- <link rel='stylesheet' href='../fullcalendar/fullcalendar.css' /> -->
 	<link rel='stylesheet' href='../css/index.css' />
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
		<!-- 组员 section-->
		<div class="col s12 m3">
			<div class="col s12" id="lista">
                <div class="row">
                  <div class="col s12">
                    <!-- <a id="btnAddUser" class="modal-action modal-close waves-effect waves-light btn-small blue"><i class="material-icons">person_add</i></a> -->
                  </div>
                    <?php include './userlist.php'; ?>
                </div>
            </div>
		</div><!-- 组员 section end -->
		
		<!-- 日历section -->
		<div class="col s12 m9">
			<div id="calendar"></div>
			<div id="set" style="display:none" class="taxt">
				<div id="slider"></div>
				<div style="text-align: center" class="slidertext">
					<input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold; text-align: center; font-size: 16px;">
				</div>
			</div>
			<div id="edit" style="display: none">
				<p id="edittitle"></p>
				<select id="edittype">
					<option value="">No-processing</option>
					<option value="">Processing</option>
					<option value="">Finished</option>
					<option value="">Timeout</option>
				</select>
				<p id="edittime"></p>
			</div>
			<div id="dialog-form" style="display:none">
				<form class="form-inline">
					<p>
						<label>Affair Title：</label>
						<input type="text" class="form-control" id="title">
					</p>
					<p>
						<label>Affair Content：</label>
						<textarea class="textarea" rows="4" placeholder="content" id="description"></textarea>
						<span>（Required）</span>
					</p>
					<p>
						<label>Affair Tpye：</label>
						<select class="select" id="remark">
							<option value="0" selected>Personal Affair</option>
							<option value="1">Work Affair</option>
						</select>
					</p>
					<p>
						<label>Start Time：</label>
						<input type="text" class="time datepicker" id="startdate">
						<input type="text" class="time timepicki" id="starttime">
					</p>
					<p style="display:none" id="enddate">
						<label>End Time：</label>
						<input type="text" class="time datepicker" id="stopdate">
						<input type="text" class="time timepicki" id="endtime">
					</p>
					<p class="checkbox check">
						<label class="checkbox-inline"><input type="checkbox" id="isallday" value="0">All day long </label>
						<label class="checkbox-inline"><input type="checkbox" id="end">End Time</label>
						<label class="checkbox-inline"><input type="checkbox" id="repeat">Repetition </label>
					</p>
					<p id="repeattype" style="display: none">
						<label>Repetition Time：</label>
						<select class="select" id="repeatselect">
							<option value="1">Repeat by  day</option>
							<option value="2">Repeat by  week</option>
							<option value="3">Repeat by  month</option>
							<option value="4">Repeat by years</option>
							<option value="5">Repeat by working day</option>
						</select>
					</p>
					<p id="repeattime" style="display: none">
						<label>Repeat Time：</label>
						<select class="time" id="repeatmonth" style="display:none">
							<option value="">January</option>
							<option value="">February</option>
							<option value="">March</option>
							<option value="">April</option>
							<option value="">May</option>
							<option value="">June</option>
							<option value="">July</option>
							<option value="">August</option>
							<option value="">September</option>
							<option value="">October</option>
							<option value="">November</option>
							<option value="">December</option>
						</select>
						<select class="time" id="repeatday" style="display:none">
							<option value="">1</option>
							<option value="">2</option>
							<option value="">3</option>
							<option value="">4</option>
							<option value="">5</option>
							<option value="">6</option>
							<option value="">7</option>
							<option value="">8</option>
							<option value="">9</option>
							<option value="">10</option>
							<option value="">11</option>
							<option value="">12</option>
							<option value="">13</option>
							<option value="">14</option>
							<option value="">15</option>
							<option value="">16</option>
							<option value="">17</option>
							<option value="">18</option>
							<option value="">19</option>
							<option value="">20</option>
							<option value="">21</option>
							<option value="">22</option>
							<option value="">23</option>
							<option value="">24</option>
							<option value="">25</option>
							<option value="">26</option>
							<option value="">27</option>
							<option value="">28</option>
							<option value="">29</option>
							<option value="">30</option>
							<option value="">31</option>
						</select>
						<select class="time" id="repeatweek" style="display:none">
							<option value="">Monday</option>
							<option value="">Tuesday</option>
							<option value="">Wednesday</option>
							<option value="">Thursday</option>
							<option value="">Friday</option>
							<option value="">Saturday</option>
							<option value="">Sunday</option>
						</select>
						<input type="text" class="time timepicki" id="repeatclock">
					</p>
					<p>
						<label>&nbsp;&nbsp;&nbsp;Participants：</label>
						<textarea rows="3"></textarea>
					</p>
					<p></p>
				</form>
			</div>
			<!-- 查询模块 -->
			<div id="search" style="display:none">
				<form class="form-inline">
					<p>
						<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Data：</label>
						<input type="text" class="sear datepicker">
						<span>to</span>
						<input type="text" class="sear datepicker">
					</p>
					<p>
						<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;State：</label>
						<select>
						     <option value="">No-processing</option>
					         <option value="">Processing</option>
					         <option value="">Finished</option>
					         <option value="">Timeout</option>
						</select>
					</p>
					<p>
						<label>Affair Type：</label>
						<select>
							<option value="">Work Affair</option>
							<option value="">Personal Affair</option>
						</select>
					</p>
					<p>
						<label>Affair Content：</label>
						<input type="text">
					</p>
				</form>
			</div>
		</div>
		<!-- 日历section end -->
	</div> <!-- class="row" end -->
</div> <!-- class="container" end -->
	
</body>
</html>