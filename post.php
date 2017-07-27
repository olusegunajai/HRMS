<?php require_once('Connections/conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$pagetitle = "Vacancy Management";

mysql_select_db($database_conn, $conn);
$query_rsStaffs = "SELECT * FROM staff";
$rsStaffs = mysql_query($query_rsStaffs, $conn) or die(mysql_error());
$row_rsStaffs = mysql_fetch_assoc($rsStaffs);
$totalRows_rsStaffs = mysql_num_rows($rsStaffs);

$query_rsJobs = "SELECT * FROM job";
$rsJobs = mysql_query($query_rsJobs, $conn) or die(mysql_error());
$row_rsJobs = mysql_fetch_assoc($rsJobs);
$totalRows_rsJobs = mysql_num_rows($rsJobs);
?>
<?php require_once('control/logoutUser.php'); ?>
<?php require_once('control/pageaccess.php'); ?>
<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pagetitle ?></title>
<link rel="stylesheet" href="styles/hr.css" />
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
         <table border="0" class="data_table" cellpadding="1" cellspacing="0">
           <tr class="blue_box">
             <th>Job Title</th>
             <th>Subsidiary</th>
             <th>Location</th>
             <th>Status</th>
             <th>Validity</th>
             <th>Employment</th>
             <th>Available</th>
             <th>Due Date</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
           </tr>
           <tr class="tr">
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td><a href="updatestaff.php"><img src="images/e.png" width="14" height="18" alt="Edit"></a></td>
             <td><img src="images/x.png" width="14" height="18" alt="Delete"></td>
           </tr>
</table>
</section>

<section class="analyser1 grey_box noprint">
               <h3 class="content_title">register leave/vacation</h3>
               <div class="lace white_box"></div>
<form method="post" name="form1">
  <table align="center">
    <tr valign="baseline">
      <td><input name="employee_No" type="text" class="textbox1" value="" size="32" placeholder="Employee No."></td>
    </tr>
    <tr valign="baseline">
      <td><input name="lastName" type="text" class="textbox1" value="" size="32" placeholder="Last Name"></td>
    </tr>
    <tr valign="baseline">
      <td><input name="firstName" type="text" class="textbox1" value="" size="32" placeholder="First Name"></td>
    </tr>
    <tr valign="baseline">
      <td><input name="username" type="text" class="textbox1" value="" size="32" Username></td>
    </tr>
    <tr valign="baseline">
      <td><input name="password" type="password" class="textbox1" value="" size="32" placeholder="Password"></td>
    </tr>
    <tr valign="baseline">
      <td><input type="submit" class="button_app" value="+ Benefit">
        <input name="Reset" type="reset" class="button_app_minus" value="Cancel"></td>
    </tr>
  </table>
  <input type="hidden" name="staffId" value="">
</form>
               <div class="lace"></div>
    <h3 class="content_title">news and updates</h3>
               <div class="lace"></div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</section>
  
</section>

<script src="js/nav.js"></script>

</body>
</html><?php
mysql_free_result($rsStaffs);

mysql_free_result($rsJobs);
?>
