$(function(){
	var fBar = $(".sideMenu .firstBar");  // 一级导航
	var sBar = $(".sideMenu .secondBar"); // 二级导航
	fBar.each(function(i){
	    $(this).click(function(){
	        sBar.eq(i).slideToggle("fast");// 点击一级标题，二级导航面板展示或隐藏
	      })
	});
})
