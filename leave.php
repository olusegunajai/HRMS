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
  $insertSQL = sprintf("INSERT INTO leaves (leaveId, currentdue, daysleft, emplDuration, nextdue, resumptionDate, staffName, type, startDate) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['leaveId'], "int"),
                       GetSQLValueString($_POST['currentdue'], "date"),
                       GetSQLValueString($_POST['daysleft'], "date"),
                       GetSQLValueString($_POST['emplDuration'], "text"),
                       GetSQLValueString($_POST['nextdue'], "date"),
                       GetSQLValueString($_POST['resumptionDate'], "date"),
                       GetSQLValueString($_POST['staffName'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['startDate'], "date"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "leave.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$pagetitle = "Leave Management";
$curDate = Date("d/m/Y");


mysql_select_db($database_conn, $conn);
$query_rsStaffs = "SELECT * FROM staff";
$rsStaffs = mysql_query($query_rsStaffs, $conn) or die(mysql_error());
$row_rsStaffs = mysql_fetch_assoc($rsStaffs);
$totalRows_rsStaffs = mysql_num_rows($rsStaffs);

mysql_select_db($database_conn, $conn);
$query_rsVacations = "SELECT * FROM leaves";
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
    <a href="">
         <article class="menu">
         <img src="images/leaveadd.png" name="img" height="128" id="img">
         <span class="grey_box mint" id="sub">Register Leave </span>         </article>
    </a>
         
    <a href="updateleave.php">
         <article class="menu">
         <img src="images/leaveedit.png" name="img" height="128" id="img">
         <span class="grey_box mint" id="sub">Update Leave</span>
         </article>
    </a>
         
    <a href="">
         <article class="menu">
         <img src="images/icons/hr.png" name="img" height="128" id="img">
         <span class="grey_box mint" id="sub">Authorizations</span>
         </article>
    </a>

         <br />
         <p>&nbsp;</p>
         <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
         <table border="0" class="data_table" cellpadding="1" cellspacing="0">
           <tr class="blue_box">
             <th>Leave</th>
             <th>Staff Name</th>
             <th>Start</th>
             <th>Duration</th>
             <th>Resumption</th>
             <th>Employment</th>
             <th>Authorization</th>
             <th>Due Date</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
           </tr>
           <tr class="tr">
           <?php do { ?>
             <td><?php echo $row_rsVacations['type']; ?></td>
             <td><?php echo $row_rsVacations['staffName']; ?></td>
             <td><?php echo $row_rsVacations['startDate']; ?></td>
             <td><?php $duration = $row_rsVacations['resumptionDate'] - $row_rsVacations['startDate'] + 31 ;
	   		   			echo $duration ; ?></td>
             <td><?php echo $row_rsVacations['resumptionDate']; ?></td>
             <td><?php echo $row_rsVacations['emplDuration']; ?></td>
             <td><?php echo $row_rsVacations['status']; ?></td>
             <td><?php echo $row_rsVacations['currentdue']; ?></td>
             <td><a href="updateleave.php?leaveId=<?php echo $row_rsVacations['leaveId']; ?>"><img src="images/e.png" width="14" height="18" alt="Edit"></a></td>
             <td><img src="images/x.png" width="14" height="18" alt="Delete"></td>
           </tr>
             <?php } while ($row_rsVacations = mysql_fetch_assoc($rsVacations)); ?>
</table>
</section>

<section class="analyser1 grey_box noprint">
               <h3 class="content_title">register leave/vacation</h3>
    <div class="lace white_box"></div>
                 <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                   <table align="center">
                   	 <tr valign="baseline">
                       <td><select name="staffName" class="select">
                           <option>--Select Staff Name--</option>
                           <?php 
do {  
?>
                           <option value="<?php echo $row_rsStaffs['firstName']." ".$row_rsStaffs['lastName']?>" <?php if (!(strcmp($row_rsStaffs['firstName'], $row_rsStaffs['lastName']))) {echo "SELECTED";} ?>><?php echo $row_rsStaffs['firstName']." ".$row_rsStaffs['lastName']?></option>
                           <?php
} while ($row_rsStaffs = mysql_fetch_assoc($rsStaffs));
?>
                         </select>
                       </td>
                     <tr>
                       <td><input type="text" name="currentdue" value="" size="32" class="textbox1" placeholder="Due as at"></td>
                     </tr>
                     <tr>
                       <td><input type="text" name="nextdue" value="" size="32" class="textbox1" placeholder="Next Due Date"></td>
                     <tr>
                       <td><input type="text" name="daysleft" value="" size="32" class="textbox1" placeholder="Days Left"></td>
                     </tr>
                     <tr>
                       <td><input type="text" name="emplDuration" value="" size="32" class="textbox1" placeholder="Employee Service"></td>
                     </tr>
                     <tr valign="baseline">
                       <td><select name="type" class="select">
                           <option>--Select leave type--</option>
                           <option value="Annual" <?php if (!(strcmp("Annual", ""))) {echo "SELECTED";} ?>>Annual</option>
                           <option value="Education" <?php if (!(strcmp("Education", ""))) {echo "SELECTED";} ?>>Education</option>
                           <option value="Maternity" <?php if (!(strcmp("Maternity", ""))) {echo "SELECTED";} ?>>Maternity</option>
                           <option value="Sick" <?php if (!(strcmp("Sick", ""))) {echo "SELECTED";} ?>>Sick</option>
                         </select>
                       </td>
                     </tr>
                     <tr valign="baseline">
                       <td><input type="text" name="startDate" value="" size="32" class="textbox1" placeholder="Leave Starts By"></td>
                     </tr>
                     <tr>
                       <td><input type="text" name="resumptionDate" value="" size="32" class="textbox1" placeholder="Resumption Date"></td>
                     </tr>
                     <tr valign="baseline">
                       <td><input type="submit" value="+ Vacation" class="button_app"><input type="reset" value="Cancel" class="button_app_minus"></td>
                     </tr>
                   </table>
                   <input type="hidden" name="MM_insert" value="form1">
                   <input type="hidden" name="leaveId" value="">
                 </form>
</section>
  
</section>

<script src="js/nav.js"></script>

</body>
</html><?php
mysql_free_result($rsStaffs);

mysql_free_result($rsVacations);
?>
