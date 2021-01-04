$(function(){
	$("#calendar").fullCalendar({
		theme: true,
		customButtons:{
			button1:{
				text:"new",
				click:function(){
					// 日期面板
					$(".datepicker").datepicker({
						language:"zh-CN",
						format:"yyyy-mm-dd",
						todayHighlight:true,
						autoclose:true,
						weekStart:0
					});
					// 时间面板
					$(".timepicki").wickedpicker({
						title:'',
						showSeconds:true,
						twentyFour:true
					});
					// 是否选择全天 选择值为1 不选择则显示开始时间和结束时间输入框
					$("#isallday").click(function(){
						if($("#isallday").prop("checked") == true){
							$("#isallday").val("1");
							$("#starttime,#endtime").hide();
						}else{
							$("#isallday").val("0");
							$("#starttime,#endtime").show();
						};	
					});
					// 是否选择结束时间
					$("#end").click(function(){
						if($("#end").prop("checked") == true){
							$("#enddate").show();
						}else{
							$("#enddate").hide();
						};
					});
					// 是否选择重复 重复类型 重复时间
					$("#repeat").click(function(){
						if($("#repeat").prop("checked") == true){
							$("#repeattype,#repeattime").show();
						}else{
							$("#repeattype,#repeattime").hide();
						};
					});
					// 重复添加附加项
					$("#repeatselect").change(function(){
						switch($("#repeatselect").val()){
							case "1":
								$("#repeatclock").show();
								$("#repeatmonth,#repeatweek,#repeatday").hide();
								break;
							case "2":
								$("#repeatmonth,#repeatday").hide();
								$("#repeatweek,#repeatclock").show();
								break;
							case "3":
								$("#repeatmonth,#repeatweek").hide();
								$("#repeatday,#repeatclock").show();
								break;
							case "4":
								$("#repeatweek").hide();
								$("#repeatmonth,#repeatday,#repeatclock").show();
							break;
							case "5":
							$("#repeatclock").show();
								$("#repeatmonth,#repeatweek,#repeatday").hide();
								break;
						}
					});
					// 对话框
					dialog({
						title:"New Schedule",
						content:$("#dialog-form"),
						okValue:"Confirm", 
						ok:function(){
							var title = $("#title").val();
							var description = $("#description").val();
							var startdate = $("#startdate").val();
							var starttime = $("#starttime").val().split(" ").join("");
							var enddate = $("#stopdate").val();
							var endtime = $("#endtime").val().split(" ").join("");
							var allDay = $("#isallday").val();
							var remark = $('#remark option:selected').val();//选中的值
							console.log(enddate)
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
								alert("The end time cannot be less than the beginning time！")
							}

							// 
							if(title){
								$.ajax({
									url:'../enPhp/addCalendarEvents.php',
			   						data:{title:title,description:description,sdate:startdate,stime:starttime,edate:enddate,etime:endtime,allDay:allDay,remark:remark},
			   						type:'POST',
			   						dataType:'json',
			  						success:function(data){
			  							console.log(data);

			  							// 查询是否时间冲突，若冲突 则弹出询问框询问是否设置事件优先度
			  							$.ajax({
												url:'../php/eventsTime.php',
												data:{sdate:startdate,stime:starttime,edate:enddate,etime:endtime},
												type:'POST',
												dataType:'json',
												success:function(data){
													console.log(data)
													console.log(data.length)
													if(data.length > 1) {
														if (confirm("Schedule time conflicts, whether to set event priority？")) {
															// 点击确认按钮
														  	showRandSet(data);
														} else {
															// 点击取消按钮
														  	console.log("You have unset the event priority!");
														  	$('#calendar').fullCalendar('refetchEvents');
														}
													}
													
												},
												error:function(){
					  							alert("Failed");
					  						}
					  					})


			  							// 从各个数据源重新获取并且渲染数据：
			  							// $('#calendar').fullCalendar('refetchEvents');
			  							
			  							
				  					},
			  						error:function(){
			  							alert("Failed");
			  						}
			   						
								});
							};
						},
						cancelValue:"Close",
						cancel:function(){
							//$("#ui-datepicker-div").remove();
						}
					}).showModal();
				}
			},
			button2:{
				text:"inquire",
				click:function(){
					$(".datepicker").datepicker({
						language:"zh-CN",
						format:"yyyy-mm-dd",
						todayHighlight:true,
						autoclose:true,
						weekStart:0
					});
					dialog({
						title:"Inquire",
						content:$("#search"),
						okValue:"Inquire",
						ok:function(){
							// todo
							$("#ui-datepicker-div").remove();
						},
						button:[{
							value:"Printf"
						}],
						cancelValue:"Back",
						cancel:function(){
							$("#ui-datepicker-div").remove();
						}
					}).showModal();

				}
			},
			button3:{
				text:"setting",
				click:function(){
					$("#slider").slider({
						range:true,
						min:0,
						max:24,
						values:[8,18],
						slide: function( event, ui ) {
			        		$( "#amount" ).val(ui.values[ 0 ] + ":00 - " + ui.values[ 1 ]+":00");
			        		
			      		}
					});
					$( "#amount" ).val($( "#slider" ).slider( "values", 0 ) +
  ":00 - " + $( "#slider" ).slider( "values", 1 )+":00");
					dialog({
						title:"Set time period",
						content:$("#set"),
						okValue:"confirm",
						ok:function(){
							var minTime = $( "#slider" ).slider( "values", 0 )+":00:00";
			      			var maxTime = $( "#slider" ).slider( "values", 1 )+":00:00";
			      			$("#calendar").fullCalendar("option","minTime",minTime);
			      			$("#calendar").fullCalendar("option","maxTime",maxTime);
						},
						cancelValue:"close",
						cancel:function(){}
					}).showModal();
				}
			}
		},
		header: {
			left: 'prev,next today button3',
			center: 'title',
			right: 'button1 button2 month,agendaWeek,agendaDay,listMonth'
		},
		firstDay: 1,
		monthNames: ["January","February","March","April","May","June","July","August","September","October","November","December"],
		monthNamesShort: ["January","February","March","April","May","June","July","August","September","October","November","December"],
		dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
		dayNamesShort:["day","one","two","three","four","five","six"],
		buttonText:{
			today: "today",
			month: "month",
			week: "week",
			day: "day",
			listMonth:"list"
		},
		allDayDefault:false,
		slotLabelFormat:"H",
		businessHours: {
			dow:[1,2,3,4,5],
			start:"8:00",
			end:"17:00"
		},
		allDaySlot: true,
		allDayText: "all the day",
		timeFormat: "HH:mm",//设置的是添加的具体的日程上显示的时间
		views:{
			month:{
				titleFormat:"YYYY.M"
			},
			week:{
				titleFormat:"YYYY.M.D",
				columnFormat:"M.D dddd"
			},
			day:{
				titleFormat:"YYYY.M.D dddd",
				columnFormat:"M/D dddd"
			}
		},
		eventSources: [
	        {
	          	url: '../enPhp/getCalendarEvents.php',
				success: function(data) {
					console.log(data);
					console.log("fetch succesful (./getCalendarEvents.php) success");
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log("fetch unsuccessful (./getCalendarEvents.php) noload");
				}
	        }
	    ], // End of event sources
		dayClick: function(date,allDay,jsEvent,view){
			var selDate = $.fullCalendar.formatDate(date,"YYYY-MM-DD");
			var d = dialog({
				title:"New Event",
				content:"<textarea rows=5 class='taxt' placeholder='content' id='eventall'></textarea><p>"+selDate+"</p>",
				width:460,
				button:[{
					value:"Complete the editor",
					callback:function(){
						$(".datepicker").datepicker({
							language:"zh-CN",
							format:"yyyy-mm-dd",
							todayHighlight:true,
							autoclose:true,
							weekStart:0
						});
						$(".timepicki").wickedpicker({
							title:'',
							showSeconds:true,
							twentyFour:true
						});
						$("#isallday").click(function(){
							if($("#isallday").prop("checked") == true){
								$("#isallday").val("1");
								$("#starttime,#endtime").hide();
							}else{
								$("#isallday").val("0");
								$("#starttime,#endtime").show();
							};	
						});
						$("#end").click(function(){
							if($("#end").prop("checked") == true){
								$("#enddate").show();
							}else{
								$("#enddate").hide();
							};
						});
						$("#repeat").click(function(){
							if($("#repeat").prop("checked") == true){
								$("#repeattype,#repeattime").show();
							}else{
								$("#repeattype,#repeattime").hide();
							};
						});
						$("#repeatselect").change(function(){
							switch($("#repeatselect").val()){
								case "1":
									$("#repeatclock").show();
									$("#repeatmonth,#repeatweek,#repeatday").hide();
									break;
								case "2":
									$("#repeatmonth,#repeatday").hide();
									$("#repeatweek,#repeatclock").show();
									break;
								case "3":
									$("#repeatmonth,#repeatweek").hide();
									$("#repeatday,#repeatclock").show();
									break;
								case "4":
									$("#repeatweek").hide();
									$("#repeatmonth,#repeatday,#repeatclock").show();
									break;
								case "5":
									$("#repeatclock").show();
									$("#repeatmonth,#repeatweek,#repeatday").hide();
									break;
							}
						});
						dialog({
							title:"New Schedule",
							content:$("#dialog-form"),
							okValue:"Confirm",
							ok:function(){
								var title = $("#title").val();
								var description = $("#description").val();
								var startdate = $("#startdate").val();
								var starttime = $("#starttime").val().split(" ").join("");
								var enddate = $("#stopdate").val();
								var endtime = $("#endtime").val().split(" ").join("");
								var allDay = $("#isallday").val();
								var remark = $('#remark option:selected').val();//选中的值
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
								alert("The end time cannot be less than the beginning time！")
							}

							// 
							if(title){
								$.ajax({
									url:'../enPhp/addCalendarEvents.php',
			   						data:{title:title,description:description,sdate:startdate,stime:starttime,edate:enddate,etime:endtime,allDay:allDay,remark:remark},
			   						type:'POST',
			   						dataType:'json',
			  						success:function(data){
			  							console.log(data);

			  							// 查询是否时间冲突，若冲突 则弹出询问框询问是否设置事件优先度
			  							$.ajax({
												url:'../php/eventsTime.php',
												data:{sdate:startdate,stime:starttime,edate:enddate,etime:endtime},
												type:'POST',
												dataType:'json',
												success:function(data){
													console.log(data)
													console.log(data.length)
													if(data.length > 1) {
														if (confirm("Schedule time conflicts, whether to set event priority？")) {
															// 点击确认按钮
														  showRandSet(data);
														} else {
															// 点击取消按钮
														  	console.log("You have removed the event priority setting!");
															$('#calendar').fullCalendar('refetchEvents');
														}
													}
													
												},
												error:function(){
					  							alert("Failed");
					  						}
					  					})


			  							// 从各个数据源重新获取并且渲染数据：
			  							// $('#calendar').fullCalendar('refetchEvents');
			  							
			  							
				  					},
			  						error:function(){
			  							alert("Failed");
			  						}
			   						
								});
							};
							},
							cancelValue:"close",
							cancel:function(){}
						}).showModal();
					},	
				}],
				okValue:"Confirm",
				ok:function(){
					var titleall = $("#eventall").val();
					var description = "";
					// var startdate = $("#startdate").val();
					var starttime = "00:00:00";
					// var enddate = startdate;
					var endtime = "23:59:59";
					var allDay = 1;
					var remark = 0;

					if(title){
						$.ajax({
							url:'../enPhp/addCalendarEvents.php',
	   						data:{title:titleall,description:description,sdate:selDate,stime:starttime,edate:selDate,etime:endtime,allDay:allDay,remark:remark},
	   						type:'POST',
	   						dataType:'json',
	  						success:function(data){
	  							console.log(data);

	  							// 查询是否时间冲突，若冲突 则弹出询问框询问是否设置事件优先度
	  							$.ajax({
										url:'../php/eventsTime.php',
										data:{sdate:selDate,stime:starttime,edate:selDate,etime:endtime},
										type:'POST',
										dataType:'json',
										success:function(data){
											console.log(data)
											console.log(data.length)
											if(data.length > 1) {
												if (confirm("Schedule time conflicts, whether to set event priority？")) {
													// 点击确认按钮
												  showRandSet(data);
												} else {

													// 点击取消按钮
												  console.log("You have removed the event priority setting!");
												  $('#calendar').fullCalendar('refetchEvents');
												}
											}
											
										},
										error:function(){
			  							alert("Failed");
			  						}
			  					})
		  					},
	  						error:function(){
	  							alert("Failed");
	  						}
						});
					};
					
					/*if(titleall){
						$.ajax({
							url:'../php/addHalfEvents.php',
	   						data:{title:titleall, start:selDate},
	   						type:'POST',
	   						dataType:'json',
	  						success:function(data){
	  							// location.reload();
			  					$('#calendar').fullCalendar('refetchEvents');
	  							// $("#calendar").fullCalendar("renderEvent",data,true);
	  						},
	  						error:function(){
	  							alert("Failed");
	  						}
	   						
						});
					};*/
				},
				cancelValue:"Cancel",
				cancel:function(){}
			});
			d.showModal();
			
		},
		eventClick:function(event,jsEvent,view){
			// 全局变量 点击事件的id
			globalClickedEvent = event.id;

			var editstarttime = $.fullCalendar.formatDate(event.start,"YYYY-MM-DD HH:mm:ss");
			$("#edittitle").html(event.title);
			var eventtitle = event.title;
			if(event.end){
				var editendtime = $.fullCalendar.formatDate(event.end,"YYYY-MM-DD HH:mm:ss");
				$("#edittime").html(editstarttime+"  to  "+editendtime);
			}else{
				$("#edittime").html(editstarttime);
			};


			// 查询数据
			$.ajax({
				url:'../php/searchEventById.php',
				data:{eventId:globalClickedEvent},
				type:'POST',
				dataType:'json',
				success:function(data){
					console.log(data)

					var startDateTime = data[0].start.trim().split(" ");
					var endDateTime = data[0].end.trim().split(" ");
					
					$("#title").val(data[0].title);
					$("#description").val(data[0].description);
					$("#remark").val(data[0].isPublic);
					$("#startdate").val(startDateTime[0]);
					$("#starttime").val(startDateTime[1]);
					$("#stopdate").val(endDateTime[0]);
					$("#endtime").val(endDateTime[1]);
					$("#isallday").val(data[0].allDay);
					$("#enddate").show();
					
				},
				error:function(){
					alert("Failed");
				}
			})

			
			/*$("#title").html(eventtitle);
			$("#description").html("hahahah");
			$("#remark").val(1);
			$("#startdate").val(1);
			$("#starttime").val(1);
			$("#stopdate").val(1);
			$("#endtime").val(1);
			$("#isallday").val(1);*/


			// var time = '19:00:00';
			dialog({ // 更新
				title:"edit the schedule",
				content:$("#edit"),
				okValue:"edit",
				ok:function(){
					$(".datepicker").datepicker({
						language:"zh-CN",
						format:"yyyy-mm-dd",
						todayHighlight:true,
						autoclose:true,
						weekStart:0
					});
					$(".timepicki").wickedpicker({
						// now: time,
						title:'',
						showSeconds:true,
						twentyFour:true
					});
					$("#isallday").click(function(){
						if($("#isallday").prop("checked") == true){
							$("#isallday").val("1");
							$("#starttime,#endtime").hide();
						}else{
							$("#isallday").val("0");
							$("#starttime,#endtime").show();
						};	
					});
					$("#end").click(function(){
						if($("#end").prop("checked") == true){
							$("#enddate").show();
						}else{
							$("#enddate").hide();
						};
					});
					$("#repeat").click(function(){
						if($("#repeat").prop("checked") == true){
							$("#repeattype,#repeattime").show();
						}else{
							$("#repeattype,#repeattime").hide();
						};
					});
					$("#repeatselect").change(function(){
						switch($("#repeatselect").val()){
							case "1":
								$("#repeatclock").show();
								$("#repeatmonth,#repeatweek,#repeatday").hide();
								break;
							case "2":
								$("#repeatmonth,#repeatday").hide();
								$("#repeatweek,#repeatclock").show();
								break;
							case "3":
								$("#repeatmonth,#repeatweek").hide();
								$("#repeatday,#repeatclock").show();
								break;
							case "4":
								$("#repeatweek").hide();
								$("#repeatmonth,#repeatday,#repeatclock").show();
								break;
							case "5":
								$("#repeatclock").show();
								$("#repeatmonth,#repeatweek,#repeatday").hide();
								break;
						}
					});
					dialog({
						title:"Modify the schedule",
						content:$("#dialog-form"),
						okValue:"Confirm",
						ok:function(){
							var title = $("#title").val();
							var description = $("#description").val();
							var startdate = $("#startdate").val();
							var starttime = $("#starttime").val().split(" ").join("");
							var enddate = $("#stopdate").val();
							var endtime = $("#endtime").val().split(" ").join("");
							var allDay = $("#isallday").val();
							var remark = $('#remark option:selected').val();//选中的值
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
								alert("The end time cannot be less than the beginning time！")
							}

							// 
							if(title){
								$.ajax({
									url:'../php/updateCalendarEvents.php',
			   						data:{eventId:globalClickedEvent,title:title,description:description,sdate:startdate,stime:starttime,edate:enddate,etime:endtime,allDay:allDay,remark:remark},
			   						type:'POST',
			   						dataType:'json',
			  						success:function(data){
			  							console.log(data);
			  							// 从各个数据源重新获取并且渲染数据：
			  							$('#calendar').fullCalendar('refetchEvents');
			  							
				  					},
			  						error:function(){
			  							alert("Failed");
			  						}
			   						
								});
							};
						},
						cancelValue:"Close",
						cancel:function(){
							// location.reload();
			  				$('#calendar').fullCalendar('refetchEvents');
						}
					}).showModal();
					$("#calendar").fullCalendar("removeEvents",function(event){
						// globalClickedEvent 事件ID
						if(event.title==eventtitle){
							return true;
						}else{
							return false;
						}
					});
				},
				button:[{
					value:"delete",
					callback:function(){
						$.ajax({
							url:'../php/deleteCalendarEvents.php',
	   						data:{id: globalClickedEvent},
	   						type:'POST',
	   						dataType:'json',
	  						success:function(data){
	  							// console.log(data);
	  							// location.reload();
	  							$('#calendar').fullCalendar('refetchEvents');
	  							// $("#calendar").fullCalendar("renderEvent",data,true);
	  						},
	  						error:function(){
	  							alert("Failed");
	  						}
	   						
						});
					}
				}],
				cancelValue:"cancel",
				cancel:function(){
					// location.reload();
			  		$('#calendar').fullCalendar('refetchEvents');
				}
			}).showModal();
		}
	
	});




});

