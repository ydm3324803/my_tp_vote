<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>网站后台系统制造</title>

<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<script src="__PUBLIC__/js/jquery-1.7.1.min.js"></script>
<script src="__PUBLIC__/js/jquery.layout.js"></script>

<style type="text/css">
#top_nav_box{position: absolute;top: 49px;left: 405px;height:31px;overflow:hidden;width:1050px;}
.top-nav{list-style: none;margin:0;padding:0; position:absolute;height:31px;width:1050px;}
.nav_arrow_left{z-index:999;position: absolute;cursor:pointer;display:none;}
.nav_arrow_right{z-index:999;right:0px;position: absolute;cursor:pointer;display:none;}
.top-nav li{float:left; height:31px;background:url(__PUBLIC__/imgs/nav_02.jpg) no-repeat left;overflow:hidden;margin:0 1px;}
.top-nav li a{display:block;text-align:center; width:68px;height:31px;color: #5666a1;line-height: 31px;text-decoration:none;overflow:hidden;}

.top-nav li a:hover {background-color: #395e9f;color:#395e9f;background:url(__PUBLIC__/imgs/nav_01.jpg) no-repeat left;}

.header-title{width:100%;height:78px;background-color: #0e0e0d; background:url(__PUBLIC__/imgs/Qweb_logo.gif) no-repeat left;}
.header-title h1 {color: white;font-size: 26px;height: 24px;font-weight: bold;padding-top: 20px;padding-left: 10px;}

.ui-layout-resizer-west{background-color:#0e0e0d;}
.ui-layout-toggler-west{background-color:#B50033;}
.ui-layout-pane-north{background-color:#0e0e0d;}
</style>


<script>
var qweb_layout = null;
$(document).ready(function () {

	qweb_layout = $('body').layout({
		north__size: 80,
		north__fxName: "none",
		west__size: 400,
		north__spacing_open: 0
	});
	
});

function goToMainFrame( url ){
	document.getElementById('mainFrame').src = url;
}

function goToLeftFrame( url ){
	document.getElementById('leftFrame').src = url;
}

function goToModule(_this, main_url, left_url ) {
	$("#mainFrame",parent.document.body).attr("src",'__APP__/Admin/'+main_url);
	$("#leftFrame",parent.document.body).attr("src",'__APP__/Admin/'+left_url);
	return false;
}
</script>

</head>
<body>


<iframe id="mainFrame" src="__APP__/Index/main" class="ui-layout-center" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>


<iframe id="leftFrame" src="__APP__/Index/left" class="ui-layout-west" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>

</body>
</html>