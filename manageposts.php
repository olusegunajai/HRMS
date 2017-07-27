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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addjob")) {
  $insertSQL = sprintf("INSERT INTO job (jobId, jobTitle, location, responsibility, duties, subsidiary, `description`, requirement, jobStatus, validTill, rdate) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['jobId'], "int"),
                       GetSQLValueString($_POST['jobtitle'], "text"),
                       GetSQLValueString($_POST['location'], "text"),
                       GetSQLValueString($_POST['responsibility'], "text"),
                       GetSQLValueString($_POST['duties'], "text"),
                       GetSQLValueString($_POST['subsidiary'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['requirement'], "text"),
                       GetSQLValueString($_POST['jobstatus'], "text"),
                       GetSQLValueString($_POST['validity'], "date"),
                       GetSQLValueString($_POST['rdate'], "date"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "manageposts.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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

mysql_select_db($database_conn, $conn);
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
  	         <a href="application.php">
         <article class="menu">
         <img src="images/icons/inv.png" name="img" height="128" id="img">
         <span class="grey_box mint" id="sub">View Applicants</span>
         </article>
         </a>
         <p>&nbsp;</p>
         <br />
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <table border="0" class="data_table" cellpadding="1" cellspacing="0" width="100%">
           <tr class="blue_box">
             <th style="padding-left:5px;">Job Titlte</th>
             <th>Job Status</th>
             <th>Opened Date</th>
             <th>Closed Date</th>
             <th>&nbsp;</th>
             <th style="padding-right:5px;">&nbsp;</th>
           </tr>
           <?php do { ?>
             <tr class="tr">
               <td style="padding-left:5px;"><?php echo $row_rsJobs['jobTitle']; ?></td>
               <td><?php echo $row_rsJobs['jobStatus']; ?></td>
               <td><?php echo $row_rsJobs['rdate']; ?></td>
               <td><?php echo $row_rsJobs['mdate']; ?></td>
               <td><a href="editpost.php?jobId=<?php echo $row_rsJobs['jobId']; ?>"><img src="images/e.png" width="14" height="18" alt="Edit"></a></td>
               <td><a href="deletepost.php?PostId=<?php echo $row_rsJobs['jobId']; ?>"><img src="images/x.png" width="14" height="18" alt="Delete"></a></td>
             </tr>
             <?php } while ($row_rsJobs = mysql_fetch_assoc($rsJobs)); ?>
         </table>
</section>

<section class="analyser1 grey_box noprint">
               <h3 class="content_title">ADD NEW job</h3>
               <div class="lace white_box"></div>
<form method="POST" name="addjob" action="<?php echo $editFormAction; ?>">
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
      <td><select name="subsidiary" size="1" class="select" style="height:40px;">
        <option value="CFAO DG / Head Office">DG / Head Office</option>
        <option value="CFAO GI & Distribution">GI & Distribution</option>
        <option value="CFAO Automotive Equipment Sales">AES</option>
        <option value="CFAO ElectroHall">CFAO ElectroHall</option>
        <option value="CFAO Eurapharma">CFAO Pharma</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td><select name="location" size="1" class="select" style="height:40px;">
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
      <td><input name="validity" type="text" class="textbox1" value="" size="32" placeholder="Valid Date"></td>
    </tr>
    <tr valign="baseline">
      <td><input type="submit" class="button_app" value="Add Job">
      <input name="Reset" type="reset" class="button_app_minus" value="Cancel"></td>
    </tr>
  </table>
  <input type="hidden" name="jobId" value="">
  <input type="hidden" name="jobstatus" value="open">
  <input type="hidden" name="rdate" value="<?php echo Date('d/m/Y'); ?>">
  <input type="hidden" name="MM_insert" value="addjob">
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
