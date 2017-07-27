<?php require_once('Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
  $currentUser = $_SESSION['username'];
}

mysql_select_db($database_conn, $conn);
$query_rsStaff = "SELECT * FROM staff WHERE staff.emailAddress = '$currentUser'";
$rsStaff = mysql_query($query_rsStaff, $conn) or die(mysql_error());
$row_rsStaff = mysql_fetch_assoc($rsStaff);
$totalRows_rsStaff = mysql_num_rows($rsStaff);

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
?>
<?php require_once('control/staffaccess.php'); ?> 
<?php require_once('logoutuser.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Staff Profile</title>
<link rel="icon" type="image/icon" href="images/logo-cfao-groupe01.png" />
<link href="public/public.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php include('staffheader.php'); ?>
<div class="case">
	<div class="carton">
   	  <h1 class="title blue">
   	  >>  <?php echo $row_rsStaff['firstName']." ".$row_rsStaff['lastName']."'s"." "; ?>Profile</h1>
<?php include('control/publicsidebar.php'); ?>
      <article class="pagejob bluetxt " style="width:675px;box-shadow:3px 3px 3px 3px rgba(0,0,51,0.4);">
            <div style="width:180px; float:right; padding-right:20px;"><article class="passport"></article></div>
            <div style="margin-bottom:15px;"><label><strong>Name:</strong> </label>
            <span class="bluetxt info"><?php echo $row_rsStaff['firstName'].' '.$row_rsStaff['lastName']; ?><br /></span></div>
            <div style="margin-bottom:15px;"><label><strong>Staff No:</strong> </label>
            <span class="bluetxt info"><?php echo $row_rsStaff['employeeNo']; ?><br /></span></div>
            <div style="margin-bottom:15px;"><label><strong>Gender:</strong> </label>
            <span class="bluetxt info"><?php echo $row_rsStaff['gender']; ?><br /></span></div>
            <div style="margin-bottom:15px;"><label><strong>Marital Status: </strong></label><span class="bluetxt info"><?php echo $row_rsStaff['maritalStatus']; ?><br /></span></div>
            <div style="margin-bottom:15px;"><label><strong>D.O.B: </strong></label><span class="bluetxt info"><?php echo $row_rsStaff['dateofbirth']; ?><br /></span></div>
            <!--<div style="margin-bottom:15px;"><label><strong>Designation: </strong></label><span class="bluetxt info"><?php echo $row_rsStaff['designation']; ?><br /></span></div>-->
            <div style="margin-bottom:15px;"><label><strong>Grade Level: </strong></label><span class="bluetxt info"><?php echo $row_rsStaff['level']; ?><br /></span></div>
            <div style="margin-bottom:15px;"><label><strong>Email: </strong></label><span class="bluetxt info"><?php echo $row_rsStaff['emailAddress']; ?></span></div>
            <div style="margin-bottom:15px;"><label><strong>Company: </strong></label><span class="bluetxt info"><?php echo $row_rsStaff['company']; ?><br /></span></div>
            <div style="margin-bottom:15px;"><label><strong>Subsidiary: </strong></label><span class="bluetxt info"><?php echo $row_rsStaff['subsidiary']; ?></span></div>
            <div style="margin-bottom:15px;"><label><strong>Designation: </strong></label><span class="bluetxt info"><?php echo $row_rsStaff['designation']; ?><br /></span></div>
            <div style="margin-bottom:15px;"><label><strong>Team: </strong></label><span class="bluetxt info"><?php echo $row_rsStaff['team']; ?><br /></span></div>
            <div style="margin-bottom:15px;"><label><strong>Department: </strong></label><span class="bluetxt info"><?php echo $row_rsStaff['department']; ?><br /></span></div>
            <div style="margin-bottom:15px;"><label><strong>Pay Account: </strong></label><span class="bluetxt info"><?php echo $row_rsStaff['bankAccount']; ?><br /></span></div>
            <div style="margin-bottom:15px;"><label><strong>Pension Account: </strong></label><span class="bluetxt info"><?php echo $row_rsStaff['pfa']; ?><br /></span></div>
      </article>
  </div>
</div>
<?php include('footer.php'); ?>
<script src="js/jquery.min.js"></script>
<script src="js/nav.js"></script>
</body>
</html>
<?php
mysql_free_result($rsStaff);
?>