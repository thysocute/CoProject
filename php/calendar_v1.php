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
	<?php include "../includes/head-meta-data.inc.php"; ?>
	<!-- <link rel='stylesheet' href='../fullcalendar/fullcalendar.css' /> -->
 	<link rel='stylesheet' href='../css/index.css' />
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
					<option value="">未进行</option>
					<option value="">进行中</option>
					<option value="">已完成</option>
					<option value="">已超时</option>
				</select>
				<p id="edittime"></p>
			</div>
			<div id="dialog-form" style="display:none">
				<form class="form-inline">
					<p>
						<label>事务标题：</label>
						<input type="text" class="form-control" id="title">
					</p>
					<p>
						<label>事务内容：</label>
						<textarea class="textarea" rows="4" placeholder="内容" id="description"></textarea>
						<span>（必填）</span>
					</p>
					<p>
						<label>事务类型：</label>
						<select class="select" id="remark">
							<option value="0" selected>个人事务</option>
							<option value="1">工作事务</option>
						</select>
					</p>
					<p>
						<label>开始时间：</label>
						<input type="text" class="time datepicker" id="startdate">
						<input type="text" class="time timepicki" id="starttime">
					</p>
					<p style="display:none" id="enddate">
						<label>结束时间：</label>
						<input type="text" class="time datepicker" id="stopdate">
						<input type="text" class="time timepicki" id="endtime">
					</p>
					<p class="checkbox check">
						<label class="checkbox-inline"><input type="checkbox" id="isallday" value="0">全天</label>
						<label class="checkbox-inline"><input type="checkbox" id="end">结束时间</label>
						<label class="checkbox-inline"><input type="checkbox" id="repeat">重复</label>
					</p>
					<p id="repeattype" style="display: none">
						<label>重复类型：</label>
						<select class="select" id="repeatselect">
							<option value="1">按天重复</option>
							<option value="2">按周重复</option>
							<option value="3">按月重复</option>
							<option value="4">按年重复</option>
							<option value="5">按工作日重复</option>
						</select>
					</p>
					<p id="repeattime" style="display: none">
						<label>重复时间：</label>
						<select class="time" id="repeatmonth" style="display:none">
							<option value="">1月</option>
							<option value="">2月</option>
							<option value="">3月</option>
							<option value="">4月</option>
							<option value="">5月</option>
							<option value="">6月</option>
							<option value="">7月</option>
							<option value="">8月</option>
							<option value="">9月</option>
							<option value="">10月</option>
							<option value="">11月</option>
							<option value="">12月</option>
						</select>
						<select class="time" id="repeatday" style="display:none">
							<option value="">1日</option>
							<option value="">2日</option>
							<option value="">3日</option>
							<option value="">4日</option>
							<option value="">5日</option>
							<option value="">6日</option>
							<option value="">7日</option>
							<option value="">8日</option>
							<option value="">9日</option>
							<option value="">10日</option>
							<option value="">11日</option>
							<option value="">12日</option>
							<option value="">13日</option>
							<option value="">14日</option>
							<option value="">15日</option>
							<option value="">16日</option>
							<option value="">17日</option>
							<option value="">18日</option>
							<option value="">19日</option>
							<option value="">20日</option>
							<option value="">21日</option>
							<option value="">22日</option>
							<option value="">23日</option>
							<option value="">24日</option>
							<option value="">25日</option>
							<option value="">26日</option>
							<option value="">27日</option>
							<option value="">28日</option>
							<option value="">29日</option>
							<option value="">30日</option>
							<option value="">31日</option>
						</select>
						<select class="time" id="repeatweek" style="display:none">
							<option value="">星期一</option>
							<option value="">星期二</option>
							<option value="">星期三</option>
							<option value="">星期四</option>
							<option value="">星期五</option>
							<option value="">星期六</option>
							<option value="">星期日</option>
						</select>
						<input type="text" class="time timepicki" id="repeatclock">
					</p>
					<p>
						<label>&nbsp;&nbsp;&nbsp;参与者：</label>
						<textarea rows="3"></textarea>
					</p>
					<p></p>
				</form>
			</div>
			<!-- 查询模块 -->
			<div id="search" style="display:none">
				<form class="form-inline">
					<p>
						<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日期：</label>
						<input type="text" class="sear datepicker">
						<span>至</span>
						<input type="text" class="sear datepicker">
					</p>
					<p>
						<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;状态：</label>
						<select>
							<option value="">未进行</option>
							<option value="">进行中</option>
							<option value="">已完成</option>
							<option value="">已超时</option>
						</select>
					</p>
					<p>
						<label>事务类型：</label>
						<select>
							<option value="">工作事务</option>
							<option value="">个人事务</option>
						</select>
					</p>
					<p>
						<label>事务内容：</label>
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