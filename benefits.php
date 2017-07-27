<?php require_once('control/logoutUser.php'); ?>
<?php require_once('control/pageaccess.php'); ?>
<?php $pagetitle = "Staff Benefits And Compensation";
 ?>
<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pagetitle ?></title>
<link rel="stylesheet" href="styles/hr.css" />
<link rel="stylesheet" href="styles/bootstrap.min.css" />
<link rel="icon" type="image/icon" href="images/logo-cfao-groupe.png" />
<script src="js/jquery-2.1.3.js"></script>
</head>

<body>
<section class="col-md-2" id="sidebar" style="text-decoration:none;">
	<?php require_once('sidebar.php'); ?>
</section>
<section class="col-md-10" id="page" width="100%">
  <section class="contents">
      <?php require_once('topnav.php'); ?>
      <div class="blue_lace"></div>
    <section class="maincontent white_box col-md-9" id="maincontent">
    	<article class="hidden-print">
  	         <a href="staffsalary.php">
         <article class="menu">
         <img src="images/salary.jpg" name="img" height="128" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Staff Salary</span>
         </article>
         </a>
         
         <a href="allowance.php">
         <article class="menu">
         <img src="images/allowance.jpg" name="img" height="128" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Allowances</span>
         </article>
         </a>
         
         <a href="leave.php">
         <article class="menu">
         <img src="images/leave1.png" name="img" height="128" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Manage Leave</span>         </article>
         </a>
           	         <a href="pension.php">
         <article class="menu">
         <img src="images/pension.png" name="img" height="128" border="0" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Pension</span>
         </article>
         </a>
  	         <a href="gratuity.php">
         <article class="menu">
         <img src="images/icons/grat.png" name="img" height="128" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Gratuity</span>
         </article>
         </a>

         <br />
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         </article>
</section>

<section class="analyser1 grey_box col-lg-3 col-md-6 col-sm-12 col-xs-12 hidden-print">
               <h3 class="content_title">ADD NEW benefits</h3>
               <div class="lace white_box"></div>
<form method="post" name="form1">
  <table align="center">
    <tr valign="baseline">
      <td><input name="employee_No" type="text" class="textbox1 form-control" value="" size="32" placeholder="Employee No."></td>
    </tr>
    <tr valign="baseline">
      <td><input name="lastName" type="text" class="textbox1 form-control" value="" size="32" placeholder="Last Name"></td>
    </tr>
    <tr valign="baseline">
      <td><input name="firstName" type="text" class="textbox1 form-control" value="" size="32" placeholder="First Name"></td>
    </tr>
    <tr valign="baseline">
      <td><input name="username" type="text" class="textbox1 form-control" value="" size="32" Username></td>
    </tr>
    <tr valign="baseline">
      <td><input name="password" type="password" class="textbox1 form-control" value="" size="32" placeholder="Password"></td>
    </tr>
    <tr valign="baseline">
      <td><input type="submit" class="button_app" value="+ Benefit">
        <input name="Reset" type="reset" class="button_app_minus" value="Cancel"></td>
    </tr>
  </table>
  <input type="hidden" name="staffId" value="">
</form>
               <div class="lace"></div>
    <h3 class="content_title">birthdays and wishes</h3>
               <div class="lace"></div>
<p>&nbsp;</p>
<p>&nbsp;</p>
               <div class="lace"></div>
    <h3 class="content_title">news and updates</h3>
               <div class="lace"></div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</section>
  
</section>

<script src="js/nav.js"></script>

</body>
</html>