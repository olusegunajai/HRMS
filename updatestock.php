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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE product SET sku=%s, name=%s, color=%s, type=%s, costPrice=%s, sellingPrice=%s, quantity=%s, location=%s, mdate=%s WHERE productId=%s",
                       GetSQLValueString($_POST['sku'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['color'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['costPrice'], "int"),
                       GetSQLValueString($_POST['sellingPrice'], "int"),
                       GetSQLValueString($_POST['quantity'], "int"),
                       GetSQLValueString($_POST['location'], "text"),
                       GetSQLValueString($_POST['mdate'], "date"),
                       GetSQLValueString($_POST['productId'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "inventory.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$maxRows_rsProducts = 15;
$pageNum_rsProducts = 0;
if (isset($_GET['pageNum_rsProducts'])) {
  $pageNum_rsProducts = $_GET['pageNum_rsProducts'];
}
$startRow_rsProducts = $pageNum_rsProducts * $maxRows_rsProducts;

mysql_select_db($database_conn, $conn);
$query_rsProducts = "SELECT * FROM product";
$query_limit_rsProducts = sprintf("%s LIMIT %d, %d", $query_rsProducts, $startRow_rsProducts, $maxRows_rsProducts);
$rsProducts = mysql_query($query_limit_rsProducts, $conn) or die(mysql_error());
$row_rsProducts = mysql_fetch_assoc($rsProducts);

if (isset($_GET['totalRows_rsProducts'])) {
  $totalRows_rsProducts = $_GET['totalRows_rsProducts'];
} else {
  $all_rsProducts = mysql_query($query_rsProducts);
  $totalRows_rsProducts = mysql_num_rows($all_rsProducts);
}
$totalPages_rsProducts = ceil($totalRows_rsProducts/$maxRows_rsProducts)-1;$maxRows_rsProducts = 15;
$pageNum_rsProducts = 0;
if (isset($_GET['pageNum_rsProducts'])) {
  $pageNum_rsProducts = $_GET['pageNum_rsProducts'];
}
$startRow_rsProducts = $pageNum_rsProducts * $maxRows_rsProducts;

$colname_rsProducts = "1";
if (isset($_GET['productId'])) {
  $colname_rsProducts = $_GET['productId'];
}
mysql_select_db($database_conn, $conn);
$query_rsProducts = sprintf("SELECT * FROM product WHERE productId = %s", GetSQLValueString($colname_rsProducts, "int"));
$query_limit_rsProducts = sprintf("%s LIMIT %d, %d", $query_rsProducts, $startRow_rsProducts, $maxRows_rsProducts);
$rsProducts = mysql_query($query_limit_rsProducts, $conn) or die(mysql_error());
$row_rsProducts = mysql_fetch_assoc($rsProducts);

if (isset($_GET['totalRows_rsProducts'])) {
  $totalRows_rsProducts = $_GET['totalRows_rsProducts'];
} else {
  $all_rsProducts = mysql_query($query_rsProducts);
  $totalRows_rsProducts = mysql_num_rows($all_rsProducts);
}
$totalPages_rsProducts = ceil($totalRows_rsProducts/$maxRows_rsProducts)-1;

$queryString_rsProducts = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsProducts") == false && 
        stristr($param, "totalRows_rsProducts") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsProducts = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsProducts = sprintf("&totalRows_rsProducts=%d%s", $totalRows_rsProducts, $queryString_rsProducts);
?>
<?php require_once('control/productlist.php'); ?>
<?php require_once('control/logoutUser.php'); ?>
<?php require_once('control/pageaccess.php'); ?>
<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logo Stores: Inventory</title>
<link rel="stylesheet" href="styles/logo.css" />
<link rel="icon" type="image/icon" href="images/favicon.png" />
<script src="js/jquery-2.1.3.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php include('sidebar.php'); ?>
<section class="content">
  <div class="head white_box"><span class="title">Stock Management</span><span class="logout"><a class="blue_text" href="<?php echo $logoutAction ?>"><img src="images/logout.png" width="14" height="18"> Logout</a></span></div>
     <div class="blue_lace"></div>
     
     <section class="maincontent white_box">
     	     <h3 class="content_title">CHANGE No<?php echo $row_rsProducts['productId']; ?> ITEM  IN  STORE</h3>
        	 <div class="lace white_box"></div>
       <form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
         <table align="center">
           <tr valign="baseline">
             <td><span id="sprytextfield1">
             <input name="sku" type="text" placeholder="sku" class="textbox1" value="<?php echo $row_rsProducts['sku']; ?>" size="32">
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
           </tr>
           <tr valign="baseline">
             <td><span id="sprytextfield2">
             <input name="name" type="text" placeholder="Product Name" class="textbox1" value="<?php echo $row_rsProducts['name']; ?>" size="32">
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Enter correect product name.</span></span></td>
           </tr>
           <tr valign="baseline">
             <td><span id="sprytextfield3">
             <input name="color" type="text" placeholder="colour" class="textbox1" value="<?php echo $row_rsProducts['color']; ?>" size="32">
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
           </tr>
           <tr valign="baseline">
             <td><span id="sprytextfield4">
             <input name="type" type="text" placeholder="Product Type" class="textbox1" value="<?php echo $row_rsProducts['type']; ?>" size="32">
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
           </tr>
           <tr valign="baseline">
             <td><span id="sprytextfield5">
             <input name="costPrice" type="text" placeholder="Cost Price" class="textbox1" value="<?php echo $row_rsProducts['costPrice']; ?>" size="32">
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Input price without currency.</span></span></td>
           </tr>
           <tr valign="baseline">
             <td><span id="sprytextfield6">
             <input name="sellingPrice" type="text" placeholder="Selling Cost" class="textbox1" value="<?php echo $row_rsProducts['sellingPrice']; ?>" size="32">
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Input price without currency.</span></span></td>
           </tr>
           <tr valign="baseline">
             <td><input name="quantity" type="text" placeholder="Quantity" class="textbox1" value="<?php echo $row_rsProducts['quantity']; ?>" size="32"></td>
             <tr>
             <td>
             <input name="location" type="text" placeholder="Location" class="textbox1" value="<?php echo $row_rsProducts['location']; ?>" size="32"></td>
             </tr>
           </tr>
           <tr valign="baseline">
             <td><input type="submit" class="button_app" value="Change"><a href="inventory.php"><input name="cancel" type="button" class="button_app_minus" id="cancel" value="Cancel">
             </a></td>
           </tr>
         </table>
         <input type="hidden" name="productId" value="<?php echo $row_rsProducts['productId']; ?>">
         <input type="hidden" name="mdate" value="<?php date("d/m/Y") ?>">
         <input type="hidden" name="MM_update" value="form1">
       </form>
       <p>&nbsp;</p>

  </section>

</section>

<script src="js/nav.js"></script>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {validateOn:["change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "custom", {validateOn:["change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "custom", {validateOn:["change"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "integer", {validateOn:["change"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "integer", {validateOn:["change"]});
</script>
</body>
</html>
<?php
mysql_free_result($rsProducts);

mysql_free_result($rsproducts);
?>
