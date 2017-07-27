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

$maxRows_rsApplication = 25;
$pageNum_rsApplication = 0;
if (isset($_GET['pageNum_rsApplication'])) {
  $pageNum_rsApplication = $_GET['pageNum_rsApplication'];
}
$startRow_rsApplication = $pageNum_rsApplication * $maxRows_rsApplication;

mysql_select_db($database_conn, $conn);
$query_rsApplication = "SELECT * FROM applicatio";
$query_limit_rsApplication = sprintf("%s LIMIT %d, %d", $query_rsApplication, $startRow_rsApplication, $maxRows_rsApplication);
$rsApplication = mysql_query($query_limit_rsApplication, $conn) or die(mysql_error());
$row_rsApplication = mysql_fetch_assoc($rsApplication);

if (isset($_GET['totalRows_rsApplication'])) {
  $totalRows_rsApplication = $_GET['totalRows_rsApplication'];
} else {
  $all_rsApplication = mysql_query($query_rsApplication);
  $totalRows_rsApplication = mysql_num_rows($all_rsApplication);
}
$totalPages_rsApplication = ceil($totalRows_rsApplication/$maxRows_rsApplication)-1;

mysql_select_db($database_conn, $conn);
$query_rsJobs = "SELECT subsidiary, jobStatus FROM job";
$rsJobs = mysql_query($query_rsJobs, $conn) or die(mysql_error());
$row_rsJobs = mysql_fetch_assoc($rsJobs);
$totalRows_rsJobs = mysql_num_rows($rsJobs);

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
<table border="0" class="data_table" cellpadding="1" cellspacing="0" width="100%">
             <tr class="blue_box">
               <th style="padding-left:5px;">Job Titlte</th>
               <th>Applicant Name</th>
               <th>Applicant Mail</th>
               <th>Contact</th>
               <th>Date Applied</th>
               <th>Subsidiary</th>
               <th>Job Status</th>
               <th style="padding-right:5px;">&nbsp;</th>
             </tr>
           <?php do { ?>
                <tr class="tr">
                 <td style="padding-left:5px;"><?php echo $row_rsApplication['jobTitle']; ?></td>
                  <td><?php echo $row_rsApplication['name']; ?></td>
                  <td><?php echo $row_rsApplication['email']; ?></td>
                  <td><?php echo $row_rsApplication['phoneNo']; ?></td>
                  <td><?php echo $row_rsApplication['rdate']; ?></td>
                  <td><?php echo $row_rsJobs['subsidiary']; ?></td>
                  <td><?php echo $row_rsJobs['jobStatus']; ?></td>
                  <td style="padding-right:5px;"><a href=""><img src="images/icons/page.png" alt="view cv" width="14" height="18"></a></td>
           </tr>
             <?php } while ($row_rsApplication = mysql_fetch_assoc($rsApplication)); ?>
</table>
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
      <td><input type="submit" class="button_app" value="Add Job">
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
mysql_free_result($rsApplication);

mysql_free_result($rsJobs);
?>
