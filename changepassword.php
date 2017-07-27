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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE staff SET password=%s, emailAddress=%s WHERE staffId=%s",
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['emailAddress'], "text"),
                       GetSQLValueString($_POST['staffId'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

		if($Result1){
		$message = '<div class="alert alert-success alert-dismissable" id="flash-msg">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
<h4><i class="icon fa fa-check"></i>Success!</h4>
</div>';
		}
		else{
		$message = ''.mysql_error();
		}

  $updateGoTo = "changepassword.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
  

}

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

$colname_rsStaff = "1";
if (isset($_GET['staffId'])) {
  $colname_rsStaff = $_GET['staffId'];
}
mysql_select_db($database_conn, $conn);
$query_rsStaff = sprintf("SELECT * FROM staff WHERE staffId = %s", GetSQLValueString($colname_rsStaff, "int"));
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
<title>Change Password</title>
<link rel="icon" type="image/icon" href="images/logo-cfao-groupe01.png" />
<link href="public/public.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php include('staffheader.php'); ?>
<div class="case">
	<div class="carton">
   	  <h1 class="title blue">
        	>>  Change Password</h1>
<?php include('control/publicsidebar.php'); ?>
      <article class="pagejob bluetxt " style="width:675px;box-shadow:1px 1px 1px 1px rgba(0,0,51,0.4);">
      	<span> 
        	<div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <?php //echo $message; ?>    
        </div>
    </div>
        </span>
        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
          <table align="center">
			<tr valign="baseline">
              <td><input type="text" name="password" value="" size="32" placeholder="Current Password"></td>
            </tr>
			<tr valign="baseline">
              <td><input type="text" name="password" value="" size="32" placeholder="New Password"></td>
            </tr>
			<tr valign="baseline">
              <td><input type="text" name="password" value="" size="32" placeholder="Confirm Password"></td>
            </tr>
            <tr valign="baseline">
              <td><input type="submit" class="btn_log lemon lemonbtn" value="&radic; Proceed"><a href="profile.php">
               	    <input type="button" class="btn_log orange orangebtn" value="&times; Cancel"></a></td>
            </tr>
          </table>
          <input type="hidden" name="staffId" value="<?php echo $row_rsStaff['staffId']; ?>">
          <input type="hidden" name="MM_update" value="form1">
        </form>
        <p>&nbsp;</p>
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