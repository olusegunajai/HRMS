<?php require_once('Connections/conn.php'); ?>
<?php require_once('staffsignup.php'); ?>
<?php require_once('loginuser.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>User SignUp</title>
<link rel="icon" href="../images/logo-cfao-groupe.png">
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
<link href="public/public.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="head grey_box">
	<a href="index.php"><img src="../images/logo-cfao-groupe1.png" style="float:left;" width="54" height="50"  alt=""/>
  <div class="logo"> HR PORTAL</div></a>
<a href="jobs.php" class="formright"> Job List </a><a href="index.php" class="formright"> Home </a>
</div>
<div class="lace"></div>
<div class="case">
	<div class="carton">
   	  <h1 class="title blue">
        	>> User Sign Up
      </h1>
        <article class="page">
       
        <p class="msg">
       	Kindly sign up with valid information which will be used to contact you afterwards. If you already signed up please do sign in at the top.</p>
               
       	  <form action="<?php echo $editFormAction; ?>" method="POST" name="staff_signup" >
            <table class="smalltable">
            <tr>
            <td><h1 class="blue titlelabel">
            STAFF SIGN UP</h1></td>
            </tr>
            	<tr>	
                <td width="284"><span id="sprytextfield2">
                <input type="text" name="employeeNo" value="" placeholder="STAFF NO"><br />
              <span class="textfieldRequiredMsg">*This field is required.</span></span></td></tr>
            	<tr>
            	<tr>	
                <td width="284"><span id="sprytextfield3">
                <input type="text" name="username" value="" placeholder="you@cfao.com"><br />
              <span class="textfieldRequiredMsg">*Staff email is required.</span><span class="textfieldInvalidFormatMsg">*Invalid email format.</span></span></td></tr>
                <td width="284"><span id="sprypassword2"><span id="sprypassword3">
                <input type="password" name="staff_password" id="staff_password" value="" placeholder="PASSWORD"><br />
                <span class="passwordRequiredMsg">*Password is required.</span><span class="passwordMinCharsMsg">*Must be at least 8 characters.</span><span class="passwordInvalidStrengthMsg">*Good password must have at least one UPPERCASE, NUMBER, LETTER, AND SPECIAL CHARACTER.</span></span><span class="passwordRequiredMsg">*A value is required.</span></span></td></tr>
                <tr>
                <td><span id="spryconfirm1"><span id="spryconfirm4">
                  <input type="password" name="passwd" value="" placeholder="CONFIRM PASSWORD"><br />
              </span><span class="confirmRequiredMsg">*Password is required.</span><span class="confirmInvalidMsg">*Password don't match.</span></span></td></tr>
                <tr>
                	<td>
                	  
                	  <input type="submit" class="btn_log blue bluebtn" value="&radic; Sign Up">
                	  <a href="index.php"><input type="button" class="btn_log orange orangebtn" value="&times; Cancel"></a>
              	  </td>
                </tr>
            </table> 
              <input name="level" type="hidden" value="user">
              <input name="rdate" type="hidden" id="rdate" value="<?php echo date('d/m/Y'); ?>">
              <input type="hidden" name="MM_insert" value="signup">
              <input type="hidden" name="MM_insert" value="staff_signup">
          </form>
          <br />
          
        </article>
  </div>
</div>
<?php include('footer.php'); ?>
<script type="text/javascript">
var spryconfirm4 = new Spry.Widget.ValidationConfirm("spryconfirm4", "staff_password", {validateOn:["blur"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["blur"], minChars:6});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
</script>
</body>
</html>