<?php
mb_http_input("utf-8");
mb_http_output("utf-8");
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO staff (staffId, `employee No`, lastName, firstName, username, password, maritalStatus, gender, passport, designation) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['staffId'], "int"),
                       GetSQLValueString($_POST['employee_No'], "text"),
                       GetSQLValueString($_POST['lastName'], "text"),
                       GetSQLValueString($_POST['firstName'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['maritalStatus'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['passport'], "text"),
                       GetSQLValueString($_POST['designation'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "staffing.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$maxRows_rsStaffs = 10;
$pageNum_rsStaffs = 0;
if (isset($_GET['pageNum_rsStaffs'])) {
  $pageNum_rsStaffs = $_GET['pageNum_rsStaffs'];
}
$startRow_rsStaffs = $pageNum_rsStaffs * $maxRows_rsStaffs;

mysql_select_db($database_conn, $conn);
$query_rsStaffs = "SELECT employeeNo, lastName, firstName, maritalStatus, gender, designation FROM staff";
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

$pagetitle = "Setups";

?>
<?php require_once('control/logoutUser.php'); ?>
<?php require_once('control/pageaccess.php'); ?>
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
  	         <a href="manageposts.php">
         <article class="menu">
         <img src="images/icons/post.png" name="img" height="98" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Advertise Post</span>
         </article>
         </a>
         
         <a href="memo.php">
         <article class="menu">
         <img src="images/icons/memo.png" name="img" height="98" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Memo</span>
         </article>
         </a>
         
         <a href="query.php">
         <article class="menu">
         <img src="images/icons/query.png" name="img" height="98" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Query</span>
         </article>
         </a>
                  <a href="download.php">
         <article class="menu">
         <img src="images/icons/downloads.png" name="img" height="98" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Download Forms</span>
         </article>
         </a>
         
         <a href="documents.php">
         <article class="menu">
         <img src="images/icons/document.png" name="img" height="98" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Documentation</span>
         </article>
         </a>
         <br />
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         </article>
</section>

<section class="analyser1 grey_box col-lg-3 col-md-6 col-sm-12 col-xs-12 hidden-print">
               <h3 class="content_title">ADD NEW position</h3>
               <div class="lace white_box"></div>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>" class="form-group">
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
      <td><input type="submit" class="button_app" value="+ Position">
        <input name="Reset" type="reset" class="button_app_minus" value="Cancel"></td>
    </tr>
  </table>
  <input type="hidden" name="staffId" value="">
  <input type="hidden" name="MM_insert" value="form1">
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
</html><?php
mysql_free_result($rsStaffs);
?>
