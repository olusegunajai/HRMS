<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css" />
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css" />
<link href="jQueryAssets/jquery.ui.slider.min.css" rel="stylesheet" type="text/css" />
<link href="jQueryAssets/jquery.ui.button.min.css" rel="stylesheet" type="text/css" />
<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery-ui-1.9.2.slider.custom.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery-ui-1.9.2.button.custom.min.js" type="text/javascript"></script>
</head>

<body>
<div id="Slider1"><img src="slider/adminlogin.png" width="1348" height="768"  alt=""/>
  <div id="Slider2">
    <button id="Button1">&lt;</button>
  <img src="slider/benefits.png" width="1366" height="662"  alt=""/></div>
</div>
<script type="text/javascript">
$(function() {
	$( "#Slider1" ).slider({
		animate:true,
		step:10,
		range:true,
		value:200
	}); 
});
$(function() {
	$( "#Slider2" ).slider({
		step:10,
		animate:true,
		range:true,
		value:200
	}); 
});
$(function() {
	$( "#Button1" ).button({
		icons:{primary: "ui-icon-gear"}
	}); 
});
</script>
</body>
</html>