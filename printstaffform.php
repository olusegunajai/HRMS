<?php require_once('Connections/conn.php'); ?>
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

$maxRows_rsStaffs = 10;
$pageNum_rsStaffs = 0;
if (isset($_GET['pageNum_rsStaffs'])) {
  $pageNum_rsStaffs = $_GET['pageNum_rsStaffs'];
}
$startRow_rsStaffs = $pageNum_rsStaffs * $maxRows_rsStaffs;

mysql_select_db($database_conn, $conn);
$query_rsStaffs = "SELECT `employee No`, lastName, firstName, maritalStatus, gender, designation FROM staff";
$query_limit_rsStaffs = sprintf("%s LIMIT %d, %d", $query_rsStaffs, $startRow_rsStaffs, $maxRows_rsStaffs);
$rsStaffs = mysql_query($query_limit_rsStaffs, $conn) or die(mysql_error());
$row_rsStaffs = mysql_fetch_assoc($rsStaffs);

if (isset($_GET['totalRows_rsStaffs'])) {
  $totalRows_rsStaffs = $_GET['totalRows_rsStaffs'];
} else {
  $all_rsStaffs = mysql_query($query_rsStaffs);
  $totalRows_rsStaffs = mysql_num_rows($all_rsStaffs);
}
$totalPages_rsStaffs = ceil($totalRows_rsStaffs/$maxRows_rsStaffs)-1;
?>
<?php require_once('control/logoutUser.php'); ?>
<?php require_once('control/pageaccess.php'); ?>
<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add New Staff</title>
<link rel="stylesheet" href="styles/print.css" />

<link rel="icon" type="image/icon" href="images/logo-cfao-groupe01.png" />
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
<a href="addstaff.php"><div class="back_btn blue_box">Back</div></a>
	<div class="pagefloater">

   	  <form>
       	<h3 class="content_main_title" style="text-align:left;">personal information</h3>
        <div class="blue_lace noprint"></div>
<section class="formpad">
            <input type="text" name="lastname" placeholder="Last Name" class="textbox1">
            <input type="text" name="firstname" placeholder="First Name" class="textbox1">
            <div style="width:180px; float:right; padding-right:20px;"><article class="passport"></article><input type="file" class="select" style="width:180px;" name="passport"></div>
            <br />
            <span class="white_text">Gender :</span>
            <br />
            <input type="radio" name="gender" value="Male" class="radio"><span class="radio">Male</span>
            <input type="radio" name="gender" value="Female" class="radio"><span class="radio">Female</span>
            <br />
            <span class="white_text">Date of birth :</span>
            <br />
            <input class="select" type="text"  placeholder="Day" name="day">
            <input class="select" type="text"  placeholder="Month" name="month">
            <input class="select" type="text"  placeholder="Year" name="year">
            
            <br />
            <span class="white_text">Marital Status :</span>
            <br />
          <input type="checkbox" name="status" value="Single" class="radio">
          <span class="radio">Single</span>
            <input type="checkbox" name="status" value="Married" class="radio">
            <span class="radio">Married</span>
            <input type="checkbox" name="status" value="Divorced" class="radio"><span class="radio">Divorced</span>
            <input type="checkbox" name="status" value="Seperated" class="radio"><span class="radio">Seperated</span><br />
                       <input type="text" name="username" placeholder="Username" class="textbox1">
            <input type="password" name="password" placeholder="Password" class="textbox1">
 
          </section>
          <p><br />
          </p>
          <h3 class="content_main_title" style="text-align:left;">official details (official use only)</h3>
        <div class="blue_lace noprint"></div>
        <section class="formpad"><input type="text" name="staffNo" placeholder="Staff Number" class="textbox1">
            <input type="text" name="company" placeholder="Company/Subsidiary" class="textbox1"><br />
        <input type="text" name="address" placeholder="Company Address" class="addressbox"><br/>
            <input type="text" name="resumedate" placeholder="Resumption Date" class="textbox1">
            <input type="text" name="paypoint" placeholder="Pay Point" class="textbox1"><br />
            <input type="text" name="designation" placeholder="Designation" class="textbox1">
            <input class="select" type="text"  placeholder="Level" name="level">
            <br />
            <input type="text" name="emplContribution" placeholder="Employee Contribution" class="textbox1">
            <input type="text" name="cooperative" placeholder="Coorperative Contribution" class="textbox1"><br />
            <br />
        </section> 
                  <br />
         	<h3 class="content_main_title" style="text-align:left;">Benefits and Compensation (official use only)</h3>
        <div class="blue_lace noprint"></div>
        <section class="formpad"><input type="text" name="basic" placeholder="Basic Salary" class="textbox1">
          <input type="text" name="utility" placeholder="Utility Allowance" class="textbox1"><br />
        <input type="text" name="lunch" placeholder="Lunch Allowance" class="textbox1">
          <input type="text" name="transport" placeholder="Transport Allowance" class="textbox1"><br/>
          <input type="text" name="housing" placeholder="Housing Allowance" class="textbox1">
          <input type="text" name="leave" placeholder="Leave Allowance" class="textbox1"><br />
          <input type="text" name="health" placeholder="Health Allowance" class="textbox1">
          <input type="text" name="uniondues" placeholder="Union Dues" class="textbox1"><br />
          <input type="text" name="pfa" placeholder="PFA" class="textbox1"><br />
            <br />
        </section> 
<input type="submit" class="button_plus noprint" value="Add Staff">
<input type="reset" class="button_minus noprint" value="Clear">
<input type="button" class="button_plus noprint" value="Print Form">
      </form>
    </div>
    
</section>

<script src="js/nav.js"></script>

</body>
</html><?php
mysql_free_result($rsStaffs);
?>
