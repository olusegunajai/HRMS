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

$currentPage = $_SERVER["PHP_SELF"];

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
?>
<?php
if (!isset($_SESSION)) {
  session_start();
  $currentUser = $_SESSION['username'];
}

$currentUser = $_SESSION['username'];
mysql_select_db($database_conn, $conn);
$query_rsStaff = "SELECT * FROM staff WHERE staff.emailAddress = '$currentUser'";
$rsStaff = mysql_query($query_rsStaff, $conn) or die(mysql_error());
$row_rsStaff = mysql_fetch_assoc($rsStaff);
$totalRows_rsStaff = mysql_num_rows($rsStaff);

$maxRows_rsLeaves = 20;
$pageNum_rsLeaves = 0;
if (isset($_GET['pageNum_rsLeaves'])) {
  $pageNum_rsLeaves = $_GET['pageNum_rsLeaves'];
}
$startRow_rsLeaves = $pageNum_rsLeaves * $maxRows_rsLeaves;

mysql_select_db($database_conn, $conn);
$query_rsLeaves = "SELECT * FROM leaves WHERE leaves.staff_email = '$currentUser' ORDER BY startDate";
$query_limit_rsLeaves = sprintf("%s LIMIT %d, %d", $query_rsLeaves, $startRow_rsLeaves, $maxRows_rsLeaves);
$rsLeaves = mysql_query($query_limit_rsLeaves, $conn) or die(mysql_error());
$row_rsLeaves = mysql_fetch_assoc($rsLeaves);

if (isset($_GET['totalRows_rsLeaves'])) {
  $totalRows_rsLeaves = $_GET['totalRows_rsLeaves'];
} else {
  $all_rsLeaves = mysql_query($query_rsLeaves);
  $totalRows_rsLeaves = mysql_num_rows($all_rsLeaves);
}
$totalPages_rsLeaves = ceil($totalRows_rsLeaves/$maxRows_rsLeaves)-1;

$queryString_rsLeaves = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsLeaves") == false && 
        stristr($param, "totalRows_rsLeaves") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsLeaves = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsLeaves = sprintf("&totalRows_rsLeaves=%d%s", $totalRows_rsLeaves, $queryString_rsLeaves);

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
<title>Leave Application</title>
<link rel="icon" type="image/icon" href="images/logo-cfao-groupe01.png" />
<link href="public/public.css" rel="stylesheet" type="text/css">
<link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
<style>
.numberList{font-size:12px; list-style:decimal;}
</style>
</head>

<body>
<?php include('staffheader.php'); ?>
<div class="case">
	<div class="carton">
   	  <h1 class="title blue">
        	>>  <?php echo $row_rsStaff['lastName']."'s"." "; ?>Leave Applications</h1>
<?php include('control/publicsidebar.php'); ?>
      <article class="pagejob bluetxt" style="width:675px;box-shadow:3px 3px 3px 3px rgba(0,0,51,0.4);">
      
      <div class="col-lg-12 col-md-12 col-sm-12 hidden-print">
          <div class="col-lg-1 col-md-2 col-sm-4 col-xs-4">
          <a href="<?php printf("%s?pageNum_rsLeaves=%d%s", $currentPage, 0, $queryString_rsLeaves); ?>">
            <button class="btn btn-default blue"><<</button>
          </a>
          </div>
          <div class="col-lg-1 col-md-2 col-sm-4 col-xs-4">
          <a href="<?php printf("%s?pageNum_rsLeaves=%d%s", $currentPage, max(0, $pageNum_rsLeaves - 1), $queryString_rsLeaves); ?>">
          <button class="btn btn-default blue">Previous</button>
          </a>
          </div>
          <div class="col-lg-8 col-md-0 col-sm-0 col-xs-0"></div>
          <div class="col-lg-1 col-md-2 col-sm-4 col-xs-4">
          <a href="<?php printf("%s?pageNum_rsLeaves=%d%s", $currentPage, min($totalPages_rsLeaves, $pageNum_rsLeaves + 1), $queryString_rsLeaves); ?>">
          <button class="btn btn-default blue" style="margin-right:20px;">Next</button>
          </a>
          </div>
          <div class="col-lg-1 col-md-2 col-sm-4 col-xs-4">
          <a href="<?php printf("%s?pageNum_rsLeaves=%d%s", $currentPage, $totalPages_rsLeaves, $queryString_rsLeaves); ?>">
          <button class="btn btn-default blue">>></button>
          </a>
          </div>
      </div>
      <div class="col-lg-12"></div><br><br>
      
        <table class="table table-stripped table-responsive">
            <tr class="row blue text-uppercase">
            	<td class="col-lg-3 col-md-3 col-sm-3">Leave</td>
            	<td class="col-lg-3 col-md-3 col-sm-3">Days Spent</td>
            	<td class="col-lg-3 col-md-3 col-sm-3">Start Date</td>
            	<td class="col-lg-3 col-md-3 col-sm-3">Resumption</td>
            	<td class="col-lg-3 col-md-3 col-sm-3">Status</td>
            </tr>
            	<?php do { ?>
            <tr class="row">
           	    <td class="col-lg-3 col-md-3 col-sm-3"><?php echo $row_rsLeaves['type']; ?></td>
            	  <td class="col-lg-3 col-md-3 col-sm-3"><?php 
						$days_spent = $row_rsLeaves['resumptionDate'] - $row_rsLeaves['startDate'];
						echo $days_spent;
				 	?>
          	    </td>
            	  <td class="col-lg-3 col-md-3 col-sm-3"><?php echo $row_rsLeaves['startDate']; ?></td>
            	  <td class="col-lg-3 col-md-3 col-sm-3"><?php echo $row_rsLeaves['resumptionDate']; ?></td>
            	  <td class="col-lg-3 col-md-3 col-sm-3 text-capitalize"><?php echo $row_rsLeaves['status']; ?></td>
            </tr>
            	  <?php } while ($row_rsLeaves = mysql_fetch_assoc($rsLeaves)); ?>
        </table>
      </article>
  </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
<script src="js/jquery.min.js"></script>
<script src="js/nav.js"></script>

<?php
mysql_free_result($rsStaff);

mysql_free_result($rsLeaves);
?>