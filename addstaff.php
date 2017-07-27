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
$pagetitle = 'Add New Staff';

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO staff (staffId, employeeNo, lastName, firstName, maritalStatus, gender, passport, designation, username, password, company, dateofbirth, resumedate, `level`, paypoint, basic, utility, lunch, transport, housing, leave, health, pfa, uniondues, cooperative, emplContribution, rdate, authorizer) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['staffId'], "int"),
                       GetSQLValueString($_POST['employeeNo'], "text"),
                       GetSQLValueString($_POST['lastname'], "text"),
                       GetSQLValueString($_POST['firstname'], "text"),
                       GetSQLValueString($_POST['maritalStatus'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['passport'], "text"),
                       GetSQLValueString($_POST['designation'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['company'], "text"),
                       GetSQLValueString($_POST['day'], "text"),
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
                       GetSQLValueString($_POST['rdate'], "text"),
                       GetSQLValueString($_POST['authorizer'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
  
  $fileUp_errors = array (
  	UPLOAD_ERR_OK => "No Errors.",
  	UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize.",
  	UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE.",
  	UPLOAD_ERR_PARTIAL => "Partial upload.",
  	UPLOAD_ERR_NO_FILE => "Select file to upload.",
  	UPLOAD_ERR_NO_TEMP_DIR => "No temporary directory.",
  	UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
  	UPLOAD_ERR_EXTENSION => "File upload stopped by extension.",
  );
  
  if(isset($_POST['MM_insert'])){
	  // process the form data
	  $upload_dir = "uploads/";
	  $tmp_file = $_FILES['passport']['tmp_name'];
	  $target_file = $upload_dir . basename($_FILES['passport']['name']);
	  
	  if (move_uploaded_file($tmp_file, $upload_dir.$target_file)){
		  $message = "passport uploaded successfully.";
  	  }else{
		  $error = $_FILES['passport']['error'];
		  $message = $fileUp_errors[$error];
  	  }
  }

  $insertGoTo = "addstaff.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
	<div class="pagefloater">

   	  <form action="<?php echo $editFormAction; ?>" method="POST" name="form" enctype="multipart/form-data">
       	<h3 class="content_main_title" style="text-align:left;">personal information</h3>
        <div class="blue_lace noprint"></div>
<section class="formpad">
            <input type="text" name="lastname" placeholder="Last Name" class="textbox1" autofocus>
            <input type="text" name="firstname" placeholder="First Name" class="textbox1">
            <div style="width:180px; float:right; padding-right:20px;">
                <article class="passport">
					<?php if(!empty($_FILES['passport'])){
							echo $_FILES['passport'];
							} else{
							//
							}
					?>
                </article>
                <input type="file" class="select" style="width:180px;" name="passport" id="passport">
                <input type="hidden" name="MAX_FILE_SIZE" value="1048576" >
            <?php if(!empty($message)){echo "<p>{$message}</p>";} ?>
            </div>
            <br />
            <span class="white_text">Gender :</span>
            <br />
            <div><input type="radio" name="gender" value="Male" class="radio"><span class="radio">Male</span>
            <input type="radio" name="gender" value="Female" class="radio"><span class="radio">Female</span></div>
            <br />
            <span class="white_text">Date of birth :</span>
            <br />
            <select class="select" name="day">
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
            <select class="select" name="month">
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
            <select class="select" name="year">
              <option>Year</option>
                            <option value="1960">1960</option>
              <option value="1961">1961</option>
                            <option value="1962">1962</option>
              <option value="1963">1963</option>

              <option value="1964">1964</option>
              <option value="1965">1965</option>
                            <option value="1966">1966</option>
                            <option value="1967">1967</option>
              <option value="1968">1968</option>

              <option value="1969">1969</option>

              <option value="1970">1970</option>
              <option value="1971">1971</option>
                            <option value="1972">1972</option>
              <option value="1973">1973</option>

              <option value="1974">1974</option>
              <option value="1975">1975</option>
                            <option value="1976">1976</option>
                            <option value="1977">1977</option>
              <option value="1978">1978</option>

              <option value="1979">1979</option>
              <option value="1980">1980</option>

              <option value="1981">1981</option>
                            <option value="1982">1982</option>
              <option value="1983">1983</option>

              <option value="1984">1984</option>
              <option value="1985">1985</option>
                            <option value="1986">1986</option>
                            <option value="1987">1987</option>
              <option value="1988">1988</option>

              <option value="1989">1989</option>
              <option value="1980">1990</option>
                            <option value="1991">1991</option>
                            <option value="1992">1992</option>
              <option value="1993">1993</option>

              <option value="1994">1994</option>
              <option value="1995">1995</option>
                            <option value="1996">1996</option>
                            <option value="1997">1997</option>
              <option value="1998">1998</option>

              <option value="1999">1999</option>
              <option value="2000">2000</option>
                            <option value="2001">2001</option>
                            <option value="2002">2002</option>
              <option value="2003">2003</option>

              <option value="2004">2004</option>
              <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
              <option value="2008">2008</option>

              <option value="2009">2009</option>
              <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
              <option value="2013">2013</option>

              <option value="2014">2014</option>
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
            
            <br />
            <span class="white_text">Marital Status :</span>
            <br />
          <input type="radio" name="maritalStatus" value="Single" class="radio">
          <span class="radio">Single</span>
            <input type="radio" name="maritalStatus" value="Married" class="radio">
            <span class="radio">Married</span>
            <input type="radio" name="maritalStatus" value="Divorced" class="radio"><span class="radio">Divorced</span>
            <input type="radio" name="maritalStatus" value="Seperated" class="radio"><span class="radio">Seperated</span><br />
                       <input type="text" name="username" placeholder="Username" class="textbox1">
        <input type="password" name="password" placeholder="Password" class="textbox1">
 
          </section>
          <p><br />
          </p>
          <h3 class="content_main_title" style="text-align:left;">official details</h3>
        <div class="blue_lace noprint"></div>
        <section class="formpad"><input type="text" name="employeeNo" placeholder="Staff Number" class="textbox1">
            <input type="text" name="company" placeholder="Company/Subsidiary" class="textbox1"><br />
        <input type="text" name="address" placeholder="Company Address" class="addressbox"><br/>
            <input type="text" name="resumedate" placeholder="Resumption Date" class="textbox1">
            <input type="text" name="paypoint" placeholder="Pay Point" class="textbox1"><br />
            <input type="text" name="designation" placeholder="Designation" class="textbox1">
            <select name="level" class="select">
              <option>Level</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="1">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
            </select>
            <select name="authorizer" class="select">
              <option>Authority</option>
              <option value="0">Casual</option>
              <option value="0">Staff</option>
              <option value="1">HOD</option>
              <option value="2">HR</option>
              <option value="3">MD</option>
            </select>
        <br />
            <input type="text" name="emplContribution" placeholder="Employee Contribution" class="textbox1">
            <input type="text" name="cooperative" placeholder="Coorperative Contribution" class="textbox1"><br />
            <br />
        </section> 
                  <br />
         	<h3 class="content_main_title" style="text-align:left;">Benefits and Compensation</h3>
        <div class="blue_lace noprint"></div>
        <section class="formpad"><input type="text" name="basic" placeholder="Basic Salary" class="textbox1">
          <input type="text" name="utility" placeholder="Utility Allowance" class="textbox1"><br />
        <input type="text" name="lunch" placeholder="Lunch Allowance" class="textbox1">
          <input type="text" name="transport" placeholder="Transport Allowance" class="textbox1"><br/>
          <input type="text" name="housing" placeholder="Housing Allowance" class="textbox1">
          <input type="text" name="leave" placeholder="Leave Allowance" class="textbox1"><br />
          <input type="text" name="health" placeholder="Health Allowance" class="textbox1">
          <input type="text" name="uniondues" placeholder="Union Dues" class="textbox1"><br />
          <input type="text" name="pfa" placeholder="PFA" class="textbox1"><br />
            <br />
        </section> 
<input type="submit" class="button_plus noprint" value="Add Staff">
<input type="reset" class="button_minus noprint" value="Clear">
<a href="printstaffform.php"><input name="printform" type="button" class="button_plus noprint" id="printform" value="Print Form"></a>
		<input name="staffId" type="hidden" value="">
        <input name="rdate" type="hidden" value="<?php date('d,m,Y')?>">
        <input type="hidden" name="MM_insert" value="form">
      </form>
    </div>
    
</section>

<script src="js/nav.js"></script>

</body>
</html>
