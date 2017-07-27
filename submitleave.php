<?php require_once('Connections/conn.php'); ?>
<?php

		$editFormAction = $_SERVER['PHP_SELF'];
		if (isset($_SERVER['QUERY_STRING'])) {
		  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
		}
		
		if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
		  $insertSQL = sprintf("INSERT INTO leaves (leaveId, staffName, type, startDate, resumptionDate, currentdue, status, emplDuration) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($_POST['leaveId'], "int"),
							   GetSQLValueString($_POST['staffName'], "text"),
							   GetSQLValueString($_POST['type'], "text"),
							   GetSQLValueString($_POST['startDate'], "text"),
							   GetSQLValueString($_POST['resumptionDate'], "text"),
							   GetSQLValueString($_POST['currentdue'], "text"),
							   GetSQLValueString($_POST['status'], "text"),
							   GetSQLValueString($_POST['emplDuration'], "text"));
		
		  mysql_select_db($database_conn, $conn);
		  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
		
		  $insertGoTo = "profile.php";
		  if (isset($_SERVER['QUERY_STRING'])) {
			$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
			$insertGoTo .= $_SERVER['QUERY_STRING'];
		  }
		  header(sprintf("Location: %s", $insertGoTo));
}
//$editFormAction = $_SERVER['PHP_SELF'];
//if (isset($_SERVER['QUERY_STRING'])) {
//  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
//}
//
//if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
//  $insertSQL = sprintf("INSERT INTO leaves (leaveId, staffName, type, startDate, resumptionDate, currentdue, status, emplDuration) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
//                       GetSQLValueString($_POST['leaveId'], "int"),
//                       GetSQLValueString($_POST['staffName'], "text"),
//                       GetSQLValueString($_POST['type'], "text"),
//                       GetSQLValueString($_POST['startDate'], "text"),
//                       GetSQLValueString($_POST['resumptionDate'], "text"),
//                       GetSQLValueString($_POST['currentdue'], "text"),
//                       GetSQLValueString($_POST['status'], "text"),
//                       GetSQLValueString($_POST['emplDuration'], "text"));
//
//  mysql_select_db($database_conn, $conn);
//  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
//
//  $insertGoTo = "profile.php";
//  if (isset($_SERVER['QUERY_STRING'])) {
//    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
//    $insertGoTo .= $_SERVER['QUERY_STRING'];
//  }
//  header(sprintf("Location: %s", $insertGoTo));
//}

if (!isset($_SESSION)) {
  session_start();
  $cUser = $_SESSION['username'];
  $currentUser = $cUser;
}

$currentUser = $_SESSION['username'];
mysql_select_db($database_conn, $conn);
$query_rsStaff = "SELECT * FROM staff WHERE staff.emailAddress = '$currentUser'";
$rsStaff = mysql_query($query_rsStaff, $conn) or die(mysql_error());
$row_rsStaff = mysql_fetch_assoc($rsStaff);
$totalRows_rsStaff = mysql_num_rows($rsStaff);

mysql_select_db($database_conn, $conn);
$query_rsLeaveTypes = "SELECT `leave types`.name FROM `leave types`";
$rsLeaveTypes = mysql_query($query_rsLeaveTypes, $conn) or die(mysql_error());
$row_rsLeaveTypes = mysql_fetch_assoc($rsLeaveTypes);
$totalRows_rsLeaveTypes = mysql_num_rows($rsLeaveTypes);

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
<title>Leave Application</title>
<link rel="icon" type="image/icon" href="images/logo-cfao-groupe01.png" />
<link href="public/public.css" rel="stylesheet" type="text/css">
<link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
<style>
.numberList{font-size:12px; list-style:decimal;}
</style>
</head>

<body>
<?php include('staffheader.php'); ?>
<div class="case">
	<div class="carton">
   	  <h1 class="title blue">
        	>>  <span class="hidden-print"><?php echo $row_rsStaff['lastName']."'s"; ?></span> Leave Request Form</h1>
<?php include('control/publicsidebar.php'); ?>
      <article class="pagejob bluetxt" style="width:675px;box-shadow:3px 3px 3px 3px rgba(0,0,51,0.4);">
        <form method="post" name="form1" class="formleft form-group" action="<?php echo $editFormAction; ?>">
          <table align="center">
            <tr valign="baseline">
              <td style="text-align:left;"><input type="text" name="staffName" class="form-control" style="width:500px;" value="" size="32" placeholder="FULL NAME"></td>
            </tr>
            <tr valign="baseline">
              <td style="text-align:left;">&nbsp;</td>
            </tr>
            <tr valign="baseline">
              <td style="text-align:left;">
              <select class="text form-control" name="type" placeholder="TYPE OF LEAVE?" style="width:500px;">
              <option value="">--SELECT LEAVE TYPE--</option>
                <?php
