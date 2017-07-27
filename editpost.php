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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE job SET jobTitle=%s, location=%s, responsibility=%s, duties=%s, subsidiary=%s, `description`=%s, requirement=%s, jobStatus=%s, validTill=%s, rdate=%s, mdate=%s WHERE jobId=%s",
                       GetSQLValueString($_POST['jobTitle'], "text"),
                       GetSQLValueString($_POST['location'], "text"),
                       GetSQLValueString($_POST['responsibility'], "text"),
                       GetSQLValueString($_POST['duties'], "text"),
                       GetSQLValueString($_POST['subsidiary'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['requirement'], "text"),
                       GetSQLValueString($_POST['jobStatus'], "text"),
                       GetSQLValueString($_POST['validTill'], "text"),
                       GetSQLValueString($_POST['rdate'], "text"),
                       GetSQLValueString($_POST['mdate'], "text"),
                       GetSQLValueString($_POST['jobId'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "manageposts.php";
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

$pagetitle = "Vacancy Management";

$colname_rsJobs = "-1";
if (isset($_GET['jobId'])) {
  $colname_rsJobs = $_GET['jobId'];
}
mysql_select_db($database_conn, $conn);
$query_rsJobs = sprintf("SELECT * FROM job WHERE jobId = %s", GetSQLValueString($colname_rsJobs, "int"));
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
<link rel="icon" type="image/icon" href="../images/logo-cfao-groupe01.png" />
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
          <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
            <table width="86%" align="center">

              <tr valign="baseline">
                <td align="right" nowrap class="title">Job Title</td>
                <td><input name="jobTitle" type="text" class="textbox1" value="<?php echo htmlentities($row_rsJobs['jobTitle'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap class="title" align="right">Location</td>
                <td><input name="location" type="text" class="textbox1" value="<?php echo htmlentities($row_rsJobs['location'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap class="title" align="right" valign="top">Responsibility</td>
                <td><textarea name="responsibility" cols="50" rows="5"><?php echo htmlentities($row_rsJobs['responsibility'], ENT_COMPAT, 'utf-8'); ?></textarea>                </td>
              </tr>
              <tr valign="baseline">
                <td nowrap class="title" align="right" valign="top">Duties</td>
                <td><textarea name="duties" cols="50" rows="5"><?php echo htmlentities($row_rsJobs['duties'], ENT_COMPAT, 'utf-8'); ?></textarea>                </td>
              </tr>
              <tr valign="baseline">
                <td nowrap class="title" align="right">Subsidiary</td>
                <td><input name="subsidiary" type="text" class="textbox1" value="<?php echo htmlentities($row_rsJobs['subsidiary'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap class="title" align="right" valign="top">Description</td>
                <td><textarea name="description" cols="50" rows="5"><?php echo htmlentities($row_rsJobs['description'], ENT_COMPAT, 'utf-8'); ?></textarea>                </td>
              </tr>
              <tr valign="baseline">
                <td nowrap class="title" align="right" valign="top">Requirement</td>
                <td><textarea name="requirement" cols="50" rows="5"><?php echo htmlentities($row_rsJobs['requirement'], ENT_COMPAT, 'utf-8'); ?></textarea>                </td>
              </tr>
              <tr valign="baseline">
                <td nowrap class="title" align="right">Job Status</td>
                <td><select name="jobstatus" size="1" class="select" style="height:40px;">
                  <option value="open">Open</option>
                  <option value="closed">Closed</option>
                </select>      
                </td>
              </tr>
              <tr valign="baseline">
                <td nowrap class="title" align="right">Valid Till</td>
                <td><input name="validTill" type="text" class="textbox1" value="<?php echo htmlentities($row_rsJobs['validTill'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">&nbsp;</td>
                <td><input type="submit" class="button_plus noprint" value="Confirm">
          <a href="manageposts.php"><input type="button" class="button_minus noprint" value="Cancel"></a></td>
              </tr>
            </table>
            <input type="hidden" name="MM_update" value="form2">
            <input type="hidden" name="mdate" value="<?php echo date('d/m/Y'); ?>">
            <input type="hidden" name="jobId" value="<?php echo $row_rsJobs['jobId']; ?>">
          </form>
          <p>&nbsp;</p>
        </section>

<section class="analyser1 grey_box noprint">
               <h3 class="content_title">ADD NEW job</h3>
               <div class="lace white_box"></div>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td><input name="jobtitle" type="text" class="textbox1" value="" size="32" placeholder="Job Title"></td>
    </tr>
    <tr valign="baseline">
      <td><input name="responsibility" type="text" class="textbox1" value="" size="32" placeholder="RESPONSIBILITY"></td>
    </tr>
    <tr valign="baseline">
      <td><input name="duties" type="text" class="textbox1" value="" size="32" placeholder="DUTIES"></td>
    </tr>
    <tr valign="baseline">
      <td><input name="description" type="text" class="textbox1" placeholder="DESCRIPTION" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td><input name="requirement" type="text" class="textbox1" value="" size="32" placeholder="REQUIREMENT"></td>
    </tr>
    <tr valign="baseline">
      <td><select name="subsidiary" size="1" class="textbox1" style="height:40px;">
        <option value="CFAO DG / Head Office">DG / Head Office</option>
        <option value="CFAO GI & Distribution">GI & Distribution</option>
        <option value="CFAO Automotive Equipment Sales">AES</option>
        <option value="CFAO ElectroHall">CFAO ElectroHall</option>
        <option value="CFAO Eurapharma">CFAO Pharma</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td><select name="location" size="1" class="textbox1" style="height:40px;">
        <option value="1009, Adeola Odeku, Victoria Island, Lagos">CFAO DG Adeola Odeku</option>
        <option value="71/72 Adeniji Adele Rd, Elegbata, Lagos Island">GI & Distribution</option>
        <option value="61/62, Cause-way Rd, Ijora, Lagos">AES Ijora</option>
        <option value="71/72 Adeniji Adele Rd, Elegbata, Lagos Island">CFAO E-Hall LI</option>
        <option value="Plot A/B/C Amuwo-Odofin, Oshodi-Apapa Express way">CFAO Pharma Amuwo</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td><input name="designation" type="text" class="textbox1" value="" size="32" placeholder="Designation"></td>
    </tr>
    <tr valign="baseline">
      <td><input type="submit" class="button_app" value="Add Staff">
      <input name="Reset" type="reset" class="button_app_minus" value="Cancel"></td>
    </tr>
  </table>
  <input type="hidden" name="staffId" value="">
  <input type="hidden" name="MM_insert" value="form1">
</form>
  <p>&nbsp;</p>
<p>&nbsp;</p>
  
</section>
  
</section>

<script src="js/nav.js"></script>

</body>
</html><?php
mysql_free_result($rsJobs);
?>
