<?php require_once('Connections/conn.php'); ?>
<?php require_once('logoutuser.php'); ?>
<?php require_once('vacancies.php'); ?>
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

mysql_select_db($database_conn, $conn);
$query_rsJobs = "SELECT * FROM job";
$rsJobs = mysql_query($query_rsJobs, $conn) or die(mysql_error());
$row_rsJobs = mysql_fetch_assoc($rsJobs);
$totalRows_rsJobs = mysql_num_rows($rsJobs);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>CFAO Job Vancancies!</title>
<link rel="icon" href="../images/logo-cfao-groupe.png">
<link href="public/public.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="head grey_box">
	<a href="index.php"><img src="../images/logo-cfao-groupe1.png" style="float:left;" width="54" height="50"  alt=""/>
  <div class="logo"> HR PORTAL</div></a>
<a href="index.php" class="formright"> Home </a>
</div>
<div class="lace"></div>
<div class="case">
	<div class="carton">
   	  <h1 class="title blue">
        	>> List of Vacant Posts Available</h1>
        <article class="pagejob">
             <table border="0">
                  <tr>
                  	<td>                  
                  <tr>
                  	<td>                  
                    				<?php do { ?>
   		    <div class="jman">
     		    <h2 class="bluetxt"><img src="images/logout.png" width="16" height="16"> <?php echo $row_rsJobs['jobTitle']; ?><br /><span class="subjob">posted by HR</span></h2>
   		      <p class="halfd bluetxt"><?php echo $row_rsJobs['location']; ?><br /><?php echo $row_rsJobs['subsidiary']; ?><br /><br />
	          <a href="jobdetail.php?jobId=<?php echo $row_rsJobs['jobId']; ?>"><strong>View Detais & Apply &rarr;</strong></a></p>
   		    </div>
            
     		  <?php } while ($row_rsJobs = mysql_fetch_assoc($rsJobs)); ?>
              </td>
            </tr>
           </table>
        </article>
  </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
<?php
mysql_free_result($rsJobs);
?>
