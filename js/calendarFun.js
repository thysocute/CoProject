function showRandSet(data) {
	$("#setRandLayout").css("display","block");
	$("#setRandLayout").height($(document).height());
	console.log(data)
	console.log(data.length)
	// 冲突事件罗列
	for(var i=0; i<data.length; i++) {
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
	for(var j=1; j<= data.length; j++) {
		dropStr = "<li id='rand" + (j) + "' ondrop='drop(event)' ondragover='allowDrop(event)'></li>"
		$("#dropBox").append(dropStr); 

		levelStr = "<span>level" + j + "</span>";
		$("#levelBox").append(levelStr);
	}

	// 取消按钮
	$("#resetBtn").click(function() {
		$("#setRandLayout").css("display","none");
		$('#calendar').fullCalendar('refetchEvents');
		return false;
	})

	// 确认按钮
	$("#setSubBtn").click(function() {
		var eventsIdArr = [];
		$("#dropBox li").each(function(){
			var eventId = $(this).find(".eventItem").attr("id");
			eventsIdArr.push(eventId);
		});

		$.ajax({
			url:'../php/modifyColor.php',
			data: {eventJSON:eventsIdArr},
			type:'POST',
			dataType:'json',
			success:function(data){
				console.log(data);
				$("#setRandLayout").css("display","none");
				// 刷新当前文档
				// location.reload();
				// 从各个数据源重新获取并且渲染数据：
				$('#calendar').fullCalendar('refetchEvents');
				
			},
			error:function(){
				alert("Failed");
			}
		});


	}) /* #submitBtn end */

}

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