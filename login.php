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

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "level";
  $MM_redirectLoginSuccess = "submitleave.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conn, $conn);
  	
  $LoginRS__query=sprintf("SELECT username, password, level FROM `user` WHERE username=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'level');
    
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
<?php require_once('control/checkLogin.php'); ?>
<!DOCTYPE HTML">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Application Login</title>
<link rel="stylesheet" href="styles/hr.css" />
<link rel="icon" type="image/icon" href="images/logo-cfao-groupe01.png" />
<script src="js/jquery-2.1.3.js"></script>

</head>

<body>
<div class="head grey_box"><img src="images/logo-cfao-groupe1.png" width="56" height="56" /></div>
     <div class="lace"></div>
<div style="text-align: center; width:100%; height:79%;">
     <div class="logit grey_box">
     	<form name="login" ACTION="<?php echo $loginFormAction; ?>" METHOD="POST">
        <table>
        <tr>
       	  <th style="width:0px;">&nbsp;</th>
            <th class="grey_box" style="font-size:36px;"><strong>USER LOGIN</strong></th>
        </tr>
        <tr>
        	<td>&nbsp;</td>
            <td class="error">
				<?php ?>
          </td>
        </tr>
        	<tr>
            	<td>&nbsp;</td>
       	  		<td><input name="username" type="textbox" class="textbox" placeholder="Username"></td>
          </tr>
          <tr>
          	<td>&nbsp;</td>
        	<td><input name="password" type="password" class="textbox" placeholder="Password"></td>
          </tr>
			<tr>
            	<td>&nbsp;</td>
                <td><input name="login" type="submit" class="button_plus" id="login" value="Login"><a href="index.php"><input name="login" type="button" class="button_minus" id="login" value="Cancel"></a></td>
       	  </table>
          <div class="lock"><img src="images/lock.png" width="256" height="280"></div>
        </form>
  </div>
     </div>
     <div class="lace"></div>
<footer class="grey_box">Copyright &copy; 2014-2015. All rights reserved.</footer>
</body>
</html>