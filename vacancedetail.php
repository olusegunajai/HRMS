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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO applicatio (name, email, cv, phoneNo, jobTitle, rdate) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['cv'], "text"),
                       GetSQLValueString($_POST['phone'], "int"),
                       GetSQLValueString($_POST['jobTitle'], "text"),
                       GetSQLValueString($_POST['rdate'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "jobs.php";
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
<?php require_once('logoutuser.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title><?php echo $row_rsJobs['jobTitle'].' '; ?>Vancancy Detail</title>
<link rel="icon" href="../images/logo-cfao-groupe.png">
<link href="public/public.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="head grey_box">
	<a href="index.php"><img src="../images/logo-cfao-groupe1.png" style="float:left;" width="54" height="50"  alt=""/>
  <div class="logo"> HR PORTAL</div></a>
<a href="<?php echo $logoutAction ?>" class="formright"> Log out </a><a href="profile.php" class="formright"> My Profile </a><a href="index.php" class="formright"> Home </a>
</div>
<div class="lace"></div>
<div class="case">
	<div class="carton">
   	  <h1 class="title blue">
        	>> <span><?php echo $row_rsJobs['jobTitle']; ?></span> Vacancy Detail</h1>
        <article class="pagejob bluetxt">
        	<h2><span class="bluetxt" style="
            font-size:22px;"><img src="images/logout.png" alt="" width="16" height="16"> <?php echo $row_rsJobs['jobTitle']; ?><br />
            <span class="subjob">posted by HR</span></span></h2>
       	  <h2>Company</h2>
            <p><?php echo $row_rsJobs['subsidiary']; ?></p>
          <h2>Job Responsibility</h2>
            <p><span class="halfd bluetxt"><?php echo $row_rsJobs['responsibility']; ?></span></p>
       	  <h2>Job Description</h2>
            <p><span class="halfd bluetxt"><?php echo $row_rsJobs['description']; ?></span></p>
       	  <h2>Requirements</h2>
            <p><span class="halfd bluetxt"><?php echo $row_rsJobs['requirement']; ?></span></p>
       	  <h2>Address</h2>
            <p><span class="halfd bluetxt"><?php echo $row_rsJobs['location']; ?></span></p>
            <h2>Availability</h2>
            <p><span class="halfd bluetxt"><?php echo $row_rsJobs['jobStatus']; ?></span></p>
            
            <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
            <h2 style="
            font-size:22px;"><img src="images/documentation5.png" width="16" height="18"> Apply as <?php echo $row_rsJobs['jobTitle']?></h2>
            <input type="text" name="name" placeholder="FULL NAME"><br />
            <input type="text" name="email" placeholder="EMAIL ADDRESS"><br />
            <input type="text" name="phone" placeholder="PHONE NUMBER"><br />
            <input type="file" name="cv" value="Upload CV"><br />
            <input type="submit" name="" value="Apply" class="btn lemon" style="margin-top:0;">
              <input name="jobTitle" type="hidden" id="jobTitle" value="<?php echo $row_rsJobs['jobTitle']; ?>">
              <input name="rdate" type="hidden" id="rdate" value="<?php echo date('d/m/Y')?>">
              <input type="hidden" name="MM_insert" value="form1">
              <input type="hidden" name="MM_insert" value="form1">
            </form>
            <p>&nbsp;</p>
        </article>
  </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
<?php
mysql_free_result($rsJobs);
?>