do {  
?>
                <option value="<?php echo $row_rsLeaveTypes['name']?>"><?php echo $row_rsLeaveTypes['name']?></option>
                <?php
} while ($row_rsLeaveTypes = mysql_fetch_assoc($rsLeaveTypes));
  $rows = mysql_num_rows($rsLeaveTypes);
  if($rows > 0) {
      mysql_data_seek($rsLeaveTypes, 0);
	  $row_rsLeaveTypes = mysql_fetch_assoc($rsLeaveTypes);
  }
?>
              </select>
              </td>
            </tr>
            <tr valign="baseline">
              <td style="text-align:left;">&nbsp;</td>
            </tr>
            <tr valign="baseline">
              <td style="text-align:left;"><span>YOUR LEAVE STARTS?</span><br /><select class="select form-control formleft" name="day" style="width:120px; margin-right:20px;">
              <option>Day</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
            </select>
            <select class="select form-control formleft" name="month" style="width:120px; margin-right:20px;">
              <option>Month</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            <select class="select form-control formleft" name="year" style="width:120px;">
              <option>Year</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
              <option value="2018">2018</option>

              <option value="2019">2019</option>
              <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
              <option value="2023">2023</option>

              <option value="2024">2024</option>
              <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
              <option value="2028">2028</option>

              <option value="2029">2029</option>
              <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
              <option value="2033">2033</option>

              <option value="2034">2034</option>
              <option value="2035">2035</option>
                            <option value="2036">2036</option>
                            <option value="2037">2037</option>
              <option value="2038">2038</option>

              <option value="2039">2039</option>
              <option value="2040">2040</option>
            </select>

            </tr>
            <tr valign="baseline">
            <tr valign="baseline">
              <td style="text-align:left;">&nbsp;</td>
            </tr>
              <td style="text-align:left;"><input type="text" name="resumptionDate" value="" class="form-control" style="width:500px;" size="32" placeholder="TO RESUME WHEN?"></td>
            </tr>
            <tr valign="baseline">
              <td style="text-align:left;">&nbsp;</td>
            </tr>
            <tr valign="baseline">
              <td style="text-align:left;"><input type="text" name="emplDuration" class="form-control" style="width:500px;" value="" size="32" placeholder="BEEN STAFF FOR (X)YEAR?"></td>
            </tr>
            <tr valign="baseline">
              <td style="text-align:left;">&nbsp;</td>
            </tr>
            <tr valign="baseline">
            <input type="text" name="currentdue" class="form-control" style="width:500px;" value="" size="32" placeholder="MY LEAVE'S DUE BY?">
            </tr>
            <tr valign="baseline">
              <td style="text-align:left;">&nbsp;</td>
            </tr>
             <tr valign="baseline">
              <td style="text-align:left;">
              <h2>TERMS & CONDITIONS (CFAO LEAVE POLICY)</h2>
              <P>Leave may be granted to employees of CFAO Group are subject to the following terms and conditions:
              <ol>
              <li>Employees must have worked with the company for a year.</li>
              <li>Leave should be used up within a one period; any unused days will be lost.</li>
              <li>Employees are entitle to only 10 days examination/study leave and supporting documents must be attached to the form.</li>
              <li>Employees are entitle to only 5 days casual leave, which can be taken if annual leave has been exhausted.</li>
              <li>Maternity leave is granted 6 weeks before expected date of birth and evidence must be received from a certified doctor and 6 weeks after the birth of child.</li>
              <li>Any sick leave will have a certified doctor's certificate.</li>
              <li>Written evidence will be shown for leave absence for Court/Police procedure will.</li>
              <li>Employees must ensure all leave days entitled are exhausted within the leave year, Unutilized leave days will be forfeited except where such unutilized leave days is at the discretion of the management.</li>
              </ol>
              </P><br>
              <p class="hidden-print"><input type="checkbox" style="width:12px; height:12px;">
                <strong>I have read and uderstood the above terms and conditions.</strong></p>
             </td>
            </tr>
            <tr valign="baseline">
              <td style="text-align:left;"><input type="submit" class="btn_log lemon lemonbtn hidden-print" value="&radic; Submit"><a href="profile.php"><input type="button" class="btn_log orange orangebtn hidden-print" value="&times; Cancel"></a></td>
            </tr>
          </table>
          <input type="hidden" name="leaveId" value="">
          <input type="hidden" name="status" value="open">
          <input type="hidden" name="email" value="<?php echo $_SESSION['username'];
 ?>">
          <input type="hidden" name="MM_insert" value="form1">
        </form>
      </article>
  </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
<script src="js/jquery.min.js"></script>
<script src="js/nav.js"></script>

<?php
mysql_free_result($rsStaff);

mysql_free_result($rsLeaveTypes);
?>