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
$pagetitle = 'Update Staff Record';

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE staff SET employeeNo=%s, lastName=%s, firstName=%s, maritalStatus=%s, gender=%s, passport=%s, designation=%s, company=%s, dateofbirth=%s, resumedate=%s, `level`=%s, paypoint=%s, basic=%s, utility=%s, lunch=%s, transport=%s, housing=%s, leave=%s, health=%s, pfa=%s, uniondues=%s, cooperative=%s, emplContribution=%s, mdate=%s WHERE staffId=%s",
                       GetSQLValueString($_POST['employeeNo'], "text"),
                       GetSQLValueString($_POST['lastname'], "text"),
                       GetSQLValueString($_POST['firstname'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['passport'], "text"),
                       GetSQLValueString($_POST['designation'], "text"),
                       GetSQLValueString($_POST['company'], "text"),
                       GetSQLValueString($_POST['dateofbirth'], "text"),
                       GetSQLValueString($_POST['resumedate'], "text"),
                       GetSQLValueString($_POST['level'], "int"),
                       GetSQLValueString($_POST['paypoint'], "text"),
                       GetSQLValueString($_POST['basic'], "int"),
                       GetSQLValueString($_POST['utility'], "int"),
                       GetSQLValueString($_POST['lunch'], "int"),
                       GetSQLValueString($_POST['transport'], "int"),
                       GetSQLValueString($_POST['housing'], "int"),
                       GetSQLValueString($_POST['leave'], "int"),
                       GetSQLValueString($_POST['health'], "int"),
                       GetSQLValueString($_POST['pfa'], "text"),
                       GetSQLValueString($_POST['uniondues'], "int"),
                       GetSQLValueString($_POST['cooperative'], "int"),
                       GetSQLValueString($_POST['emplContribution'], "int"),
                       GetSQLValueString($_POST['mdate'], "text"),
                       GetSQLValueString($_POST['staffId'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "staffing.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_conn, $conn);
$query_rsStaff = "SELECT * FROM staff";
$rsStaff = mysql_query($query_rsStaff, $conn) or die(mysql_error());
$row_rsStaff = mysql_fetch_assoc($rsStaff);
$colname_rsStaff = "-1";
if (isset($_GET['staffId'])) {
  $colname_rsStaff = $_GET['staffId'];;
}
mysql_select_db($database_conn, $conn);
$query_rsStaff = sprintf("SELECT * FROM staff WHERE staffId = %s", GetSQLValueString($colname_rsStaff, "int"));
$rsStaff = mysql_query($query_rsStaff, $conn) or die(mysql_error());
$row_rsStaff = mysql_fetch_assoc($rsStaff);
$totalRows_rsStaff = mysql_num_rows($rsStaff);

?>
<?php require_once('control/logoutUser.php'); ?>
<?php require_once('control/pageaccess.php'); ?>
<!DOCTYPE HTML><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pagetitle ?></title>
<link rel="stylesheet" href="styles/hr.css" />
<link rel="stylesheet" href="styles/bootstrap.min.css" />
<link rel="icon" type="image/icon" href="images/logo-cfao-groupe01.png" />
<script src="js/jquery-2.1.3.js"></script>
</head>

<body col-md-12 col-lg-12>
<section class="col-md-2 col-sm-1 col-xs-0" id="sidebar" style="text-decoration:none;">
	<?php require_once('sidebar.php'); ?>
</section>
<section class="col-md-10">
    <section class="contents">
      <?php require_once('topnav.php'); ?>
         <div class="blue_lace noprint"></div>
    <section class="maincontent white_box">
        <div></div>    
        <div class="pagefloater">
          <form action="<?php echo $editFormAction; ?>" method="POST" name="form">
            <h3 class="content_main_title" style="text-align:left;">personal information</h3>
            <div class="blue_lace noprint"></div>
            <section class="formpad">
<div class="input-group inp">
  <span class="input-group-addon" id="basic-addon3">First Name</span>
  <input type="text" class=" inp form-control" id="basic-url" aria-describedby="basic-addon3">
</div>
              <input name="lastname" type="text" class="textbox1" placeholder="Last Name" value="<?php echo $row_rsStaff['lastName']; ?>">
              <input name="firstname" type="text" class="textbox1" placeholder="First Name" value="<?php echo $row_rsStaff['firstName']; ?>">
                <div style="width:180px; float:right; padding-right:20px;"><article class="passport"><?php echo $row_rsStaff['passport']; ?></article><input type="file" class="select" style="width:180px;" name="passport"></div>
                        <br />
                    <label class="white_text">Gender :</label>
                        <input <?php if (!(strcmp($row_rsStaff['gender'],"Male"))) {echo "checked=\"checked\"";} ?> type="radio" name="gender" value="Male" class="radio"><span class="radio">Male</span>
                    <input <?php if (!(strcmp($row_rsStaff['gender'],"Female"))) {echo "checked=\"checked\"";} ?> type="radio" name="gender" value="Female" class="radio"><span class="radio">Female</span>
                        <br />
                    <span class="white_text">Date of birth :</span>
                        <input name="dateofbirth" type="text" class="select" id="dateofbirth"  placeholder="Date of Birth" value="<?php echo $row_rsStaff['dateofbirth']; ?>">
                        <br />
                    <span class="white_text">Marital Status :</span>
                      <input <?php if (!(strcmp($row_rsStaff['maritalStatus'],"Single"))) {echo "checked=\"checked\"";} ?> type="radio" name="status" value="Single" class="radio">
                  <span class="radio">Single</span>
                        <input <?php if (!(strcmp($row_rsStaff['maritalStatus'],"Married"))) {echo "checked=\"checked\"";} ?> type="radio" name="status" value="Married" class="radio">
                    <span class="radio">Married</span>
                    <input <?php if (!(strcmp($row_rsStaff['maritalStatus'],"Divorced"))) {echo "checked=\"checked\"";} ?> type="radio" name="status" value="Divorced" class="radio"><span class="radio">Divorced</span>
                    <input <?php if (!(strcmp($row_rsStaff['maritalStatus'],"Seperated"))) {echo "checked=\"checked\"";} ?> type="radio" name="status" value="Seperated" class="radio"><span class="radio">Seperated</span><br />
            </section>
            <p>&nbsp;</p>
              <h3 class="content_main_title" style="text-align:left;">official details (official use only)</h3>
            <div class="blue_lace noprint"></div>
            <section class="formpad">
            <input name="employeeNo" type="text" class="textbox1" placeholder="Staff Number" value="<?php echo $row_rsStaff['employeeNo']; ?>">
                <input name="company" type="text" class="textbox1" placeholder="Company/Subsidiary" value="<?php echo $row_rsStaff['company']; ?>"><br/>
                <input name="resumedate" type="text" class="textbox1" placeholder="Resumption Date" value="<?php echo $row_rsStaff['resumedate']; ?>">
                <input name="paypoint" type="text" class="textbox1" placeholder="Pay Point" value="<?php echo $row_rsStaff['paypoint']; ?>"><br />
                <input name="designation" type="text" class="textbox1" placeholder="Designation" value="<?php echo $row_rsStaff['designation']; ?>">
                <input name="level" type="text" class="select"  placeholder="Level" value="<?php echo $row_rsStaff['level']; ?>">
                <br />
                <input name="emplContribution" type="text" class="textbox1" placeholder="Employee Contribution" value="<?php echo $row_rsStaff['emplContribution']; ?>">
                <input name="cooperative" type="text" class="textbox1" placeholder="Coorperative Contribution" value="<?php echo $row_rsStaff['cooperative']; ?>"><br />
                <br />
            </section> 
                      <br />
                <h3 class="content_main_title" style="text-align:left;">Benefits and Compensation (official use only)</h3>
            <div class="blue_lace noprint"></div>
            <section class="formpad">
            <input name="basic" type="text" class="textbox1" placeholder="Basic Salary" value="<?php echo $row_rsStaff['basic']; ?>">
              <input name="utility" type="text" class="textbox1" placeholder="Utility Allowance" value="<?php echo $row_rsStaff['utility']; ?>"><br />
            <input name="lunch" type="text" class="textbox1" placeholder="Lunch Allowance" value="<?php echo $row_rsStaff['lunch']; ?>">
              <input name="transport" type="text" class="textbox1" placeholder="Transport Allowance" value="<?php echo $row_rsStaff['transport']; ?>"><br/>
              <input name="housing" type="text" class="textbox1" placeholder="Housing Allowance" value="<?php echo $row_rsStaff['housing']; ?>">
              <input name="leave" type="text" class="textbox1" placeholder="Leave Allowance" value="<?php echo $row_rsStaff['leave']; ?>"><br />
              <input name="health" type="text" class="textbox1" placeholder="Health Allowance" value="<?php echo $row_rsStaff['health']; ?>">
              <input name="uniondues" type="text" class="textbox1" placeholder="Union Dues" value="<?php echo $row_rsStaff['uniondues']; ?>"><br />
              <input name="pfa" type="text" class="textbox1" placeholder="PFA" value="<?php echo $row_rsStaff['pfa']; ?>"><br />
                <br />
            </section> 
              <input type="submit" class="button_plus noprint" value="Update">
              <a href="staffing.php"><input type="reset" class="button_minus noprint" value="Cancel"></a>
              <input name="staffId" type="hidden" value="<?php echo $row_rsStaff['staffId']; ?>">
              <input name="mdate" type="hidden" id="mdate" value="<?php date("d/m/Y") ?>">
              <input type="hidden" name="MM_update" value="form">
          </form>
        </div>
        
    </section>
</section>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/nav.js"></script>

</body>
</html><?php
mysql_free_result($rsStaff);

?>
