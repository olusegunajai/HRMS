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

$pagetitle = 'Staff Exit';

$colname_rsStaff = "-1";
if (isset($_GET['staffId'])) {
  $colname_rsStaff = $_GET['staffId'];
}
mysql_select_db($database_conn, $conn);
$query_rsStaff = sprintf("SELECT * FROM staff WHERE staffId = %s", GetSQLValueString($colname_rsStaff, "int"));
$rsStaff = mysql_query($query_rsStaff, $conn) or die(mysql_error());
$row_rsStaff = mysql_fetch_assoc($rsStaff);
$totalRows_rsStaff = mysql_num_rows($rsStaff);
?>
<?php require_once('control/logoutUser.php'); ?>
<?php require_once('control/pageaccess.php'); ?>
<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pagetitle ?></title>
<link rel="stylesheet" href="styles/hr.css" />

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
	<form>
    	<blockquote>
    	  <p>
    	    <select name="name" size="1" class="select">
    	      <option value="" <?php if (!(strcmp("", $row_rsStaff['firstName']))) {echo "selected=\"selected\"";} ?>>--Choose Staff--</option>
    	      <?php
do {  
?>
    	      <option value="<?php echo $row_rsStaff['employeeNo']?>"<?php if (!(strcmp($row_rsStaff['employeeNo'], $row_rsStaff['firstName']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsStaff['lastName']?></option>
    	      <?php
} while ($row_rsStaff = mysql_fetch_assoc($rsStaff));
  $rows = mysql_num_rows($rsStaff);
  if($rows > 0) {
      mysql_data_seek($rsStaff, 0);
	  $row_rsStaff = mysql_fetch_assoc($rsStaff);
  }
?>
            </select>
  	    </p>
  	  </blockquote>
	</form>
</section>

<script src="js/nav.js"></script>

</body>
</html><?php
mysql_free_result($rsStaff);
?>
