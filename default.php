<?php require_once('Connections/conn.php'); ?>
<?php require_once('control/functions.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$pagetitle = "Staff Management";

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO ``user`` (userId, username, password, `level`, rdate) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['userId'], "int"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['rdate'], "date"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "default.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php require_once('control/adduser.php'); ?>
<?php require_once('control/pageaccess.php'); ?>
<?php require_once('control/logoutUser.php'); ?>
<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pagetitle ?></title>
<link rel="stylesheet" href="styles/hr.css" />
<link rel="stylesheet" href="styles/bootstrap.min.css" />
<link rel="icon" type="image/icon" href="images/cfaohr-cfao-groupe.png" />
</head>

<body>    
<section class="col-md-2" id="sidebar" style="text-decoration:none;">
	<?php require_once('sidebar.php'); ?>
</section>
<section class="col-md-10" id="page">
  <section class="contents col-lg-12">
      <?php require_once('topnav.php'); ?>
      <div class="blue_lace"></div>
    <section class="maincontent white_box col-lg-9 col-md-6 col-sm-12 col-xs-12" id="maincontent">
		 <a href="staffing.php">
			 <article class="menu">
				 <img src="images/staffconfig.png" name="img" height="108" id="img" class="img-responsive">
				 <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Manage Staff</span>
			 </article>
		 </a>
             
		 <a href="benefits.php">
			 <article class="menu">
				 <img src="images/benefits.png" name="img" height="108" id="img" class="img-responsive">
				 <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Staff Benefits</span>
			 </article>
		 </a>
             
		 <a href="health.php">
			 <article class="menu">
			   <img src="images/medical.jpg" name="img" height="108" id="img" class="img-responsive">
			   <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Manage Health</span>
			 </article>
		 </a>
             
        <a href="talent.php">
			<article class="menu">
				<img src="images/training.png" name="img" height="128"  id="img" class="img-responsive">
				<span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Training &amp; courses</span>
			</article>
		</a>
             
		<a href="manageposts.php">
			<article class="menu">
			  <img src="images/icons/post.png" name="img" height="128" id="img" class="img-responsive">
			  <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Advertise Posts</span>
			</article>
		</a>
             
		 <a href="">
			 <article class="menu">
				<img src="images/debts.png" name="img" height="128" id="img" class="img-responsive">
				<span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Debts/Payments</span>
			 </article>
		 </a>
             
		 <a href="leave.php">
			<article class="menu">
				<img src="images/leave.png" name="img" height="128" id="img" class="img-responsive">
				<span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Manage Leave</span>
			</article>
		</a>
				 
		<a href="documentation.php">
			<article class="menu">
				<img src="images/documentation.png" name="img" height="128" id="img" class="img-responsive">
				<span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Documentation</span>
			</article>
		</a>
				 
		<a href="health.php">
			<article class="menu">
				<img src="images/icons/hmo.png" name="img" height="128" id="img" class="img-responsive">
				<span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">HMO</span>
			</article>
		</a>
    </section>
      
    <section class="analyser grey_box noprint col-lg-3 col-md-6 col-sm-12 col-xs-12">
         <h3 class="content_title row col-lg-12">CREATE NEW USER</h3>
         <div class="lace white_box row col-lg-12"></div>
               <span class="col-lg-1"></span>
               <div class=" row col-lg-12">
                   <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
                     <table align="center">
                       <tr valign="baseline">
                         <td><input name="username" type="text" class="textbox1 form-control" value="" size="32" placeholder="USERNAME"></td>
                       </tr>
                       <tr valign="baseline">
                         <td><input name="password" type="password" class="textbox1 form-control" value="" size="32" placeholder="PASSWORD"></td>
                       </tr>
                       <tr valign="baseline">
                         <td>
                           <select name="level" size="1" class="select form-control">
                             <option>--Access level--</option>
                             <option value="Administrator">Admin</option>
                             <option value="User">site user</option>
                             <option value="Staff">staff</option>
                           </select>                 </td>
                       </tr>
                       <tr valign="baseline">
                         <td><input type="submit" class="button_app" value="Add user">
                         <input name="Reset" type="reset" class="button_app_minus" value="Cancel"></td>
                       </tr>
                     </table>
                     <input type="hidden" name="userId" value="">
                     <input type="hidden" name="rdate" value="<?php date("d/m/Y") ?>">
                     <input type="hidden" name="MM_insert" value="form2">
              </form>
              </div>
               <span class="col-lg-1"></span>
           <div class="lace white_box"></div>
           <h3 class="content_title col-lg-12">NEWS AND UPDATES</h3>
           <div class="lace white_box"></div>
           <p>&nbsp;</p>
    </section>
      
  </section>
</section>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/nav.js"></script>
</body>
</html>