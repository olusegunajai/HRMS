<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="public.css">
<link rel="icon" href="../images/logo-cfao-groupe.png">
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="head grey_box">
	<a href="index.php"><img src="../images/logo-cfao-groupe1.png" style="float:left;" width="54" height="50"  alt=""/>
  <div class="logo"> HR PORTAL</div></a>
    <div style="float:right;"><span id="sprytextfield1">
    <input class="blue" type="text" name="user" value="" placeholder=" EMAIL e.g me@cfao.com" style="float:left;" autofocus>
    <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid email format.</span></span><span id="sprypassword1">
    <input class="blue" type="password" name="pwd" value="" style="float:left;" placeholder="PASSWORD">
    <span class="passwordRequiredMsg">A value is required.</span></span>
    <div class="btn lemon" style="float:left;">Login</div>
      <div class="btn orange" style="float:left;">Sign Up</div>
    </div>
</div>
<div class="lace"></div>
<div class="content">
	<div class="balloon">
    	
  </div>
</div>
<div class="lace"></div>

<footer class="footer ash_white">
	<div class="footnote">copyright <span style="font-size:16px;">&copy;</span> 2014-<?php echo date("Y") ?> <strong>CFAO PLC<span style="font-size:16px;"><sup>&reg;</sup></span></strong>. All right reserved. Powered by <a href="http://www.ajaicorp.com">Ajaicorp</a>
    </div>
</footer>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email", {validateOn:["blur"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["change"]});
</script>
</body>
</html>
