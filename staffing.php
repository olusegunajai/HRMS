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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
require_once('fileupload.php'); 

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO staff (staffId, `employee No`, lastName, firstName, username, password, maritalStatus, gender, passport, designation) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['staffId'], "int"),
                       GetSQLValueString($_POST['employee_No'], "text"),
                       GetSQLValueString($_POST['lastName'], "text"),
                       GetSQLValueString($_POST['firstName'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "file"),
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

mysql_select_db($database_conn, $conn);
$query_rsStaff = "SELECT * FROM staff";
$rsStaff = mysql_query($query_rsStaff, $conn) or die(mysql_error());
$row_rsStaff = mysql_fetch_assoc($rsStaff);
$totalRows_rsStaff = mysql_num_rows($rsStaff);
?>
<?php $pagetitle = "Staff Management"; ?>
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
  	         <a href="addstaff.php">
         <article class="menu">
         <img src="images/icons/recruit.png" name="img" height="128" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Add New User</span>
         </article>
         </a>
         
         <a href="updatestaff.php">
         <article class="menu">
         <img src="images/icons/update.png" name="img" height="128" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">Update Staff</span>
         </article>
         </a>
         
         <a href="deletestaff.php">
         <article class="menu">
         <img src="images/icons/fire.png" name="img" height="128" id="img" class="img-responsive">
         <span class="grey_box mint col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub"> Staff Exit</span>
         </article>
         </a>
         <br />
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <br>
        </article>
         <table border="0" class="data_table table table-responsive col-lg-11 col-md-11 col-sm-11 col-xs-11">
           <tr class="blue_box">
             <th>Empl. No</th>
             <th>Last Name</th>
             <th>First Name</th>
             <th>Marital Status</th>
             <th>Gender</th>
             <th>Designation</th>
             <th class="hidden-print" style="width:15px;">&nbsp;</th>
             <th class="hidden-print" style="width:15px;">&nbsp;</th>
           </tr>
           <?php do { ?>
             <tr class="tr">
               <td><?php echo $row_rsStaff['employeeNo']; ?></td>
               <td><?php echo $row_rsStaff['lastName']; ?></td>
               <td><?php echo $row_rsStaff['firstName']; ?></td>
               <td><?php echo $row_rsStaff['maritalStatus']; ?></td>
               <td><?php echo $row_rsStaff['gender']; ?></td>
               <td><?php echo $row_rsStaff['designation']; ?></td>
               <td class="hidden-print"><a href="updatestaff.php?staffId=<?php echo $row_rsStaff['staffId']; ?>"><img src="images/e.png" width="14" height="18" alt="Edit"></a></td>
               <td class="hidden-print"><img src="images/x.png" width="14" height="18" alt="Delete"></td>
             </tr>
             <?php } while ($row_rsStaff = mysql_fetch_assoc($rsStaff)); ?>
             <tr class="tr hidden-print">
             	<td colspan="7"></td>
                <td>
                	<img src="images/print.png" class="print" onClick="javascript:window.print()" width="16" height="16" alt="print">
                </td>
             </tr>
         </table>
</section>

<section class="analyser1 grey_box col-lg-3 col-md-6 col-sm-12 col-xs-12 hidden-print">
               <h3 class="content_title">ADD NEW STAFF</h3>
               <div class="lace white_box"></div>
               <div class="text-center" style="padding-left:10px; padding-right:10px; margin:5px; margin-bottom:-30px;">
               	<?php
					if(!empty($msg)){
						echo $msg;
					}
				?>
               </div>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>" class="form-group" enctype="multipart/form-data">
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
      <td><select name="maritalStatus" size="1" class="textbox1 form-control">
        <option value="Single">single</option>
        <option value="Married">married</option>
        <option value="Divorced">divorced</option>
        <option value="Seperated">seperated</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td><select name="gender" size="1" class="textbox1 form-control">
        <option value="Male">male</option>
        <option value="Female">female</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td><input name="passport" type="file" class="textbox1 form-control" value="" size="32" placeholder="Upload Passport"></td>
    </tr>
    <tr valign="baseline">
      <td><input name="designation" type="text" class="textbox1 form-control" value="" size="32" placeholder="Designation"></td>
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
mysql_free_result($rsStaff);
?>
