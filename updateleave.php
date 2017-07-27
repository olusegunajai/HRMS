<?php require_once('Connections/conn.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "leaveupdate")) {
  $updateSQL = sprintf("UPDATE leaves SET currentdue=%s, daysleft=%s, emplDuration=%s, nextdue=%s, resumptionDate=%s, staffName=%s, type=%s, startDate=%s WHERE leaveId=%s",
                       GetSQLValueString($_POST['currentdue'], "text"),
                       GetSQLValueString($_POST['daysleft'], "text"),
                       GetSQLValueString($_POST['emplDuration'], "text"),
                       GetSQLValueString($_POST['nextdue'], "text"),
                       GetSQLValueString($_POST['resumptionDate'], "text"),
                       GetSQLValueString($_POST['staffName'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['startDate'], "text"),
                       GetSQLValueString($_POST['leaveId'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "leave.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

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
$pagetitle = 'Update Staff Record';


$colname_rsVacations = "-1";
if (isset($_GET['leaveId'])) {
  $colname_rsVacations = $_GET['leaveId'];
}
mysql_select_db($database_conn, $conn);
$query_rsVacations = sprintf("SELECT * FROM leaves WHERE leaveId = %s", GetSQLValueString($colname_rsVacations, "int"));
$rsVacations = mysql_query($query_rsVacations, $conn) or die(mysql_error());
$row_rsVacations = mysql_fetch_assoc($rsVacations);
$totalRows_rsVacations = mysql_num_rows($rsVacations);

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
  <form method="POST" name="leaveupdate" action="<?php echo $editFormAction; ?>">
    <table align="center">
      <tr valign="baseline">
        <td width="39%" align="right" nowrap class="title">Currentdue:</td>
        <td width="61%"><input type="text" class="textbox1" name="currentdue" value="<?php echo htmlentities($row_rsVacations['currentdue'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" class="title">Daysleft:</td>
        <td><input type="text" class="textbox1" name="daysleft" value="<?php echo htmlentities($row_rsVacations['daysleft'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" class="title">EmplDuration:</td>
        <td><input type="text" class="textbox1" name="emplDuration" value="<?php echo htmlentities($row_rsVacations['emplDuration'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" class="title">Nextdue:</td>
        <td><input type="text" class="textbox1" name="nextdue" value="<?php echo htmlentities($row_rsVacations['nextdue'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" class="title">ResumptionDate:</td>
        <td><input type="text" class="textbox1" name="resumptionDate" value="<?php echo htmlentities($row_rsVacations['resumptionDate'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" class="title">StaffName:</td>
        <td><input type="text" class="textbox1" name="staffName" value="<?php echo htmlentities($row_rsVacations['staffName'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" class="title">Type:</td>
        <td><input type="text" class="textbox1" name="type" value="<?php echo htmlentities($row_rsVacations['type'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" class="title">StartDate:</td>
        <td><input type="text" class="textbox1" name="startDate" value="<?php echo htmlentities($row_rsVacations['startDate'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input type="submit" class="button_app" value="Submit"><a href="leave.php"><input type="button" class="button_app_minus" value="Cancel"></a></td>
      </tr>
    </table>
    <input name="leaveId" type="hidden" value="<?php echo $row_rsVacations['leaveId']; ?>">
    <input type="hidden" name="MM_update" value="leaveupdate">
  </form>
  <p>&nbsp;</p>
</section>

<script src="js/nav.js"></script>

</body>
</html><?php
mysql_free_result($rsVacations);

?>
