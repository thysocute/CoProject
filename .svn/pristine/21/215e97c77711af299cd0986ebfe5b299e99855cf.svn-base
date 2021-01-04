$(function(){
	

	$("#testBtn").click(function(){
		var title = $("#title").val();
		var description = $("#description").val();
		var startdate = $("#startdate").val();
		var starttime = $("#starttime").val().split(" ").join("");
		var enddate = $("#stopdate").val();
		var endtime = $("#endtime").val().split(" ").join("");
		var allDay = $("#isallday").val();
		var remark = $('#remark option:selected').val();//选中的值

		// 隐藏弹出框
		$("#dialog-form").css("display","none");

		// 如果没选结束时间则设置结束时间为开始时间日期的最后一刻
		if(enddate == "") {
			enddate = startdate;
			endtime = "23:59:59";
		}
		// 如果选择了全天，则将结束时间的 时分秒设置成最后一刻
		if (allDay == 1) {
			endtime = "23:59:59";
		}
		// 开始时间 时间戳
		var starohaveHis = $.myTime.DateToUnix(startdate+" "+starttime); 
		// 结束时间 时间戳
		var endohaveHis = $.myTime.DateToUnix(enddate+" "+endtime); 
		// 通过时间戳比较起止时间大小
		if (starohaveHis >= endohaveHis) {
			alert("结束时间不能小于开始时间！")
		}

		if(title){
			$.ajax({
				url:'../php/eventsTime.php',
				data:{title:title,description:description,sdate:startdate,stime:starttime,edate:enddate,etime:endtime,allDay:allDay,remark:remark},
				type:'POST',
				dataType:'json',
				success:function(data){
					console.log(data);
					var eventsIdArr = []; // 时间冲突事件ID数组

					// 如果返回结果有时间冲突，就弹出事件优先度排序面板
					// 否则直接提交数据

					if(data.length>0) {
						$("#importanceRand").css("display","block");
						// 该次日程事件
						var dragStr = "<div class='eventItem' id='newId' draggable='true' ondragstart='drag(event)'>"
									+ "<p>" + title + "</p>"
									+ "<p><span>" + startdate + " " + starttime + "</span>"
									+ "--><span>" + enddate + " " + endtime
									+ "</span></p></div>";
						$("#eventList").append(dragStr);
						// 循环输出时间冲突的日程事件
						for(var i=0; i<data.length;i++) {
							dragStr = "<div class='eventItem' id='" + data[i].id + "' draggable='true' ondragstart='drag(event)'>"
									+ "<p>" + data[i].title + "</p>"
									+ "<p><span>" + data[i].start + "</span>"
									+ "--><span>" + data[i].end
									+ "</span></p></div>";
							$("#eventList").append(dragStr); 
						}

						// 可拖放存放的位置
						var dropStr = "";
						var levelStr = "";
						for(var j=1; j<= (data.length + 1); j++) {
							dropStr = "<li id='rand" + (j) + "' ondrop='drop(event)' ondragover='allowDrop(event)'></li>"
							$("#dropBox").append(dropStr); 

							levelStr = "<span>level" + j + "</span>";
							$("#levelBox").append(levelStr);
						}

						// 取消按钮
						$("#resetBtn").click(function() {
							$("#importanceRand").css("display","none");
							// 显示新建日程弹出框
							$("#dialog-form").css("display","block");
							return false;
						})

						// 跳过直接提交按钮
						$("#submitBtn").click(function() {
							$("#importanceRand").css("display","none");
							$.ajax({
								url:'../php/modifyColor.php',
								data: {eventJSON:eventsIdArr,title:title,description:description,sdate:startdate,stime:starttime,edate:enddate,etime:endtime,allDay:allDay,remark:remark},
								type:'POST',
								dataType:'json',
								success:function(data){
									console.log(data);
									// 刷新当前文档
									// location.reload();
									// 从各个数据源重新获取并且渲染数据：
									// $('#calendar').fullCalendar('refetchEvents');
									
								},
								error:function(){
									alert("Failed");
								}
							});
						})

						// 确认按钮
						$("#setSubBtn").click(function() {
							// var events = $("#rand1 li").attr("id");
							// var eventsIdArr = [];
							$("#dropBox li").each(function(){
								var eventId = $(this).find(".eventItem").attr("id");
								eventsIdArr.push(eventId);
							});

							$.ajax({
								url:'../php/modifyColor.php',
		   						data: {eventJSON:eventsIdArr,title:title,description:description,sdate:startdate,stime:starttime,edate:enddate,etime:endtime,allDay:allDay,remark:remark},
		   						type:'POST',
		   						dataType:'json',
		  						success:function(data){
		  							console.log(data);
		  							// 刷新当前文档
		  							// location.reload();
		  							// 从各个数据源重新获取并且渲染数据：
		  							// $('#calendar').fullCalendar('refetchEvents');
		  							
		  						},
		  						error:function(){
		  							alert("Failed");
		  						}
		   						
							});


						}) /* #submitBtn end */
					
					} else {
						$.ajax({
							url:'../php/modifyColor.php',
							data: {eventJSON:eventsIdArr,title:title,description:description,sdate:startdate,stime:starttime,edate:enddate,etime:endtime,allDay:allDay,remark:remark},
							type:'POST',
							dataType:'json',
							success:function(data){
								console.log(data);
								// 刷新当前文档
								// location.reload();
								// 从各个数据源重新获取并且渲染数据：
								// $('#calendar').fullCalendar('refetchEvents');
								
							},
							error:function(){
								alert("Failed");
							}
								
						});
					}

					

					
					
				},
				error:function(){
					alert("Failed");
				}
				
			});
		};

	})
})

function allowDrop(ev) {
	ev.preventDefault();
}

function drag(ev) {
	ev.dataTransfer.setData("Text",ev.target.id);
}

function drop(ev) {
	ev.preventDefault();
	var data=ev.dataTransfer.getData("Text");
	ev.target.appendChild(document.getElementById(data));
}