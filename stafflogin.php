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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['user'])) {
  $loginUsername=$_POST['user'];
  $password=$_POST['pwd'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "profile.php";
  $MM_redirectLoginFailed = "stafflogin.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conn, $conn);
  
  $LoginRS__query=sprintf("SELECT emailAddress, password FROM staff WHERE emailAddress=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<?php
// *** Validate request to login to this site.
//if (!isset($_SESSION)) {
//  session_start();
//}
//
//$loginFormAction = $_SERVER['PHP_SELF'];
//if (isset($_GET['accesscheck'])) {
//  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
//}
//
//if (isset($_POST['user'])) {
//  $loginUsername=$_POST['user'];
//  $password=$_POST['pwd'];
//  $MM_fldUserAuthorization = "";
//  $MM_redirectLoginSuccess = "profile.php";
//  $MM_redirectLoginFailed = "stafflogin.php";
//  $MM_redirecttoReferrer = false;
//  mysql_select_db($database_conn, $conn);
//  
//  $LoginRS__query=sprintf("SELECT emailAddress, password FROM staff WHERE emailAddress=%s AND password=%s",
//    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
//   
//  $LoginRS = mysql_query($LoginRS__query, $conn) or die(mysql_error());
//  $loginFoundUser = mysql_num_rows($LoginRS);
//  if ($loginFoundUser) {
//     $loginStrGroup = "";
//    
//	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
//    //declare two session variables and assign them
//    $_SESSION['MM_Username'] = $loginUsername;
//    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      
//
//    if (isset($_SESSION['PrevUrl']) && false) {
//      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
//    }
//    header("Location: " . $MM_redirectLoginSuccess );
//  }
//  else {
//    header("Location: ". $MM_redirectLoginFailed );
//  }
//}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Staff Login</title>
<link rel="icon" href="../images/logo-cfao-groupe.png">
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
<link href="public/public.css" rel="stylesheet" type="text/css">
<link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
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
   	  >> Already a user? Login In &darr; </h1>
        <article class="page">
        	<div class="col-lg-4 col-md-6 col col-sm-12">
                            <form ACTION="<?php echo $loginFormAction; ?>" method="POST" class="formleft" name="userlogin" >        	
                
                        <table name="user_signup">
                            <tr>
                            <td><h1 class="lemon titlelabel" >
                             STAFF LOGIN</h1></td>
                            </tr>
                          <tr>	
                                <td width="284"><span id="sprytextfield1">
                               <input type="text" style="height:35px; margin-top:20px;" name="user" value="" placeholder="EMAIL ADDRESS" autofocus><br />
                          <span class="textfieldRequiredMsg">*Email is required.</span><span class="textfieldInvalidFormatMsg">*Invalid email format.</span></span></td></tr>
                                <tr>
                                <td><span id="sprypassword1">
                                <input type="password" style="height:35px; margin-top:20px;" name="pwd" id="pass" value="" placeholder="PASSWORD">
                                <br />
                          <span class="passwordRequiredMsg">*Password is required.</span><span class="passwordMinCharsMsg">*Must be at least 6 characters.</span></span></td></tr>
                                <tr>
                                    <td><input type="submit" class="btn_log lemon lemonbtn" value="&radic; Login"> 
                                      <a href="index.php">
                                    <input type="button" class="btn_log orange orangebtn" value="&times; Cancel"></a>              	  </td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_insert" value="user_signup">
                        <input name="mdate" type="hidden" id="mdate" value="<?php echo date('d/m/Y'); ?>">
                </form>     
            </div>            
        	<div class="col-lg-4 col-md-0 col col-sm-0">
            </div>            
          <div class="vr blue"></div>
        	<div class="col-lg-4 col-md-6 col col-sm-12">
                            <form ACTION="POST" method="POST" class="formleft" name="iuserlogin" >        	
                
                        <table name="user_signup">
                            <tr>
                            <td><h1 class="orange titlelabel" >
                             iSTAFF LOGIN</h1></td>
                            </tr>
                          <tr>	
                                <td width="284"><span id="sprytextfield1">
                               <input type="text" style="height:35px; margin-top:20px;" name="user" value="" placeholder="EMAIL ADDRESS" autofocus><br />
                              <span class="textfieldRequiredMsg">*Email is required.</span><span class="textfieldInvalidFormatMsg">*Invalid email format.</span></span></td></tr>
                                <tr>
                                <td><span id="sprypassword1">
                                <input type="password" name="pwd" id="pass" value="" placeholder="PASSWORD" style="height:35px; margin-top:20px;">
                                <br />
                              <span class="passwordRequiredMsg">*Password is required.</span><span class="passwordMinCharsMsg">*Must be at least 6 characters.</span></span></td></tr>
                                <tr>
                                    <td><input type="submit" class="btn_log lemon lemonbtn" value="&radic; Login"> 
                                      <a href="index.php">
                                    <input type="button" class="btn_log orange orangebtn" value="&times; Cancel"></a>              	  </td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_insert" value="user_signup">
                        <input name="mdate" type="hidden" id="mdate" value="<?php echo date('d/m/Y'); ?>">
                </form>     
            </div>            
      </article>
  </div>
</div>
<?php include('footer.php'); ?>
<script type="text/javascript">
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["blur"], minChars:6});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email", {validateOn:["change"]});
</script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/nav.js"></script>
</body>
</html>
