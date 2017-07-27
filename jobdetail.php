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
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
</head>

<body onLoad="MM_preloadImages('images/Apply-Large---Default.png')">
<div class="head grey_box">
	<a href="index.php"><img src="../images/logo-cfao-groupe1.png" style="float:left;" width="54" height="50"  alt=""/>
  <div class="logo"> HR PORTAL</div></a>
<a href="jobs.php" class="formright"> Job List </a><a href="index.php" class="formright"> Home </a>
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
            
            <form name="form1" method="POST" action="<?php echo $editFormAction; ?>" style="width:350px; float:left; padding-right:100px;">
            <h2 style="
            font-size:22px;"><img src="images/documentation5.png" width="16" height="18"> Apply as <?php echo $row_rsJobs['jobTitle']?></h2>
            <input type="text" name="name" placeholder="FULL NAME"><br />
            <input type="text" name="email" placeholder="EMAIL ADDRESS"><br />
            <input type="text" name="phone" placeholder="PHONE NUMBER"><br />
            <input type="text" name="dob" placeholder="DATE OF BIRTH"><br />
            <input type="text" name="sog" placeholder="STATE OF ORIGIN"><br />
            <input type="text" name="address" placeholder="RESIDENTIAL ADDRESS"><br />
            <input type="text" name="status" placeholder="MARITAL STATUS"><br />
            <input type="text" name="nationality" placeholder="NATIONALITY"><br />
            <input type="text" name="education" placeholder="EDUCATIONAL LEVEL"><br />
            <textarea name="other" placeholder="OTHER">What makes you unique?</textarea>
            <br />            
            <input type="file" name="cv" value="Upload CV"><br /><br>
            <input type="submit" name="" value="Apply" class="btn lemon" style="margin-top:0; width:133px;">
              <input name="jobTitle" type="hidden" id="jobTitle" value="<?php echo $row_rsJobs['jobTitle']; ?>">
              <input name="rdate" type="hidden" id="rdate" value="<?php echo date('d/m/Y')?>">
              <input type="hidden" name="MM_insert" value="form1">
              <input type="hidden" name="MM_insert" value="form1">
            </form>
            <form name="linkedin" method="POST" action="<?php echo $editFormAction; ?>" style="width:350px; float:right; padding-left:50px; position:relative; top:-510px;">
              <h2 style="font-size:22px;">Apply with your profile</h2>
              <a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('linkedin','','images/Apply-Large---Hover.png',1)"><img src="images/Apply-Large---Default.png" alt="Apply with LinkedIn" name="linkedin" width="300" height="70" border="0"></a> <br>
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
